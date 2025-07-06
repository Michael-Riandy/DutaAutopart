<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\products;
use App\Models\Slide;
use App\Models\Contact;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Slide::where('status',1)->get()->take(3);
        $categories = categories::orderBy('name')->get();
        $sproducts = products::whereNotNull('price')->where('price','<>','')->inRandomOrder()->get()->take(8);
        return view('pages.index', compact('slides','categories','sproducts'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact_store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'comment' => 'required'
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->comment = $request->comment;
        $contact->save();
        return redirect()->back()->with('success','Comment anda telah dikirimkan!');
    }

}
