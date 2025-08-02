<?php

namespace Tests\Feature;

use App\Models\brands;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\products;

use App\Models\categories;

class EcommerceControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_can_be_accessed()
    {
        $response = $this->get('/shop');
        $response->assertStatus(200);
        $response->assertViewIs('pages.shop');
    }
    public function test_products_page_can_be_accessed()
    {
        $response = $this->get('/shop');
        $response->assertStatus(200);
        $response->assertViewIs('pages.shop');
    }

    public function test_product_detail_page_displays_correct_product()
    {
       $category = categories::factory()->create();
        $brand = brands::factory()->create();

        // Buat produk menggunakan category dan brand yang valid
        $product = Products::factory()->create([
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ]);

        // Tes route detail
        $response = $this->get(route('pages.shop.product.details', [
            'product_slug' => $product->slug,
        ]));

        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    public function test_ajax_search_returns_expected_products()
    {
        // Setup kategori dan brand
        $category = categories::factory()->create();
        $brand = brands::factory()->create();

        // Produk yang cocok
        $product1 = Products::factory()->create([
            'name' => 'Kampas Rem Racing',
            'description' => 'Performa tinggi untuk kecepatan maksimal',
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ]);

        // Produk lain yang tidak cocok
        $product2 = Products::factory()->create([
            'name' => 'Oli Mesin',
            'description' => 'Pelumas mesin premium',
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ]);

        // Request pencarian
        $response = $this->get('/search/ajax'); // pastikan ini sesuai route-mu

        $response->assertStatus(200);
        $response->assertSee('Kampas Rem Racing');
    }

    public function test_ajax_search_returns_no_results_message()
    {
        $response = $this->get('/search/ajax'); // asumsi tidak cocok dengan apapun

        $response->assertStatus(200);
        $response->assertSee('Tidak ada hasil ditemukan');
    }
}
