<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\categories;
use App\Models\Brands;
use App\Models\product_prices;
use App\Models\suppliers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::with(['brand', 'supplier', 'category'])->orderBy('id', 'asc')->paginate(10);
        return view("dashboard.products",compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = categories::Select('id','name')->orderBy('id')->get();
        $brands = Brands::Select('id','name')->orderBy('id')->get();
        $suppliers = suppliers::Select('id','name')->orderBy('id')->get();

        return view("dashboard.products-add",compact('categories','brands','suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug',
            'category_id' => 'required',
            'brand_id' => 'required',
            'supplier_id' => 'required',
            'description' => 'required',
            'quantity' => 'required|numeric|min:0',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'price' => 'required',
        ]);
        $product = new products();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->supplier_id = $request->supplier_id;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if(File::exists(public_path('uploads/products').'/'.$product->image))
            {File::delete(public_path('uploads/products').'/'.$product->image);}
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('uploads/products'), $imageName);        
            $product->image = $imageName;
        }
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->save();
        return redirect()->route('admin.products')->with('status', 'Record has been added successfully!');
    }



    /**
     * Display the specified resource.
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {


        $categories = categories::all();
        $brands = Brands::all();
        $suppliers = suppliers::all();
        $product = products::findOrFail($id); // Gunakan findOrFail agar error jika ID tidak ditemukan

        return view('dashboard.products-edit', [
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands,
            'suppliers' => $suppliers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug,'.$request->id,
            'category_id' => 'required',
            'brand_id' => 'required',
            'supplier_id' => 'required',
            'description' => 'required',
            'quantity' => 'required|numeric|min:0',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'price' => 'required',
        ]);
        $product = products::find($request->id);
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->supplier_id = $request->supplier_id;
        if ($request->hasFile('image')) {
            if(File::exists(public_path('uploads/products').'/'.$product->image))
            {
                File::delete(public_path('uploads/products').'/'.$product->image);
            }
            if(File::exists(public_path('uploads/products/thumbnails').'/'.$product->image))
            {
                File::delete(public_path('uploads/products/thumbnails').'/'.$product->image);
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('uploads/products'), $imageName); // Menyimpan gambar ke folder uploads/products
            $product->image = $imageName; // Menyimpan nama gambar ke database
        }
        $product->save();
        return redirect()->route('admin.products')->with('status','Record has been updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $products = products::find($id);
        $products->delete();
        return redirect()->route('admin.products')->with('status','Record has been deleted successfully !');
    }
}
