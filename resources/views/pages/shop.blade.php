@extends('layouts.main')
@section('container')
<style>
  .brand-list li, .category-list li{
    line-height: 40px;
  }
  .brand-list li .chk-brand, .category-list li .chk-category{
    width: 1rem;
    height: 1rem;
    color: #e4e4e4;
    border: 0.125rem solid currentColor;
    border-radius: 0;
    margin-right: 0.75rem;
  }
</style>
<main class="pt-90">
    <section class="shop-main container d-flex pt-4 pt-xl-5">
        <div class="shop-sidebar side-sticky bg-body" id="shopFilter">
          <div class="aside-header d-flex d-lg-none align-items-center">
            <h3 class="text-uppercase fs-6 mb-0">Filter By</h3>
            <button class="btn-close-lg js-close-aside btn-close-aside ms-auto"></button>
          </div>

          <div class="pt-4 pt-lg-0"></div>

          <form method="GET" id="applyFilters">
            <div class="accordion" id="categories-list">
              <div class="accordion-item mb-4 pb-3">
                <h5 class="accordion-header" id="accordion-heading-1">
                  <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button" data-bs-toggle="collapse"
                    data-bs-target="#accordion-filter-1" aria-expanded="true" aria-controls="accordion-filter-1">
                    Product Categories
                    <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                      <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                        <path
                          d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                      </g>
                    </svg>
                  </button>
                </h5>
            <div id="accordion-filter-1" class="accordion-collapse collapse show border-0"
              aria-labelledby="accordion-heading-1" data-bs-parent="#categories-list">
              <div class="accordion-body px-0 pb-0 pt-3 category-list">
                <ul class="list list-inline mb-0">
                  @foreach ($categories as $category)
                    <li class="list-item">
                      <span class="menu-link py-1">
                        <input type="checkbox" name="categories" class="chk-category" value="{{ $category->id }}"
                          @if (in_array($category->id,explode(',',$f_categories))) checked= @endif>
                        {{ $category->name }}
                      </span>
                      <span class="text-right float-end">{{ $category->products->count() }}</span>
                    </li>
                  @endforeach
                  <button type="submit" class="btna btn-primary mt-3">Filter</button>
                </ul>
              </div>
            </div>
          </div>
        </div>
        </form>

        <form id="applyFilters" method="GET" action="{{ route('pages.shop.index') }}">
        <div class="accordion" id="brand-filters">
          <div class="accordion-item mb-4 pb-3">
            <h5 class="accordion-header" id="accordion-heading-brand">
              <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button" data-bs-toggle="collapse"
                data-bs-target="#accordion-filter-brand" aria-expanded="true" aria-controls="accordion-filter-brand">
                Brands
                <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                  <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                    <path
                      d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                  </g>
                </svg>
              </button>
            </h5>
            <div id="accordion-filter-brand" class="accordion-collapse collapse show border-0"
              aria-labelledby="accordion-heading-brand" data-bs-parent="#brand-filters">
              <div class="search-field multi-select accordion-body px-0 pb-0">
                <ul class="list list-inline mb-0 brand-list">
                  @foreach ($brands as $brand)
                      <li class="list-item">
                          <span class="menu-link py-1">
                            <input type="checkbox" name="brands" value="{{ $brand->id }}" class="chk-brand"
                            @if(in_array($brand->id,explode(',',$f_brands))) checked @endif>
                            {{ $brand->name }}
                          </span>
                          <span class="text-right float-end">
                            {{ $brand->products->count() }}
                          </span>
                      </li>
                  @endforeach
                  <button type="submit" class="btna btn-primary mt-3">Filter</button>
                </ul>
              </div>
            </div>
          </div>
        </div>
        </form>
      </div>

      <div class="shop-list flex-grow-1">
        <form method="GET" action="{{ url()->current() }}" class="">
        <div class="d-flex justify-content-between mb-4 pb-md-2">
          <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
            <a href="{{ route('pages.index') }}" class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
            <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
            <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">The Shop</a>
          </div>

          <div class="shop-acs d-flex align-items-center justify-content-between justify-content-md-end flex-grow-1">
            <select class="shop-acs__select form-select w-auto border-0 py-0 order-1 order-md-0" aria-label="Page Size" id="pagesize" name="pagesize" style="margin-right:20px;">
              <option value="12" {{ $size==12 ? 'selected':'' }}>Show</option>
              <option value="24" {{ $size==24 ? 'selected':'' }}>24</option>
              <option value="48" {{ $size==48 ? 'selected':'' }}>48</option>
              <option value="102" {{ $size==102 ? 'selected':'' }}>102</option>
            </select>

              <select name="order" id="order" class="shop-acs__select form-select w-auto border-0 py-0 order-1 order-md-0" onchange="this.form.submit()">
                  <option value="-1" {{ $order == -1 ? 'selected' : '' }}>Default</option>
                  <option value="1" {{ $order == 1 ? 'selected' : '' }}>Newest</option>
                  <option value="2" {{ $order == 2 ? 'selected' : '' }}>Oldest</option>
                  <option value="3" {{ $order == 3 ? 'selected' : '' }}>Price: Low to High</option>
                  <option value="4" {{ $order == 4 ? 'selected' : '' }}>Price: High to Low</option>
              </select>
          
            {{-- <select class="shop-acs__select form-select w-auto border-0 py-0 order-1 order-md-0" aria-label="Sort Items" name="orderby" id="orderby">
              <option value="-1" {{ $order == -1 ? 'selected':'' }}>Default</option>
              <option value="1" {{ $order == 1 ? 'selected':'' }}>Date, New To Old</option>
              <option value="2" {{ $order == 2 ? 'selected':'' }}>Date, Old To New</option>
              <option value="3" {{ $order == 3 ? 'selected':'' }}>Price, Low To High</option>
              <option value="4" {{ $order == 4 ? 'selected':'' }}>Price, High To Low</option>
            </select> --}}

            <div class="shop-asc__seprator mx-3 bg-light d-none d-md-block order-md-0"></div>

            <div class="col-size align-items-center order-1 d-none d-lg-flex">
              <span class="text-uppercase fw-medium me-2">View</span>
              <button class="btn-link fw-medium me-2 js-cols-size" data-target="products-grid" data-cols="2">2</button>
              <button class="btn-link fw-medium me-2 js-cols-size" data-target="products-grid" data-cols="3">3</button>
              <button class="btn-link fw-medium js-cols-size" data-target="products-grid" data-cols="4">4</button>
            </div>

            <div class="shop-filter d-flex align-items-center order-0 order-md-3 d-lg-none">
              <button class="btn-link btn-link_f d-flex align-items-center ps-0 js-open-aside" data-aside="shopFilter">
                <svg class="d-inline-block align-middle me-2" width="14" height="10" viewBox="0 0 14 10" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <use href="#icon_filter" />
                </svg>
                <span class="text-uppercase fw-medium d-inline-block align-middle">Filter</span>
              </button>
            </div>
          </div>
        </div>
        </form>

        <div class="products-grid row row-cols-2 row-cols-md-3" id="products-grid">
            @foreach ($products as $product)
            <div class="product-card-wrapper">
            <div class="product-card mb-3 mb-md-4 mb-xxl-5">
              <div class="pc__img-wrapper">
                <div class="swiper-container background-img js-swiper-slider" data-settings='{"resizeObserver": true}'>
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      @if($product->quantity > 0)
                      <a href="{{ route('pages.shop.product.details',['product_slug'=>$product->slug]) }}">
                        <img loading="lazy" src="{{ asset('uploads/products')}}/{{ $product->image }}" width="330" height="400" alt="{{ $product->name }}" class="pc__img">
                      </a>
                      @else
                      <div class="disabled-product">
                        <img loading="lazy" src="{{ asset('uploads/products')}}/{{ $product->image }}" width="330" height="400" alt="{{ $product->name }}" class="pc__img grayscale">
                      </div>
                      @endif
                    </div>
                    {{-- <div class="swiper-slide">
                        @foreach (explode(",",$product->images) as $gimg)
                            <a href="{{route('shop.product.details',["product_slug"=>$product->slug])}}">
                                <img loading="lazy" src="{{asset('uploads/products')}}/{{trim($gimg)}}" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                            </a>
                        @endforeach                                        
                    </div> --}}
                  </div>
                </div>
                @if(Cart::instance('cart')->content()->where('id',$product->id)->count()>0)
                  <a href="{{ route('pages.cart.index') }}" class="btna pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium btn-warning mb-3">Go to Cart</a>
                @else
                <form name="addtocart-form" method="post" action="{{ route('pages.cart.store') }}">
                  @csrf
                  <input type="hidden" name="id" value="{{ $product->id }}">
                  <input type="hidden" name="quantity" value="1">
                  <input type="hidden" name="name" value="{{ $product->name }}">
                  <input type="hidden" name="price" value="{{ $product->price }}">
                  <button type="submit"
                  class="btna pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium add-to-cart-btn 
                  {{ $product->quantity <= 0 ? 'btn-secondary disabled-btn' : 'btn-primary' }}"
                  data-aside="cartDrawer"
                  title="{{ $product->quantity <= 0 ? 'Stok produk habis' : 'Add To Cart' }}"
                  data-stock="{{ $product->quantity }}"
                  data-product-name="{{ $product->name }}"
                  {{ $product->quantity <= 0 ? 'disabled' : '' }}>
                  {{ $product->quantity <= 0 ? 'Stok Habis' : 'Add To Cart' }}
                </button>
              </form>
                @endif
              </div>

              <div class="pc__info position-relative">
                <p class="pc__category">{{ $product->category->name }}</p>
                <h6 class="pc__title"><a href="{{ route('pages.shop.product.details',['product_slug'=>$product->slug]) }}">{{ $product->name }}</a></h6>
                <div class="product-card__price d-flex">
                  <span class="money price">{{ $product->price }}</span>
                </div>
                {{-- <div class="product-card__review d-flex align-items-center">
                  <div class="reviews-group d-flex">
                    <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                      <use href="#icon_star" />
                    </svg>
                    <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                      <use href="#icon_star" />
                    </svg>
                    <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                      <use href="#icon_star" />
                    </svg>
                    <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                      <use href="#icon_star" />
                    </svg>
                    <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                      <use href="#icon_star" />
                    </svg>
                  </div>
                  <span class="reviews-note text-lowercase text-secondary ms-1">8k+ reviews</span>
                </div> --}}

                {{-- <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist"
                  title="Add To Wishlist">
                  <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <use href="#icon_heart" />
                  </svg>
                </button> --}}
              </div>
            </div>
          </div>
            @endforeach

        </div>

        <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">                
                {{$products->withQueryString()->links('pagination::bootstrap-5')}}
            </div>
        </div>
    </section>
