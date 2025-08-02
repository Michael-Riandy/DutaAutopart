<?php

namespace App\Http\Controllers;

use App\Models\order_details;
use App\Models\orders;
use App\Models\products;
use App\Models\Transaction;
use App\Models\Slide;
use App\Models\Contact;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function index()
    {
        $orders = orders::orderBy('created_at','DESC')->get()->take(10);
        $dashboardDatas = DB::select("Select sum(total) As TotalAmount,
                                    sum(if(status='ordered',total,0)) As TotalOrderedAmount,
                                    sum(if(status='delivered',total,0)) As TotalDeliveredAmount,
                                    sum(if(status='canceled',total,0)) As TotalCanceledAmount,
                                    Count(*) As Total,
                                    sum(if(status='ordered',1,0)) As TotalOrdered,
                                    sum(if(status='delivered',1,0)) As TotalDelivered,
                                    sum(if(status='canceled',1,0)) As TotalCanceled
                                    From Orders
                                    ");

        $monthlyDatas = DB::select("SELECT M.id As MonthNo, M.name As MonthName,
                                    IFNULL(D.TotalAmount,0) As TotalAmount,
                                    IFNULL(D.TotalOrderedAmount,0) As TotalOrderedAmount,
                                    IFNULL(D.TotalDeliveredAmount,0) As TotalDeliveredAmount,
                                    IFNULL(D.TotalCanceledAmount,0) As TotalCanceledAmount FROM month_names M 
                                    LEFT JOIN (Select DATE_FORMAT(created_at, '%b') As MonthName,
                                    MONTH(created_at) As MonthNo,
                                    sum(total) As TotalAmount,
                                    sum(if(status='ordered',total,0)) As TotalOrderedAmount,
                                    sum(if(status='delivered',total,0)) As TotalDeliveredAmount,
                                    sum(if(status='canceled',total,0)) As TotalCanceledAmount
                                    From Orders WHERE YEAR(created_at)=YEAR(NOW()) GROUP BY YEAR(created_at), MONTH(created_at), DATE_FORMAT(created_at, '%b')
                                    Order By MONTH(created_at)) D On D.MonthNo=M.id ");

        $AmountM = implode(',', collect($monthlyDatas)->pluck('TotalAmount')->toArray());
        $OrderedAmountM = implode(',', collect($monthlyDatas)->pluck('TotalOrderedAmount')->toArray());
        $DeliveredAmountM = implode(',', collect($monthlyDatas)->pluck('TotalDeliveredAmount')->toArray());
        $CanceledAmountM = implode(',', collect($monthlyDatas)->pluck('TotalCanceledAmount')->toArray());

        $TotalAmount = collect($monthlyDatas)->sum('TotalAmount');
        $TotalOrderedAmount = collect($monthlyDatas)->sum('TotalOrderedAmount');
        $TotalDeliveredAmount = collect($monthlyDatas)->sum('TotalDeliveredAmount');
        $TotalCanceledAmount = collect($monthlyDatas)->sum('TotalCanceledAmount');


            return view("dashboard.dashboard", compact('orders','dashboardDatas','AmountM','OrderedAmountM','DeliveredAmountM',
            'CanceledAmountM','TotalOrderedAmount','TotalDeliveredAmount','TotalCanceledAmount','TotalAmount'));
    }

    public function orders()
    {
        $orders = orders::orderBy('created_at','DESC')->paginate(12);
        return view('dashboard.orders',compact('orders'));
    }

    public function order_details($order_id)
    {
        $order = orders::find($order_id);
        $orderItems = order_details::where('order_id',$order_id)->orderBy('id')->paginate(12);
        $transaction = Transaction::where('order_id',$order_id)->first();
        return view('dashboard.order-details',compact('order','orderItems','transaction'));
    }

    public function update_order_status(Request $request)
    {
        $order = orders::find($request->order_id);
        $order->status = $request->order_status;
        if ($request->order_status == 'delivered') {
            $order->delivered_date = Carbon::now();
        }
        else if ($request->order_status == 'canceled') {
            $order->canceled_date = Carbon::now();
        }
        $order->save();

        return back()->with("status","Status berhasil diubah!");
    }

    public function slides()
    {
        $slides = Slide::orderBy('id','DESC')->paginate(12);
        return view('dashboard.slides',compact('slides'));
    }

    public function slide_add()
    {
        return view('dashboard.slide-add');

    }

    public function slide_store(Request $request)
    {
        $request->validate([
            'tagline' => 'required',
            'title' => 'required',
            'subtitle' => 'required',
            'link' => 'required',
            'status' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);
        $slide = new Slide();
        $slide->tagline = $request->tagline;
        $slide->title = $request->title;
        $slide->subtitle = $request->subtitle;
        $slide->link = $request->link;
        $slide->status = $request->status;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if(File::exists(public_path('uploads/slides').'/'.$slide->image))
            {
                File::delete(public_path('uploads/slides').'/'.$slide->image);
            }

            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('uploads/slides'), $imageName);     
            $slide->image = $imageName;
        }
        $slide->save();
        return redirect()->route('admin.slides')->with("status","Slide berhasil ditambahkan!");
    }
    public function slide_edit($id)
    {
        $slide = Slide::find($id);
        return view('dashboard.slide-edit',compact('slide'));
    }

    public function slide_update(Request $request)
    {
        $request->validate([
            'tagline' => 'required',
            'title' => 'required',
            'subtitle' => 'required',
            'link' => 'required',
            'status' => 'required',
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);
        $slide = Slide::find($request->id);
        $slide->tagline = $request->tagline;
        $slide->title = $request->title;
        $slide->subtitle = $request->subtitle;
        $slide->link = $request->link;
        $slide->status = $request->status;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if(File::exists(public_path('uploads/slides').'/'.$slide->image))
            {
                File::delete(public_path('uploads/slides').'/'.$slide->image);
            }

            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('uploads/slides'), $imageName);
                     
            $slide->image = $imageName;
        }
        $slide->save();
        return redirect()->route('admin.slides')->with("status","Slide berhasil diupdate!");
    }

    public function slide_delete($id)
    {
        $slide = Slide::find($id);
        if(File::exists(public_path('uploads/slides').'/'.$slide->image))
        {
            File::delete(public_path('uploads/slides').'/'.$slide->image);
        }
        $slide->delete();
        return redirect()->route('admin.slides')->with("status","Slide berhasil dihapus!");
    }

    public function contacts()
    {
        $contacts = Contact::orderBy('created_at','DESC')->paginate(10);
        return view('dashboard.contacts', compact('contacts'));
    }

    public function contact_delete($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return redirect()->route('admin.contacts')->with("status","Pesan berhasil dihapus!");
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $result = products::where('name','LIKE',"%{$query}%")->get()->take(8);
        return response()->json($result);
    }
}