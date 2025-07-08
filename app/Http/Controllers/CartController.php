<?php

namespace App\Http\Controllers;

use App\Models\order_details;
use App\Models\orders;
use App\Models\Transaction;
use App\Models\products;
use App\Models\user_addresses;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Midtrans\Transaction as MidtransTransaction;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Cart::instance('cart')->content();
        return view('pages.cart',compact('items'));
    }

    public function add_to_cart(Request $request)
    {
        Cart::instance('cart')->add($request->id,$request->name,$request->quantity,$request->price)->associate(products::class);  
              
        // session()->flash('success', 'Product is Added to Cart Successfully !');        
        // return response()->json(['status'=>200,'message'=>'Success ! Item Successfully added to your cart.']);
        return redirect()->back();
    } 

    public function increase($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId,$qty);
        session()->save();
        return back();
    }

    public function decrease($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId,$qty);
        session()->save();
        return back();
    }

    public function remove($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    public function empty_cart()
    {
        Cart::instance('cart')->destroy();
        return redirect()->back();
    }

    public function checkout(Transaction $transaction)
    {
        if(!Auth::check())
        {
            return redirect()->route('login');
        }

        $addresses = user_addresses::where('user_id', Auth::user()->id)->first();
        return view('pages.checkout', compact('addresses','transaction'));
    }

    public function place_an_order(Request $request)
    {
        $user_id = Auth::user()->id;
        $addresses = user_addresses::where('user_id',$user_id)->first();

        if (!$addresses) {
            $request->validate([
                'name' => 'required|max:100',
                'phone' => 'required|regex:/^08[0-9]{8,11}$/',
                'address' => 'required',
                'city' => 'required',
            ]);

            $addresses = new user_addresses();
            $addresses->name = $request->name;
            $addresses->phone = $request->phone;
            $addresses->address = $request->address;
            $addresses->city = $request->city;
            $addresses->user_id =$user_id;
            $addresses->save();
        }
        $this->setAmountForCheckout();
        $order = new orders();
        $order->user_id = $user_id;
        $order->subtotal = Session()->get('checkout')['subtotal'];
        $order->total = Session()->get('checkout')['total'];
        $order->name = $addresses->name;
        $order->phone = $addresses->phone;
        $order->address = $addresses->address;
        $order->city = $addresses->city;
        $order->save();  


        foreach(Cart::instance('cart')->content() as $item)
        {
            $orderitem = new order_details();
            $orderitem->product_id = $item->id;
            $orderitem->order_id = $order->id;
            $orderitem->price = $item->price;
            $orderitem->quantity = $item->qty;
            $orderitem->save();   
            
            $product = products::find($item->id);
            if ($product && $product->quantity >= $item->qty) {
                $product->quantity -= $item->qty;
                $product->save();
            } else {
                // Jika stok tidak cukup, rollback atau kirim pesan error
                return redirect()->back()->with('error', 'Stok produk tidak mencukupi untuk: ' . $item->name);
            }
        } 
        
        // Set your Merchant Server Key
        // Config::$serverKey = 'Mid-server-ti7necKGRD1HO0MoIO_--IZQ';
        Config::$serverKey = 'SB-Mid-server-2lHzRA-krRCP28s06Ai0om-J';
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $order_id = $order->id;

        $items = [];
        foreach (Cart::instance('cart')->content() as $item) {
            $items[] = [
                'id' => $item->id,
                'price' => $item->price,
                'quantity' => $item->qty,
                'name' => $item->name
            ];
        }

        
        if ($request->mode == "transfer") {
            $transaction = new Transaction();
            $transaction->user_id = $user_id;
            $transaction->order_id = $order->id;
            $transaction->mode = $request->mode;
            $transaction->status = "pending";
            $transaction->snap_token="";
            $transaction->save();

            $params = [
                'transaction_details' => [
                    'order_id' => $order_id,
                    'gross_amount' => $order->total,
                ],
                'item_details' => $items,
                'customer_details' => [
                    'first_name' => $order->name,
                    'email' => $order->email,
                    'phone' => $order->phone,
                ],
                'callbacks' => [
                    'finish' => route('midtrans.finish') // tetap pakai ini untuk keamanan
                ],
                'finish_redirect_url' => route('midtrans.return.back')
            ];

            $snapTransaction = Snap::getSnapToken($params);
            $transaction->snap_token = $snapTransaction;
            $transaction->save();
        }else if ($request->mode == "invoice") {
            $transaction = new Transaction();
            $transaction->user_id = $user_id;
            $transaction->order_id = $order->id;
            $transaction->mode = $request->mode;
            $transaction->status = "pending";
            $transaction->snap_token="";
             $transaction->save();
        }else if ($request->mode == "cod") {
            $transaction = new Transaction();
            $transaction->user_id = $user_id;
            $transaction->order_id = $order->id;
            $transaction->mode = $request->mode;
            $transaction->status = "pending";
            $transaction->snap_token="";
             $transaction->save();
        }

        Cart::instance('cart')->destroy();
        Session()->forget('checkout');
        Session()->put('order_id',$order->id);
        return view('pages.order-confirmation', compact('transaction','order'));
        //return redirect()->route('pages.order-confirmation');
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'status' => 'required',
        ]);

        $transaction = Transaction::where('order_id', $request->order_id)->first();

        if ($transaction) {
            $transaction->status = $request->status;
            $transaction->save();
            return response()->json(['message' => 'Status updated']);
        }

        return response()->json(['message' => 'Transaction not found'], 404);
    }

    public function handleWebhook(Request $request)
    {
        try {
            $notification = new Notification();

            $orderId = $notification->order_id;
            $transactionStatus = $notification->status;

            // Log untuk debugging
            Log::info("Midtrans Notification for Order ID: $orderId - Status: $transactionStatus");

            // Cari transaksi berdasarkan order_id
            $transaction = Transaction::where('order_id', $orderId)->first();

            if (!$transaction) {
                Log::warning("Transaksi tidak ditemukan untuk Order ID: $orderId");
                return response()->json(['message' => 'Transaction not found'], 404);
            }

            // Simpan status terbaru
            $transaction->status = $transactionStatus;
            $transaction->save();

            return response()->json(['message' => 'Status updated'], 200);
        } catch (\Exception $e) {
            Log::error('Midtrans Webhook error: ' . $e->getMessage());
            return response()->json(['message' => 'Error processing notification'], 500);
        }
    }

    public function handleNotification(Request $request)
    {
        $payload = $request->all();
        Log::info('Webhook Midtrans diterima:', $payload);

        $orderId = $payload['order_id'] ?? null;

        if (!$orderId) {
            return response()->json(['error' => 'order_id kosong'], 400);
        }

        $serverKey = config('midtrans.server_key');

        $response = Http::withBasicAuth($serverKey, '')
            ->get("https://api.sandbox.midtrans.com/v2/{$orderId}/status");

        if (!$response->successful()) {
            return response()->json(['error' => 'Gagal mengambil status dari Midtrans'], 500);
        }

        $data = $response->json();

        $transaction = Transaction::where('order_id', $orderId)->first();

        if (!$transaction) {
            return response()->json(['error' => 'Transaksi tidak ditemukan'], 404);
        }

        $transaction->status = $data['transaction_status'];
        $transaction->save();

        return response()->json(['message' => 'Status berhasil diperbarui.']);
    }

    public function ajaxCheckPaymentStatus(orders $order): JsonResponse
    {
        $transaction = Transaction::where('order_id', $order->id)->first();

        if (!$transaction) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production', false);

        try {
            $midtransStatus = MidtransTransaction::status($transaction->order_id);

            $transaction->status = $midtransStatus->transaction_status ?? 'unknown';
            $transaction->save();

            return response()->json([
                'message' => 'Status diperbarui',
                'status' => $transaction->status
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal ambil status: ' . $e->getMessage()
            ], 500);
        }
    }

    // public function callback(Request $request)
    // {
    //     $serverKey = config('midtrans.server_key');
    //     $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
    //     if($hashed == $request->signature_key){
    //         if ($request->transaction_status == 'capture') {
    //             $transaction = Transaction::find($request->order_id);
    //             $transaction->status = 'approved';
    //             $transaction->save();
    //         }
    //     }
    // }

    public function midtransFinish(Request $request)
    {
        // Konfigurasi Midtrans
        $orderId = $request->input('order_id');

        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        try {
            // 3. Ambil status transaksi dari Midtrans API
            $status = MidtransTransaction::status($orderId); // object stdClass
            if (is_array($status)) {
                $status = json_decode(json_encode($status)); // Konversi array ke object jika perlu
            }

            // 4. Cari transaksi di database lokal
            $transaction = Transaction::where('order_id', $orderId)->first();

            if (!$transaction) {
                return redirect()->route('pages.index')->with('error', 'Transaksi tidak ditemukan di database.');
            }

            // 5. Update status transaksi berdasarkan Midtrans
            switch ($status->transaction_status) {
                case "settlement":
                    $transaction->status = 'approved';
                    break;
                case "pending":
                    $transaction->status = 'pending';
                    break;
                case "cancel":
                case "expire":
                case "deny":
                    $transaction->status = 'declined';
                    break;
                default:
                    $transaction->status = 'unknown';
                    break;
            }

            $transaction->save();

            return redirect()->route('pages.orders')->with('success', 'Status transaksi berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('pages.orders')->with('error', 'Gagal memproses status pembayaran: ' . $e->getMessage());
        }
    }

    public function returnBack(Request $request)
    {
        // Redirect kembali ke halaman checkout atau order confirmation
        // Bisa gunakan session jika perlu menyimpan lokasi sebelumnya
        return redirect()->route('pages.orders')->with('info', 'Kamu kembali dari pembayaran.');
    }

    public function handleCallback(Request $request)
    {
        $payload = $request->all();
        $signatureKey = $request->input('signature_key');

        // Validasi signature
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $validSignature = hash('sha512',
            $payload['order_id'] .
            $payload['status_code'] .
            $payload['gross_amount'] .
            $serverKey
        );

        if ($signatureKey !== $validSignature) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Lakukan update status transaksi ke DB
        $transaction = Transaction::status($payload['order_id']);
        $status = $transaction->transaction_status;

        if ($status == 'settlement') {
            $transaction->status = "approved";
            $transaction->save();
        } elseif ($status == 'expire' || $status == 'cancel') {
            $transaction->status = "declined";
            $transaction->save();
        }

        return response()->json(['message' => 'OK']);
    }

    public function handleOnClose(Request $request)
    {
        $orderId = $request->input('order_id');

        $transaction = Transaction::where('order_id', $orderId)->first();

        if ($transaction && $transaction->status === 'pending') {
            $transaction->status = 'pending'; // atau 'unpaid', sesuai sistem kamu
            $transaction->save();
        }else{
            $transaction->status = 'declined';
            $transaction->save();
        }
        return response()->json(['message' => 'Status transaksi diperbarui karena user menutup pembayaran']);
    }

    public function setAmountForCheckout()
    { 
        if(!Cart::instance('cart')->count() > 0)
        {
            Session()->forget('checkout');
            return;
        }    
            Session()->put('checkout',[
                'discount' => 0,
                'subtotal' => Cart::instance('cart')->subtotal(),
                'total' => Cart::instance('cart')->total()
            ]);
    }

    public function order_confirmation(Request $request)
    {
        // if (Session()->has('order_id')) {
        //     $order = orders::find(Session()->get('order_id'));
        //     return view('pages.order-confirmation',compact('order'));
        // }
        $orderId = $request->input('order_id');

        try {
            // 3. Ambil status transaksi dari Midtrans API
            $status = MidtransTransaction::status($orderId); // object stdClass
            if (is_array($status)) {
                $status = json_decode(json_encode($status)); // Konversi array ke object jika perlu
            }

            // 4. Cari transaksi di database lokal
            $transaction = Transaction::where('order_id', $orderId)->first();

            if (!$transaction) {
                return redirect()->route('pages.index')->with('error', 'Transaksi tidak ditemukan di database.');
            }

            // 5. Update status transaksi berdasarkan Midtrans
            switch ($status->transaction_status) {
                case 'settlement':
                    $transaction->status = 'approved';
                    break;
                case 'pending':
                    $transaction->status = 'pending';
                    break;
                case 'cancel':
                case 'expire':
                case 'deny':
                    $transaction->status = 'declined';
                    break;
                default:
                    $transaction->status = 'unknown';
                    break;
            }

            $transaction->save();

            return redirect()->route('pages.orders',compact('transaction'))->with('success', 'Status transaksi berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('pages.orders')->with('error', 'Gagal memproses status pembayaran: ' . $e->getMessage());
        }
        return redirect()->route('pages.cart.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    
}
