<?php

namespace Tests\Feature;

use App\Models\order_details;
use App\Models\orders;
use App\Models\products;
use App\Models\Transaction;
use App\Models\Slide;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_redirects_if_not_authenticated()
    {
        $response = $this->get('/admin');

        $response->assertRedirect('/login'); // atau route login yang kamu pakai
    }

    public function test_admin_dashboard_shows_for_authenticated_admin()
    {
        $admin = User::factory()->create([
            'role' => 'admin', // sesuaikan dengan field yang membedakan admin
        ]);

        $response = $this->actingAs($admin)->get('/admin');

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.dashboard'); // sesuaikan dengan view yang digunakan
    }

    public function test_admin_orders_page_loads_correctly()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        orders::factory()->count(3)->create();

        $this->actingAs($admin)
            ->get(route('admin.orders')) // pastikan route ini ada
            ->assertStatus(200)
            ->assertViewIs('dashboard.orders')
            ->assertViewHas('orders');
    }

//     public function test_order_details_page_loads_correctly()
//     {
//         $this->withoutExceptionHandling();

//         $admin = User::factory()->create(['role' => 'admin']);
//     $this->actingAs($admin);

//     $product = \App\Models\products::factory()->create();

//     $order = \App\Models\orders::factory()->create([
//         'user_id' => $admin->id,
//     ]);

//     \App\Models\order_details::factory()->create([
//         'order_id' => $order->id,
//         'product_id' => $product->id,
//         'price' => 10000,
//         'quantity' => 2,
//     ]);

//     \App\Models\Transaction::factory()->create([
//         'user_id' => $admin->id,
//         'order_id' => $order->id,
//         'snap_token' => 'dummy-token',
//         'mode' => 'cod',
//         'status' => 'pending',
//     ]);

//     $response = $this->get(route('admin.order.details', ['order_id' => $order->id]));
//     $response->assertStatus(200);
//    $response->assertViewIs('dashboard.order-details');

//     }

    public function test_update_order_status_to_delivered()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $order = orders::factory()->create(['status' => 'ordered']);

        $this->actingAs($admin)
            ->put(route('admin.order.status.update'), [
                'order_id' => $order->id,
                'order_status' => 'delivered',
            ])
            ->assertRedirect()
            ->assertSessionHas('status', 'Status berhasil diubah!');

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'delivered',
        ]);
    }

    public function test_slide_list_and_add_form_display()
    {
        Storage::fake('public');

        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $response = $this->post('/admin/slide/store', [
            'tagline' => 'Tagline',
            'title' => 'Title',
            'subtitle' => 'Sub Judul',
            'link' => 'https://example.com',
            'status' => 1,
            'image' => UploadedFile::fake()->image('slide.jpg'),
        ]);

        $response->assertRedirect('/admin/slides');
        $this->assertDatabaseHas('slides', ['tagline' => 'Tagline']);
    }

public function test_admin_can_view_contacts()
{
    $admin = User::factory()->create(['role' => 'admin']);
    Contact::factory()->count(3)->create();

    $this->actingAs($admin)
        ->get(route('admin.contacts'))
        ->assertStatus(200)
        ->assertViewHas('contacts');
}
public function test_product_search_returns_expected_results()
{
    $admin = User::factory()->create(['role' => 'admin']);
    $product = products::factory()->create(['name' => 'Ban Mobil']);

    $response = $this->actingAs($admin)
        ->get(route('admin.search', ['query' => 'Ban']));

    $response->assertStatus(200)
             ->assertJsonFragment(['name' => 'Ban Mobil']);
}



}
