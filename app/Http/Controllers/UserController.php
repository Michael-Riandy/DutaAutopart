<?php

namespace App\Http\Controllers;

use App\Models\order_details;
use App\Models\orders;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\products;
use Midtrans\Transaction as MidtransTransaction;

class UserController extends Controller
{
    public function index()
    {
        return view("pages.index");
    }

    public function orders()
    {
        $orders = orders::where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->paginate(10);
        return view('pages.orders',compact('orders'));

    }

    public function order_details($order_id)
    {
        $order = orders::where('user_id',Auth::user()->id)->where('id',$order_id)->first();
        if ($order) {
            $order_details = order_details::where('order_id',$order->id)->orderBy('id')->paginate(12);
            $transaction = Transaction::where('order_id',$order->id)->first();
            return view('pages.order-details',compact('order','order_details','transaction'));
        }else{
            return redirect()->route('login');
        }
    }

    public function order_cancel(Request $request)
    {
        $order = Orders::with('order_details')->findOrFail($request->order_id);

        foreach ($order->order_details as $detail) 
        {
            $product = products::find($detail->product_id);

            // tambahkan stok secara manual
            $product->quantity = $product->quantity + $detail->quantity;
            $product->save();
            $product->refresh();
        }

        $order->status = "canceled";
        $order->canceled_date = Carbon::now();
        $order->save();

        return back()->with('status', 'Order telah dibatalkan dengan sukses!');
    }

    public function checkPaymentStatus(orders $order)
    {
        // Ambil transaksi dari order
        $transaction = Transaction::where('order_id', $order->id)->first();

        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaksi belum tersedia untuk pesanan ini.');
        }

        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production', false);

        try {
            // Ambil status dari Midtrans
            $midtransStatus = MidtransTransaction::status($transaction->order_id);

            // Update status ke database
            $stat = $midtransStatus->transaction_status ?? 'unknown';
            $transaction->status = $stat; 
            $transaction->save();

            return redirect()->back()->with('success', 'Status pembayaran diperbarui: ' . $transaction->status);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengambil status pembayaran: ' . $e->getMessage());
        }
    }

    // public function order_cancel(Request $request)
    // {
    //     $order = orders::find($request->order_id);
    //     $transaction = Transaction::where('order_id',$request->order_id)->first();
    //     foreach ($order->order_details as $item) {
    //         $product = products::find($item->product_id);
    //         if ($product) {
    //             $product->increment('quantity', $item->qty); 
    //         }
    //     }

    //     // Update status pesanan
    //     $order->status = "canceled";
    //     $transaction->status = "declined";
    //     $order->canceled_date = Carbon::now();
    //     $transaction->save();
    //     $order->save();

    //     return back()->with("status", "Order telah dicancel dengan sukses!");
    // }
}
