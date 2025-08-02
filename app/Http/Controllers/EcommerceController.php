<?php

namespace App\Http\Controllers;

use App\Models\ecommerce;
use App\Models\products;
use App\Models\brands;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class EcommerceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $size = $request->input('size', 12);
        $o_column = "";
        $o_order = "";
        $order = $request->query('order') ? $request->query('order') : -1;
        $f_brands = $request->input('brands');
        $f_categories = $request->input('categories');

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

    // public function liveSearch(Request $request)
    // {
    //     $query = $request->input('query');

    //     $products = products::where('name', 'like', '%' . $query . '%')
    //         ->select('id', 'name', 'slug')
    //         ->limit(10)
    //         ->get();

    //     return response()->json($products);
    // }

    public function ajaxSearch(Request $request)
    {
        $query = $this->normalizeString($request->q);
        $produkList = products::all();
        $hasil = [];
        foreach ($produkList as $produk) {
            $nama = $this->normalizeString($produk->name);
            $deskripsi = $this->normalizeString($produk->description);
            $levNama = levenshtein($query, substr($nama, 0, strlen($query)));
            $levDeskripsi = levenshtein($query, substr($deskripsi, 0, strlen($query)));
            if (str_contains($nama, $query)) {
                $hasil[] = ['produk' => $produk, 'skor' => 0, 'prioritas' => 1];
            } elseif (str_contains($deskripsi, $query)) {
                $hasil[] = ['produk' => $produk, 'skor' => 0, 'prioritas' => 2];
            } elseif ($levNama <= 3) {
                $hasil[] = ['produk' => $produk, 'skor' => $levNama, 'prioritas' => 1];
            } elseif ($levDeskripsi <= 2) {
                $hasil[] = ['produk' => $produk, 'skor' => $levDeskripsi, 'prioritas' => 2];
            }
        }
        usort($hasil, fn($a, $b) =>
            $a['prioritas'] <=> $b['prioritas'] ?: $a['skor'] <=> $b['skor']
        );
        $topHasil = array_slice($hasil, 0, 5);
        if (empty($topHasil)) {
            return '<ul class="alert alert-warning list-group list-group-flush">Tidak ada hasil ditemukan</ul>';
        }
        $output = '<ul class="list-group list-group-flush">';
        foreach ($topHasil as $item) {
            $produk = $item['produk'];
            $url = route('pages.shop.product.details', ['product_slug' => $produk->slug]);
            $output .= '<a href="' . $url . '" class="list-group-item search-item">' .
                       e($produk->name) .
                    '</a>';
        }
        $output .= '</ul>';

        return $output;
    }

    private function normalizeString($text)
    {
        return strtolower(trim(preg_replace('/\s+/', ' ', $text)));
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
