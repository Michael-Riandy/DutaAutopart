<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>Duta Autopart</title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" type="text/css" href="{{ secure_asset('css/animate.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ secure_asset('css/animation.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ secure_asset('css/bootstrap.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ secure_asset('css/bootstrap-select.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ secure_asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ secure_asset('font/fonts.css') }}">
  <link rel="stylesheet" href="{{ secure_asset('icon/style.css') }}">
  {{-- <link rel="shortcut icon" href="{{ secure_asset('images/favicon.ico') }}">
  <link rel="apple-touch-icon-precomposed" href="{{ secure_asset('images/favicon.ico') }}"> --}}
  <link rel="stylesheet" type="text/css" href="{{ secure_asset('css/sweetalert.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ secure_asset('css/custom.css') }}">
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body class="body">
<div id="wrapper">
  <div id="page">
    <div class="layout-wrap">
      @include('dashboard.sidebar')
      <div class="section-content-right">
        @include('dashboard.navbar')

        <!-- Main Content -->
        <div class="main-content">
            @yield('container')
            @include('dashboard.footer')
        </div>
      </div>
    </div>
  </div>
</div>




<script src="{{ secure_asset('js/jquery.min.js') }}"></script>
<script src="{{ secure_asset('js/bootstrap.min.js') }}"></script>
<script src="{{ secure_asset('js/bootstrap-select.min.js') }}"></script>   
<script src="{{ secure_asset('js/sweetalert.min.js') }}"></script>    
<script src="{{ secure_asset('js/apexcharts/apexcharts.js') }}"></script>
<script src="{{ secure_asset('js/main.js') }}"></script>
<script>
    $(function(){
      $("#search-input").on("keyup",function(){
        var searchQuery = $(this).val();
        if (searchQuery.length>2) {
          $.ajax({
            type:"GET",
            url: "{{ route('admin.search') }}",
            data: {query: searchQuery},
            dataType: 'json',
            success: function(data){
              $("#box-content-search").html('');
              $.each(data,function(index,item){
                var url="{{ route('admin.product.edit',['id'=>'product_id']) }}";
                var link= url.replace('product_id', item.id);

                $("#box-content-search").append(`
                <li>
                  <ul>
                    <li class="product-item gap14 mb-10">
                      <div class="image no-bg">
                        <img src="{{ secure_asset('uploads/products') }}/${item.image}" alt="${item.name}">
                      </div>
                      <div class="flex items-center justify-between gap20 flex-grow">
                        <div class="name">
                          <a href="${link}" class="body-text">${item.name}</a>
                        </div>
                      </div>
                    </li>
                    <li class="mb-10">
                      <div class="divider"></div>
                    </li>
                  </ul>
                </li>
                `);
              });
            }
          });
        }
      });
    });
  </script>
{{-- <script>
    (function ($) {

        var tfLineChart = (function () {

            var chartBar = function () {

                var options = {
                    series: [{
                        name: 'Total',
                        data: [0.00, 0.00, 0.00, 0.00, 0.00, 273.22, 208.12, 0.00, 0.00, 0.00, 0.00, 0.00]
                    }, {
                        name: 'Pending',
                        data: [0.00, 0.00, 0.00, 0.00, 0.00, 273.22, 208.12, 0.00, 0.00, 0.00, 0.00, 0.00]
                    },
                    {
                        name: 'Delivered',
                        data: [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00]
                    }, {
                        name: 'Canceled',
                        data: [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00]
                    }],
                    chart: {
                        type: 'bar',
                        height: 325,
                        toolbar: {
                            show: false,
                        },
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '10px',
                            endingShape: 'rounded'
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        show: false,
                    },
                    colors: ['#2377FC', '#FFA500', '#078407', '#FF0000'],
                    stroke: {
                        show: false,
                    },
                    xaxis: {
                        labels: {
                            style: {
                                colors: '#212529',
                            },
                        },
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    },
                    yaxis: {
                        show: false,
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return "$ " + val + ""
                            }
                        }
                    }
                };

                chart = new ApexCharts(
                    document.querySelector("#line-chart-8"),
                    options
                );
                if ($("#line-chart-8").length > 0) {
                    chart.render();
                }
            };

            /* Function ============ */
            return {
                init: function () { },

                load: function () {
                    chartBar();
                },
                resize: function () { },
            };
        })();

        jQuery(document).ready(function () { });

        jQuery(window).on("load", function () {
            tfLineChart.load();
        });

        jQuery(window).on("resize", function () { });
    })(jQuery);
</script> --}}
@stack('scripts')
</body>
<!-- [Body] end -->

</html>