</main>

<form id="frmfilter" method="GET" action="{{ route('pages.shop.index') }}">
  <input type="hidden" name="page" value="{{ $products->currentPage() }}">
  <input type="hidden" name="size" value="{{ $size }}" >
  <input type="hidden" name="order" id="order" value="{{ $order }}">
  <input type="hidden" name="brands" id="hdnBrands">
  <input type="hidden" name="categories" id="hdnCategories">
</form>

@endsection

@push('scripts')
    <script>
      $(function(){
        $("#pagesize").on("change", function(){
          $("#size").val($("#pagesize option:selected").val());
          $("#frmfilter").submit();
        });

        $("#orderby").on("change", function(){
          $("#order").val($("#orderby option:selected").val());
          $("#frmfilter").submit();
        });

        $("input[name='brands']").on("change",function(){
          var brands ="";
            $("input[name='brands']:checked").each(function(){
              if(brands=="")
              {
                brands += $(this).val();
              }
              else{
                brands += "," + $(this).val();
              }
            });
          $("#hdnBrands").val(brands);
          $("#frmfilter").submit();
        });

        $("input[name='categories']").on("change",function(){
          var categories ="";
            $("input[name='categories']:checked").each(function(){
              if(categories=="")
              {
                categories += $(this).val();
              }
              else{
                categories += "," + $(this).val();
              }
            });
          $("#hdnCategories").val(categories);
          $("#frmfilter").submit();
        });
      });
    </script>
    <script>
      function applyFilters() {
          let brands = Array.from(document.querySelectorAll('.chk-brand:checked')).map(cb => cb.value);
          let categories = Array.from(document.querySelectorAll('.chk-category:checked')).map(cb => cb.value);
      
          let params = new URLSearchParams(window.location.search);
          if (brands.length > 0) params.set('brands', brands.join(','));
          else params.delete('brands');
      
          if (categories.length > 0) params.set('categories', categories.join(','));
          else params.delete('categories');
      
          window.location.search = params.toString();
      }
      
      document.querySelectorAll('.chk-brand, .chk-category').forEach(el => {
          el.addEventListener('change', applyFilters);
      });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.add-to-cart-btn').forEach(function(button) {
            button.addEventListener('click', function(e) {
                const quantity = parseInt(this.dataset.quantity);
                const productName = this.dataset.name;

                if (quantity <= 0) {
                    e.preventDefault(); // Hindari submit atau redirect
                    alert(`Maaf, stok produk "${productName}" sudah habis.`);
                    return false;
                }
            });
        });
    });
</script>



@endpush
