@extends('layouts.main')
@section('container')

<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
      <h2 class="page-title">My Account</h2>
      <div class="row">
        <div class="col-lg-3">
          <ul class="account-nav">
            <li><a href="javascript:void(0)" class="menu-link menu-link_us-s menu-link_active">Dashboard</a></li>
            <li><a href="{{ route('pages.orders') }}" class="menu-link menu-link_us-s">Orders</a></li>
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
        <div class="col-lg-9">
          <div class="page-content my-account__dashboard">
            <p>Hello <strong>{{ Auth::check() ? Auth::user()->name : 'Guest' }}</strong></p>
            <p>From your account dashboard you can view your <a class="unerline-link" href="{{ route('pages.orders') }}">recent
                orders</a>, manage your <a class="unerline-link" href="account_edit_address.html">shipping
                addresses</a>, and <a class="unerline-link" href="account_edit.html">edit your password and account
                details.</a></p>
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection