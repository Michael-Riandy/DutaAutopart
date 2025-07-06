<?php

namespace App\Http\Controllers;

use App\Models\ecommerce;
use App\Models\products;
use App\Models\brands;
use App\Models\Categories;
use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $size = $request->query('size') ? $request->query('size') : 12;
        $o_column = "";
        $o_order = "";
        $order = $request->query('order') ? $request->query('order') : -1;
        $f_brands = $request->query('brands');
        $f_categories = $request->query('categories');
        switch ($order) {
            case 1:
                $o_column='created_at';
                $o_order='DESC';
                break;
            case 2:
                $o_column='created_at';
                $o_order='ASC';
                break;
            case 3:
                $o_column='price';
                $o_order='ASC';
                break;
            case 4:
                $o_column='price';
                $o_order='DESC';
                break;            
            default:
                $o_column='id';
                $o_order='DESC';
        }
        $brands = Brands::orderBy('name','ASC')->get();
        $categories = Categories::orderBy('name','ASC')->get();
        $products = Products::where(function($query) use($f_brands, $f_categories) {
            if (!empty($f_brands)) {
                $query->whereIn('brand_id', explode(',', $f_brands));
            }
            if (!empty($f_categories)) {
                $query->whereIn('category_id', explode(',', $f_categories));
            }
        })
        ->orderBy($o_column, $o_order)
        ->paginate($size);
        return view('pages.shop',compact('products','size','order','brands','f_brands','categories','f_categories'));
    }

    public function details($product_slug)
    {
        $product = Products::where("slug",$product_slug)->first();
        $rproducts = Products::where("slug","<>",$product_slug)->get()->take(8);
        return view('pages.details',compact("product","rproducts"));
    }

    public function liveSearch(Request $request)
    {
        $query = $request->input('query');

        $products = products::where('name', 'like', '%' . $query . '%')
            ->select('id', 'name', 'slug')
            ->limit(10)
            ->get();

        return response()->json($products);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ecommerce $ecommerce)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ecommerce $ecommerce)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ecommerce $ecommerce)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ecommerce $ecommerce)
    {
        //
    }
}
