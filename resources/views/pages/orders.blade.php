@extends('layouts.main')
@section('container')
<style>
    .table> :not(caption)>tr>th {
      padding: 0.625rem 1.5rem .625rem !important;
      background-color: #6a6e51 !important;
    }

    .table>tr>td {
      padding: 0.625rem 1.5rem .625rem !important;
    }

    .table-bordered> :not(caption)>tr>th,
    .table-bordered> :not(caption)>tr>td {
      border-width: 1px 1px;
      border-color: #6a6e51;
    }

    .table> :not(caption)>tr>td {
      padding: .8rem 1rem !important;
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
  </style>  
<main class="pt-90" style="padding-top: 0px;">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">Orders</h2>
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
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="tablee table-bordered">
                            <thead class="custom-thead">
                                <tr>
                                    <th style="width: 80px">OrderNo</th>
                                    <th>Name</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Subtotal</th>
                                    <th class="text-center">Total</th>
                                    
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Payment Status</th>
                                    <th class="text-center">Order Date</th>
                                    <th class="text-center">Items</th>
                                    <th class="text-center">Delivered On</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                
                                <tr>
                                    <td class="text-center">{{ $order->id }}</td>  
                                    <td class="text-center">{{ $order->name }}</td>
                                    <td class="text-center">{{ $order->phone }}</td>
                                    <td class="text-center">Rp. {{ $order->subtotal }}</td>
                                    <td class="text-center">Rp. {{ $order->total }}</td>
                                    
                                    <td class="text-center">
                                        @if($order->status=='delivered')
                                            <span class="badge bg-success">Delivered</span>
                                        @elseif($order->status=='canceled')
                                            <span class="badge bg-danger">Canceled</span>
                                        @else
                                            <span class="badge bg-warning">Ordered</span>
                                        @endif    
                                    </td>   
                                    <td class="text-center">
                                        @php
                                            $paymentStatus = optional($order->transaction)->status;
                                        @endphp
                                        @if($paymentStatus =='settlement')
                                            <span class="badge bg-success">Settlement</span>
                                        @elseif($paymentStatus =='declined')
                                            <span class="badge bg-danger">Declined</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $order->created_at }}</td>
                                    <td class="text-center">{{ $order->order_details->count() }}</td>
                                    <td class="text-center">{{ $order->delivered_date }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('pages.order.details',['order_id'=>$order->id]) }}">
                                        <div class="list-icon-function view-icon">
                                            <div class="item eye">
                                                <i class="fa fa-eye"></i>
                                            </div>                                        
                                        </div>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach                           
                            </tbody>
                        </table>                
                    </div>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">                
                    {{ $orders->links('pagination::bootstrap-5') }}
                </div>
            </div>
            
        </div>
    </section>
</main>
@endsection