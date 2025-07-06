@extends('layouts.main')
@section('container')
<style>
    .pt-90 {
      padding-top: 90px !important;
    }

    .pr-6px {
      padding-right: 6px;
    }

    .my-account .page-title {
      font-size: 1.5rem;
      font-weight: 700;
      text-transform: uppercase;
      margin-bottom: 40px;
      border-bottom: 1px solid;
      padding-bottom: 13px;
    }

    .my-account .wg-box {
      display: -webkit-box;
      display: -moz-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      padding: 24px;
      flex-direction: column;
      gap: 24px;
      border-radius: 12px;
      background: var(--White);
      box-shadow: 0px 4px 24px 2px rgba(20, 25, 38, 0.05);
    }

    .bg-success {
      background-color: #40c710 !important;
    }

    .bg-danger {
      background-color: #f44032 !important;
    }

    .bg-warning {
      background-color: #f5d700 !important;
      color: #000;
    }

    .table-transaction>tbody>tr:nth-of-type(odd) {
      --bs-table-accent-bg: #fff !important;

    }

    .table-transaction th,
    .table-transaction td {
      padding: 0.625rem 1.5rem .25rem !important;
      color: #000 !important;
    }

    .table> :not(caption)>tr>th {
      padding: 0.625rem 1.5rem .25rem !important;
      background-color: #6a6e51 !important;
    }

    .table-bordered>:not(caption)>*>* {
      border-width: inherit;
      line-height: 32px;
      font-size: 14px;
      border: 1px solid #e1e1e1;
      vertical-align: middle;
    }

    .table-striped .image {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 50px;
      height: 50px;
      flex-shrink: 0;
      border-radius: 10px;
      overflow: hidden;
    }

    .table-striped td:nth-child(1) {
      min-width: 250px;
      padding-bottom: 7px;
    }

    .pname {
      display: auto;
      gap: 50px;
    }

    .table-bordered> :not(caption)>tr>th,
    .table-bordered> :not(caption)>tr>td {
      border-width: 1px 1px;
      border-color: #6a6e51;
    }
  </style>  
