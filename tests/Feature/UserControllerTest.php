<?php

namespace Tests\Feature;

use App\Models\orders;
use App\Models\brands;
use App\Models\categories;
use App\Models\order_details;
use App\Models\products;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Services\MidtransService;
use Mockery;



class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_index_page_requires_authentication()
    {
        $response = $this->get(route('pages.account'));
        $response->assertRedirect(route('login')); // asumsi route login pakai middleware auth
    }

    public function test_index_page_loads_successfully_for_authenticated_user()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('pages.account'));
        $response->assertStatus(200);
        $response->assertViewIs('pages.account');
    }

    public function test_orders_page_requires_authentication()
    {
        $response = $this->get(route('pages.orders')); // sesuaikan dengan route orders user kamu
        $response->assertRedirect(route('login'));
    }

    public function test_orders_page_loads_for_authenticated_user()
    {
        $user = User::factory()->create();
        orders::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get(route('pages.orders'));
        $response->assertStatus(200);
        $response->assertViewIs('pages.orders');
        $response->assertViewHas('orders');
    }

    public function test_order_details_page_shows_correct_data()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Buat kategori dan brand dulu
        $category = \App\Models\Categories::factory()->create();
        $brand = \App\Models\Brands::factory()->create();

        // Buat produk yang valid
        $product = \App\Models\Products::factory()->create([
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ]);

        // Buat order untuk user tersebut
        $order = \App\Models\Orders::factory()->create([
            'user_id' => $user->id,
        ]);

        // Buat order detail
        \App\Models\Order_Details::factory()->create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        // Buat transaksi
        \App\Models\Transaction::factory()->create([
            'user_id' => $user->id,
            'order_id' => $order->id,
            'snap_token' => 'dummy-token',
            'mode' => 'cod',
            'status' => 'pending',
        ]);

        // Akses halaman detail
        $response = $this->get("/account-orders/{$order->id}/details");
        $response->assertStatus(200);
        $response->assertViewIs('pages.order-details');
        $response->assertSee($product->name);
    }

    public function test_order_details_redirects_if_not_found()
    {
        $user = User::factory()->create();
        $otherUserOrder = Orders::factory()->create(); // bukan user yang login

        $response = $this->actingAs($user)->get(route('pages.order.details', $otherUserOrder->id));
        $response->assertRedirect(route('login'));
    }
    public function test_order_can_be_canceled_and_stock_updated()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Buat category dan brand agar tidak error foreign key
        $category = \App\Models\Categories::factory()->create();
        $brand = \App\Models\Brands::factory()->create();

        // Buat produk yang valid
        $product = \App\Models\products::factory()->create([
            'quantity' => 10,
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ]);

        // Buat order
        $order = \App\Models\orders::factory()->create([
            'user_id' => $user->id,
            'status' => 'ordered',
        ]);

        // Buat detail order
        order_details::factory()->create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        // Kirim request pembatalan
        $response = $this->post(route('pages.order.cancel'), [
            'order_id' => $order->id,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('status', 'Order telah dibatalkan dengan sukses!');

        // Pastikan status order berubah
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'canceled',
        ]);

        // Pastikan stok kembali
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'quantity' => 12, // 10 awal + 2 dari pembatalan
        ]);
    }

}
