@extends('layouts.main')
@section('container')

<main>

<section class="swiper-container js-swiper-slider swiper-number-pagination slideshow" data-settings='{
    "autoplay": {
      "delay": 4000
    },
    "slidesPerView": 1,
    "effect": "fade",
    "loop": true
  }'>
  <div class="swiper-wrapper">
    @foreach ($slides as $slide)
    <div class="swiper-slide">
      <div class="overflow-hidden position-relative h-100">
        <div class="slideshow-character position-absolute bottom-0 pos_right-center">
          <img loading="lazy" src="{{ asset('uploads/slides') }}/{{ $slide->image }}" width="691" height="700" style="object-fit: cover" class="slideshow-character__img animate animate_fade animate_btt animate_delay-9" />
          <div class="character_markup type2">
            <p class="text-uppercase font-sofia mark-grey-color animate animate_fade animate_btt animate_delay-10 mb-5">
              {{ $slide->tagline }}
            </p>
          </div>
        </div>
        <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
          <h6 class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">
            New Arrival
          </h6>
          <h2 class="h2 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5 w-50">{{ $slide->title }}</h2>
          <h1 class="fw-medium animate animate_fade animate_btt animate_delay-6 text-wrap" style="max-width: 600px; line-height: 1.4;">
    {{ $slide->subtitle }}
          </h1>
          <a href="{{ $slide->link }}" class="btn-link btn-link_lg default-underline fw-medium animate animate_fade animate_btt animate_delay-7">Shop
            Now</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <div class="container">
    <div class="slideshow-pagination slideshow-number-pagination d-flex align-items-center position-absolute bottom-0 mb-5">
    </div>
  </div>
</section>
<div class="container mw-1620 bg-white border-radius-10">
  <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>
  <section class="category-carousel container">
    <h2 class="section-title text-center mb-3 pb-xl-2 mb-xl-4">Category Product</h2>

    <div class="position-relative">
      <div class="swiper-container js-swiper-slider" data-settings='{
          "autoplay": {
            "delay": 3000
          },
          "slidesPerView": 8,
          "slidesPerGroup": 1,
          "effect": "none",
          "loop": true,
          "navigation": {
            "nextEl": ".products-carousel__next-1",
            "prevEl": ".products-carousel__prev-1"
          },
          "breakpoints": {
            "320": {
              "slidesPerView": 2,
              "slidesPerGroup": 2,
              "spaceBetween": 15
            },
            "768": {
              "slidesPerView": 4,
              "slidesPerGroup": 4,
              "spaceBetween": 30
            },
            "992": {
              "slidesPerView": 6,
              "slidesPerGroup": 1,
              "spaceBetween": 45,
              "pagination": false
            },
            "1200": {
              "slidesPerView": 8,
              "slidesPerGroup": 1,
              "spaceBetween": 0,
              "pagination": false
            }
          }
        }'>
        <div class="swiper-wrapper">
          @foreach ($categories as $category)
          <div class="swiper-slide category-buttons">
            <div class="text-center">
              <a href="{{ route('pages.shop.index',['categories'=>$category->id]) }}" class="btnc menu-link fw-medium">{{ $category->name }}</a>
            </div>
          </div>
          @endforeach
        </div><!-- /.swiper-wrapper -->
      </div><!-- /.swiper-container js-swiper-slider -->

      <div
        class="products-carousel__prev products-carousel__prev-1 position-absolute top-50 d-flex align-items-center justify-content-center">
        <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
          <use href="#icon_prev_md" />
        </svg>
      </div><!-- /.products-carousel__prev -->
      <div
        class="products-carousel__next products-carousel__next-1 position-absolute top-50 d-flex align-items-center justify-content-center">
        <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
          <use href="#icon_next_md" />
        </svg>
      </div><!-- /.products-carousel__next -->
    </div><!-- /.position-relative -->
  </section>

  <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

  <section class="hot-deals container">
    <h2 class="section-title text-center mb-3 pb-xl-3 mb-xl-4">New Arrival</h2>
    <div class="row">
      <div class="col-md-6 col-lg-8 col-xl-80per">
        <div class="position-relative">
          <div class="swiper-container js-swiper-slider" data-settings='{
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": 4,
              "slidesPerGroup": 4,
              "effect": "none",
              "loop": false,
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "slidesPerGroup": 2,
                  "spaceBetween": 14
                },
                "768": {
                  "slidesPerView": 2,
                  "slidesPerGroup": 3,
                  "spaceBetween": 24
                },
                "992": {
                  "slidesPerView": 3,
                  "slidesPerGroup": 1,
                  "spaceBetween": 30,
                  "pagination": false
                },
                "1200": {
                  "slidesPerView": 4,
                  "slidesPerGroup": 1,
                  "spaceBetween": 30,
                  "pagination": false
                }
              }
            }'>
            <div class="swiper-wrapper">
              @foreach ($sproducts as $sproduct)
              <div class="swiper-slide product-card product-card_style3">
                <div class="pc__img-wrapper">
                  <a href="{{ route('pages.shop.product.details',['product_slug'=>$sproduct->slug]) }}">
                    <img loading="lazy" src="{{ asset('uploads/products') }}/{{ $sproduct->image }}" width="258" height="313"
                      alt="{{ $sproduct->name }}" class="pc__img">
                  </a>
                </div>

                <div class="pc__info position-relative">
                  <h6 class="pc__title"><a href="{{ route('pages.shop.product.details',['product_slug'=>$sproduct->slug]) }}">{{ $sproduct->name }}</a></h6>
                  <div class="product-card__price d-flex">
                    <span class="money price text-secondary">Rp. {{ $sproduct->price }}</span>
                  </div>
                </div>
              </div>
              @endforeach
            </div><!-- /.swiper-wrapper -->
          </div><!-- /.swiper-container js-swiper-slider -->
        </div><!-- /.position-relative -->
      </div>
      <div
        class="col-md-6 col-lg-4 col-xl-20per d-flex align-items-center flex-column justify-content-center py-4 align-items-md-start">

        <a href="{{ route('pages.shop.index') }}" class="btn-link default-underline text-uppercase fw-medium mt-3">View All</a>
      </div>
    </div>
  </section>

  
</div>

<div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

</main>

@endsection
