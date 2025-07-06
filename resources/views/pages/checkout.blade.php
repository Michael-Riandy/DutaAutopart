@extends('layouts.main')
@section('container')

<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
      <h2 class="page-title">Shipping and Checkout</h2>
      <div class="checkout-steps">
        <a href="{{ route('pages.cart.index') }}" class="checkout-steps__item active">
          <span class="checkout-steps__item-number">01</span>
          <span class="checkout-steps__item-title">
            <span>Shopping Bag</span>
            <em>Manage Your Items List</em>
          </span>
        </a>
        <a href="javascript:void(0)" class="checkout-steps__item active">
          <span class="checkout-steps__item-number">02</span>
          <span class="checkout-steps__item-title">
            <span>Shipping and Checkout</span>
            <em>Checkout Your Items List</em>
          </span>
        </a>
        <a href="javascript:void(0)" class="checkout-steps__item">
          <span class="checkout-steps__item-number">03</span>
          <span class="checkout-steps__item-title">
            <span>Confirmation</span>
            <em>Review And Submit Your Order</em>
          </span>
        </a>
      </div>
      <form name="checkout-form" action="{{ route('pages.cart.place.an.order') }}" method="POST">
        @csrf
        <div class="checkout-form">
          <div class="billing-info__wrapper">
            <div class="row">
              <div class="col-6">
                <h4>SHIPPING DETAILS</h4>
              </div>
              <div class="col-6">
              </div>
            </div>
            @if ($addresses)
                <div class="row">
                    <div class="col-md-12">
                        <div class="my-account__address-list">
                            <div class="my-account__address-list-item">
                                <div class="my-account__address-item__detail">
                                    <p>{{ $addresses->name }}</p>
                                    <p>{{ $addresses->address }}</p>
                                    <p>{{ $addresses->city }}</p>
                                    <br>
                                    <p>{{ $addresses->phone }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
            <div class="row mt-5">
              <div class="col-md-6">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" name="name" required value="{{ old('name') }}">
                  <label for="name">Full Name / Company *</label>
                  <span class="text-danger">@error('name') {{$message}} @enderror</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" name="phone" required value="{{ old('phone') }}">
                  <label for="phone">Phone Number *</label>
                  <span class="text-danger">@error('phone') {{$message}} @enderror</span>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" name="address" required="" value="{{ old('address') }}">
                  <label for="address">Address *</label>
                  <span class="text-danger">@error('address') {{$message}} @enderror</span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-floating mt-3 mb-3">
                  <input type="text" class="form-control" name="city" required="" value="{{ old('city') }}">
                  <label for="city">City *</label>
                  <span class="text-danger">@error('city') {{$message}} @enderror</span>
                </div>
              </div>
              
            </div>
            @endif
          </div>
          <div class="checkout__totals-wrapper">
            <div class="sticky-content">
              <div class="checkout__totals">
                <h3>Your Order</h3>
                <table class="checkout-cart-items">
                  <thead>
                    <tr>
                      <th>PRODUCT</th>
                      <th align="right">SUBTOTAL</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach (Cart::instance('cart') as $item)
                    <tr>
                      <td>
                        {{ $item->name }} x {{ $item->qty }}
                      </td>
                      <td align="right">
                        ${{ $item->subtotal() }}
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <table class="checkout-totals">
                  <tbody>
                    <tr>
                      <th>SUBTOTAL</th>
                      <td align="right">{{ Cart::instance('cart')->subtotal() }}</td>
                    </tr>
                    <tr>
                      <th>SHIPPING</th>
                      <td align="right">Terms and Condition</td>
                    </tr>
                    <tr>
                      <th>TOTAL</th>
                      <td align="right">{{ Cart::instance('cart')->total() }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="checkout__payment-methods">
          
                <div class="form-check">
                  <input class="form-check-input form-check-input_fill" type="radio" name="mode" id="mode1" value="transfer">
                  <label class="form-check-label" for="mode1">
                    Transfer
                    <p class="option-detail">
                      Transfer Bank adalah metode pembayaran di mana Anda melakukan pembayaran secara manual ke rekening resmi kami melalui ATM, mobile banking, atau internet banking. Anda juga dapat melakukan pembayaran melalui QRIS, Gopay, Ovo dan lainnya.
                      <br>
                      <b>Catatan</b>
                      <br>
                      - Pastikan nominal dan nomor rekening tujuan sesuai dengan yang tertera saat checkout.
                      <br>
                      - Verifikasi pembayaran membutuhkan waktu maksimal 1x24 jam.
                    </p>
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input form-check-input_fill" type="radio" name="mode" id="mode2" value="cod">
                  <label class="form-check-label" for="mode2">
                    Cash on delivery
                    <p class="option-detail">
                      COD (Cash on Delivery) adalah metode pembayaran di mana Anda membayar langsung kepada kurir saat pesanan tiba di alamat tujuan. Metode ini memberikan kenyamanan dan keamanan karena pembayaran dilakukan setelah produk diterima.
                      <br>
                      <b>Catatan</b>
                      <br>
                      - COD hanya tersedia untuk area tertentu sesuai cakupan jasa pengiriman.
                      <br>
                      - Harap siapkan uang tunai yang pas saat kurir datang untuk mempercepat proses pengantaran.
                    </p>
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input form-check-input_fill" type="radio" name="mode" id="mode3" value="invoice">
                  <label class="form-check-label" for="mode3">
                    Invoice
                    <p class="option-detail">
                      Invoice adalah metode pembayaran berbasis tagihan, biasanya digunakan untuk pelanggan atau perusahaan yang memerlukan bukti pembayaran formal terlebih dahulu sebelum melakukan pelunasan.
                      <br>
                      <b>Catatan</b>
                      <br>
                      - Tagihan akan dikirim ke email Anda setelah konfirmasi pesanan.
                      <br>
                      - Cocok untuk pembelian dalam jumlah besar atau pembelian instansi/perusahaan.
                    </p>
                  </label>
                </div>
              </div>
              <button class="btna btn-primary btna-checkout">PLACE ORDER</button>
            </div>
          </div>
        </div>
      </form>
    </section>
  </main>

@endsection