<main class="pt-90" style="padding-top: 0px;">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">Order Details</h2>
        <div class="row">
            <div class="col-lg-2">
                <ul class="account-nav">
                    <li><a href="{{route('pages.account')}}" class="menu-link menu-link_us-s">Dashboard</a></li>
                    <li><a href="javascript:void(0)" class="menu-link menu-link_us-s menu-link_active">Orders</a></li>
                    <li><a href="{{ route('pages.account.address') }}" class="menu-link menu-link_us-s">Addresses</a></li>
                    {{-- <li><a href="account-details.html" class="menu-link menu-link_us-s">Account Details</a></li> --}}
                    <li>
                        <form method="POST" action="{{route('logout')}}" id="logout-form">
                            @csrf
                            <a href="{{route('logout')}}" class="" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                        </form>
                    </li>
                </ul>            
            </div>

            <div class="col-lg-10">
                <div class="wg-box">
                                    <div class="flex items-center justify-between gap10 flex-wrap">
                                        <div class="row">
                                            <div class="col-6">
                                                <h5>Ordered Details</h5>
                                            </div>
                                            <div class="col-6 text-right">
                                                <a class="btn btn-sm btn-danger" href="{{ route('pages.orders') }}">Back</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        @if (Session::has('status'))
                                            <p class="alert alert-success">{{ Session::get('status') }}</p>
                                        @endif
                                        <table class="table table-bordered table-striped table-transaction">
                                            <tr>
                                                <th>Order No</th>
                                                <td>{{ $order->id }}</td>
                                                <th>Mobile</th>
                                                <td>{{ $order->phone }}</td>
                                                <th>Order Status</th>
                                                <td>
                                                    @if($order->status=='delivered')
                                                        <span class="badge bg-success">Delivered</span>
                                                    @elseif($order->status=='canceled')
                                                        <span class="badge bg-danger">Canceled</span>
                                                    @else
                                                        <span class="badge bg-warning">Ordered</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Order Date</th>
                                                <td>{{ $order->created_at }}</td>
                                                <th>Delivered Date</th>
                                                <td>{{ $order->delivered_date }}</td>
                                                <th>Canceled Date</th>
                                                <td>{{ $order->canceled_date }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="wg-box">
                                    <div class="flex items-center justify-between gap10 flex-wrap">
                                        <div class="wg-filter flex-grow">
                                            <h5>Ordered Items</h5>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th class="text-center">Price</th>
                                                    <th class="text-center">Quantity</th>
                                                    <th class="text-center">Category</th>
                                                    <th class="text-center">Brand</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order_details as $item)
                                                <tr>

                                                    <td class="pname">
                                                        <div class="image">
                                                            <img src="{{ asset('uploads/products') }}/{{ $item->products->image }}" alt="{{ $item->products->name }}" class="image">
                                                        </div>
                                                        <div class="name">
                                                            <a href="{{ route('pages.shop.product.details',['product_slug'=>$item->products->slug]) }}" target="_blank"
                                                                class="body-title-2">{{ $item->products->name }}</a>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">Rp. {{ $item->price }}</td>
                                                    <td class="text-center">{{ $item->quantity }}</td>
                                                    <td class="text-center">{{ $item->products->category->name }}</td>
                                                    <td class="text-center">{{ $item->products->brand->name }}</td>
                                                    
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="divider"></div>
                                    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                                        {{ $order_details->links('pagination::bootstrap-5') }}
                                    </div>
                                </div>

                                <div class="wg-box mt-5">
                                    <h5>Shipping Address</h5>
                                    <div class="my-account__address-item col-md-6">
                                        <div class="my-account__address-item__detail">
                                            <p>{{ $order->name }}</p>
                                            <p>{{ $order->address }}</p>
                                            <p>{{ $order->city }}</p>
                                            <br>
                                            <p>Mobile : {{ $order->phone }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="wg-box mt-5">
                                    <h5>Transactions</h5>
                                    <table class="table table-striped table-bordered table-transaction">
                                        <tbody>
                                            <tr>
                                                <th>Subtotal</th>
                                                <td>Rp. {{ $order->subtotal }}</td>
                                                <th>Total</th>
                                                <td>Rp. {{ $order->total }}</td>
                                            </tr>
                                            <tr>
                                                <th>Payment Mode</th>
                                                <td>{{ $transaction->mode }}</td>
                                                <th>Status</th>
                                                <td>
                                                    <span id="payment-status-badge" class="badge bg-{{ $transaction->status === 'settlement' ? 'success' : 'warning' }}">
                                                        {{ ucfirst($transaction->status) }}
                                                    </span>
                                                    
                                                    <button id="check-payment-btn" class="btn btn-warning mt-2">
                                                        Cek Status Pembayaran
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @if ($transaction->status !== 'settlement')
                                    <button class="btna" type="submit" id="pay-button">Bayar Sekarang</button>
                                    @endif

                                </div>
                       
                                
                @if ($order->status=='ordered')
                    <div class="wg-box mt-5 text-right">                    
                    <form action="{{route('pages.order.cancel')}}" method="POST">
                        @csrf
                        @method("PUT")
                        <input type="hidden" name="order_id" value="{{$order->id}}" />
                        <button type="submit" class="cancel-order btn btn-danger">Cancel Order</button>                        
                    </form>
                    </div>
                @endif
            </div> 
        </div>
    </section>
</main>
@endsection

@section('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-6pj759eIHp4thin6"></script>
    <script type="text/javascript">
              document.getElementById('pay-button').onclick = function () {
                snap.pay('{{ $transaction->snap_token }}', {
                  onSuccess: function (result) {
                    console.log('Pembayaran berhasil', result);
                    
                    fetch('/midtrans/update-status', {
                      method: 'POST',
                      headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                      },
                      body: JSON.stringify({
                        order_id: result.order_id,
                        status: result.transaction_status,
                      })
                    })
                    .then(response => {
                      if (response.ok) {
                          alert('Berhasil menyimpan status pembayaran');
                      } else {
                          alert('Gagal menyimpan status pembayaran');
                      }
                    })
              },
                onPending: function (result) {
                  console.log('Pembayaran pending', result);
                },
              onError: function (result) {
                console.log('Terjadi error saat pembayaran', result);
              },
              onClose: function () {
                // ❗ Ketika user menutup snap tanpa menyelesaikan pembayaran
                fetch('/midtrans/on-close', {
                  method: 'POST',
                  headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                  },
                  body: JSON.stringify({
                    order_id: '{{ $transaction->order_id }}'
                  })
                }).then(response => {
                  console.log('User menutup pembayaran');
                });
              }
          });
    };
  </script>

<script>
        $(function(){
            $(".cancel-order").on('click',function(e){
                e.preventDefault();
                var selectedForm = $(this).closest('form');
                swal({
                    title: "Are you sure?",
                    text: "You want to cancel this order?",
                    type: "warning",
                    buttons: ["No!", "Yes!"],
                    confirmButtonColor: '#dc3545'
                }).then(function (willCancel) {
                    if (willCancel) {
                        selectedForm.submit();  
                    }
                });                             
            });
        });
    </script>

<script>
document.getElementById('check-payment-btn').addEventListener('click', function () {
    const button = this;
    button.disabled = true;
    button.textContent = 'Mengecek...';

    fetch("{{ route('orders.ajaxCheckPayment', $order->id) }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        button.disabled = false;
        button.textContent = 'Cek Status Pembayaran';

        if (data.status) {
            const badge = document.getElementById('payment-status-badge');
            badge.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);

            if (data.status === 'settlement') {
                badge.className = 'badge bg-success';
                button.disabled = true;
                button.textContent = 'Pembayaran Berhasil';

                const payButton = document.getElementById('pay-button');
                if (payButton) {
                    payButton.style.display = 'none';
                }
            } else {
                badge.className = 'badge bg-warning';
            }
        } else {
            alert('Pembayaran Belum Dilakukan');
        }
    })
    .catch(error => {
        alert('Pembayaran Belum Dilakukan');
        button.disabled = false;
        button.textContent = 'Cek Status Pembayaran';
    });
});
</script>

@endsection