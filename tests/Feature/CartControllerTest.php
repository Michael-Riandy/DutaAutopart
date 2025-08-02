<?php

namespace Tests\Feature;

use App\Models\products;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Str;


class CartControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Session::start(); // Simulasi session
    }
    public function test_cart_index()
    {
        $this->withoutMiddleware(); // Nonaktifkan semua middleware
        $response = $this->get('/cart');
        $response->assertStatus(200); 
        $response->assertViewIs('pages.cart');
    }

    public function test_add_to_cart()
    {
        $this->withoutMiddleware(); // Nonaktifkan semua middleware
        $product = products::factory()->create();   

        $response = $this->post('/cart/store', [
            'id' => $product->id,
            'name' => $product->name,
            'quantity' => 2,
            'price' => $product->price,
        ]);

        $response->assertRedirect();

        $item = Cart::instance('cart')->content()->first();
        $this->assertEquals($product->id, $item->id);
        $this->assertEquals(2, $item->qty);
    }

    public function test_increase_cart_item()
    {
        $product = products::factory()->create();
        $item = Cart::instance('cart')->add($product->id, $product->name, 1, $product->price);

        $response = $this->get("/cart/increase-quantity/{$item->rowId}");

        $response->assertRedirect();
        $updatedItem = Cart::instance('cart')->get($item->rowId);
        $this->assertEquals(1, $updatedItem->qty);
    }

    public function test_decrease_cart_item()
    {
        $product = products::factory()->create();
        $item = Cart::instance('cart')->add($product->id, $product->name, 2, $product->price);

        $response = $this->get("/cart/decrease-quantity/{$item->rowId}");

        $response->assertRedirect();
        $updatedItem = Cart::instance('cart')->get($item->rowId);
        $this->assertEquals(2, $updatedItem->qty);
    }

    public function test_remove_cart_item()
    {
        $this->withoutExceptionHandling();
        $this->withoutMiddleware(); // Nonaktifkan semua middleware

        $product = products::factory()->create();

        // Add to cart
        $this->post('/cart/store', [
            'id' => $product->id,
            'name' => $product->name,
            'quantity' => 1,
            'price' => $product->price,
        ]);

        $item = Cart::instance('cart')->content()->first();
        $this->assertNotNull($item); // pastikan item ada
        $rowId = $item->rowId;

        // Remove from cart
        $response = $this->get("/cart/remove/{$rowId}");
        $response->assertRedirect();

        // Make sure it's gone
        $this->assertCount(0, Cart::instance('cart')->content());
    }

    public function test_empty_cart()
    {
        $this->withoutExceptionHandling();
        $this->withoutMiddleware(); // Nonaktifkan semua middleware

        $product = products::factory()->create();

        // Tambahkan produk ke keranjang
        $this->post('/cart/store', [
            'id' => $product->id,
            'name' => $product->name,
            'quantity' => 1,
            'price' => $product->price,
        ]);

        // Pastikan produk masuk
        $this->assertGreaterThan(0, Cart::instance('cart')->content()->count());

        // Kosongkan keranjang
        $response = $this->get('/cart/clear');
        $response->assertRedirect();

        // Reload session
        session()->save();

        // Periksa apakah keranjang benar-benar kosong
        $this->assertCount(0, Cart::instance('cart')->content());
    }

    public function test_checkout_redirects_if_not_logged_in()
    {
        $response = $this->get('/checkout');
        $response->assertRedirect('/login');
    }

    public function test_checkout_shows_view_if_logged_in()
    {
       $user = User::factory()->create();

        UserAddress::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user);

        $response = $this->get('/checkout');
        $response->assertStatus(200);
        $response->assertViewIs('pages.checkout');
    }

    public function test_place_an_order_with_new_address()
    {
        $user = User::factory()->create();
    $this->actingAs($user);

    // Tambahkan produk ke database dan ke cart
    $product = products::factory()->create([
        'quantity' => 10
    ]);

    Cart::instance('cart')->add(
        $product->id,
        $product->name,
        1, // qty
        $product->price
    )->associate(products::class);

    // Simulasikan session checkout
    session()->put('checkout', [
        'subtotal' => $product->price,
        'total' => $product->price
    ]);

    $response = $this->post('/place-an-order', [
        'name' => 'John Doe',
        'phone' => '081234567890',
        'address' => 'Jl. Jalan',
        'city' => 'Bandung',
        'mode' => 'cod',
    ]);

    $response->assertStatus(200); // karena di akhir return view('pages.order-confirmation')

    $this->assertDatabaseHas('user_addresses', [
        'user_id' => $user->id,
        'city' => 'Bandung'
    ]);

    $this->assertDatabaseHas('orders', [
        'user_id' => $user->id
    ]);

    $this->assertDatabaseHas('transactions', [
        'user_id' => $user->id,
        'mode' => 'cod'
    ]);
    }
}
