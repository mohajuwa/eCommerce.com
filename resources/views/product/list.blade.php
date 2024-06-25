@extends('layout.app')
@section('style')
    <link rel="stylesheet" href="{{ url('assets/css/plugins/nouislider/nouislider.css') }}">
    <style type="text/css">
        .active-color {
            border: 3px solid #000 !important;
        }
    </style>
@endsection
@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image:{{ url('assets/images/page-header-bg.jpg') }}">
            <div class="container">
                @if (!empty($getSubCategory))
                    <h1 class="page-title">{{ $getSubCategory->name }}<span>Shop</span></h1>
                @elseif (!empty($getCategory))
                    <h1 class="page-title">{{ $getCategory->name }}<span>Shop</span></h1>
                @else
                    <h1 class="page-title">Search For {{ Request::get('q') }}<span>Shop</span></h1>
                @endif
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:;">Shop</a></li>

                    @if (!empty($getSubCategory))
                        <li class="breadcrumb-item " aria-current="page">
                            <a href="{{ url($getCategory->slug) }}">

                                {{ $getCategory->name }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">

                            {{ $getSubCategory->name }}

                        </li>
                    @elseif (!empty($getCategory))
                        <li class="breadcrumb-item active" aria-current="page">

                            {{ $getCategory->name }}
                        </li>
                    @endif

                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="toolbox">
                            <div class="toolbox-left">
                                <div class="toolbox-info">
                                    @php
                                        $totalEntries = $getProduct->total();
                                        $firstEntry = ($getProduct->currentPage() - 1) * $getProduct->perPage() + 1;
                                        $lastEntry = $firstEntry + $getProduct->count() - 1;
                                    @endphp
                                    Showing <span>{{ $firstEntry }} to {{ $lastEntry }} of
                                        {{ $totalEntries }}</span>
                                    Products
                                </div><!-- End .toolbox-info -->
                            </div><!-- End .toolbox-left -->

                            <div class="toolbox-right">
                                <div class="toolbox-sort">
                                    <label for="sortby">Sort by:</label>
                                    <div class="select-custom">
                                        <select name="sortby" id="sortby" class="form-control changeSortBy">
                                            <option value="">Select</option>
                                            <option value="popularity">Most Popular</option>
                                            <option value="rating">Most Rated</option>
                                            <option value="date">Date</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="toolbox-layout">

                                </div>
                            </div>
                        </div>
                        <div id="getProductAjax">
                            @include('product._list')

                        </div>

                        <div style="text-align: center">
                            <a href="javascript:;" @if (empty($page)) style="display: none;" @endif
                                data-page="{{ $page }}" class="btn btn-primary LoadMore ">Load
                                More</a>
                        </div>
                    </div>
                    <aside class="col-lg-3 order-lg-first">
                        <form action="" method="POST" id="FilterForm">
                            {{ csrf_field() }}
                            <input type="hidden" name="q"
                                value="{{ !empty(Request::get('q')) ? Request::get('q') : '' }}">
                            <input type="hidden" name="old_category_id"
                                value="{{ !empty($getCategory) ? $getCategory->id : '' }}">

                            <input type="hidden" name="old_sub_category_id"
                                value="{{ !empty($getSubCategory) ? $getSubCategory->id : '' }}">

                            <input type="hidden" name="sub_category_id" id="getSubCateId">
                            <input type="hidden" name="brand_id" id="getBrandId">
                            <input type="hidden" name="size_id" id="getSizeId">
                            <input type="hidden" name="color_id" id="getColorId">
                            <input type="hidden" name="sortby_id" id="getSortBy">
                            <input type="hidden" name="price_start" id="getStartPrice">
                            <input type="hidden" name="price_end" id="getEndPrice">



                        </form>
                        <div class="sidebar sidebar-shop">
                            <div class="widget widget-clean">
                                <label>Filters:</label>
                                <a href="#" class="sidebar-filter-clear">Clean All</a>
                            </div><!-- End .widget widget-clean -->
                            @if (!empty($getSubCategoryFilter))
                                <div class="widget widget-collapsible">
                                    <h3 class="widget-title">
                                        <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true"
                                            aria-controls="widget-1">
                                            Category
                                        </a>
                                    </h3>
                                    <div class="collapse show" id="widget-1">
                                        <div class="widget-body">
                                            <div class="filter-items filter-items-count">

                                                @foreach ($getSubCategoryFilter as $subCateFilter)
                                                    <div class="filter-item">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox"
                                                                class="custom-control-input changeCategory"
                                                                value="{{ $subCateFilter->id }}"
                                                                id="cat-{{ $subCateFilter->id }}">
                                                            <label class="custom-control-label"
                                                                for="cat-{{ $subCateFilter->id }}">{{ $subCateFilter->name }}</label>
                                                        </div><!-- End .custom-checkbox -->
                                                        <span
                                                            class="item-count">{{ $subCateFilter->totalProducts() }}</span>
                                                    </div>
                                                @endforeach




                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($getColor))
                                <div class="widget widget-collapsible">
                                    <h3 class="widget-title">
                                        <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true"
                                            aria-controls="widget-2">
                                            Size
                                        </a>
                                    </h3><!-- End .widget-title -->

                                    <div class="collapse show" id="widget-2">
                                        <div class="widget-body">
                                            <div class="filter-items">
                                                @foreach ($getColor as $colorItem)
                                                    <div class="filter-item">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input changeSize"
                                                                value="{{ $colorItem->id }}"
                                                                id="col-{{ $colorItem->id }}">
                                                            <label class="custom-control-label"
                                                                for="col-{{ $colorItem->id }}">{{ $colorItem->name }}</label>
                                                        </div><!-- End .custom-checkbox -->
                                                    </div>
                                                @endforeach
                                            </div><!-- End .filter-items -->
                                        </div><!-- End .widget-body -->
                                    </div><!-- End .collapse -->
                                </div>
                            @endif
                            @if (!empty($getColor))
                                <div class="widget widget-collapsible">
                                    <h3 class="widget-title">
                                        <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true"
                                            aria-controls="widget-3">
                                            Colour
                                        </a>
                                    </h3>

                                    <div class="collapse show" id="widget-3">
                                        <div class="widget-body">
                                            <div class="filter-colors">
                                                @foreach ($getColor as $colorItem)
                                                    <a href="javascript:;" id="{{ $colorItem->id }}" class="changeColor"
                                                        data-val="0"
                                                        style="background: {{ $colorItem->code }};
                                                    "><span
                                                            class="sr-only">{{ $colorItem->name }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true"
                                        aria-controls="widget-4">
                                        Brand
                                    </a>
                                </h3>
                                @if (!empty($getBrand))
                                    <div class="collapse show" id="widget-4">
                                        <div class="widget-body">
                                            <div class="filter-items">
                                                @foreach ($getBrand as $brandItem)
                                                    <div class="filter-item">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox"
                                                                class="custom-control-input changeBrand"
                                                                value="{{ $brandItem->id }}"
                                                                id="brand-{{ $brandItem->id }}">
                                                            <label class="custom-control-label"
                                                                for="brand-{{ $brandItem->id }}">{{ $brandItem->name }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            @endif

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true"
                                        aria-controls="widget-5">
                                        Price
                                    </a>
                                </h3><!-- End .widget-title -->

                                <div class="collapse show" id="widget-5">
                                    <div class="widget-body">
                                        <div class="filter-price">
                                            <div class="filter-price-text">
                                                Price Range:
                                                <span id="filter-price-range"></span>
                                            </div><!-- End .filter-price-text -->

                                            <div id="price-slider"></div>
                                        </div><!-- End .filter-price -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse -->
                            </div><!-- End .widget -->
                        </div><!-- End .sidebar sidebar-shop -->
                    </aside>
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection
@section('script')
    <script src="{{ url('assets/js/wNumb.js') }}"></script>
    <script src="{{ url('assets/js/nouislider.min.js') }}"></script>
    <script type="text/javascript">
        $('.changeSortBy').change(function() {
            var ids = '';
            $('.changeSortBy').each(function() {
                var id = $(this).val();

                $('#getSortBy').val(id);
                FilterForm();

            });


        });
        $('.changeCategory').change(function() {
            var ids = '';
            $('.changeCategory').each(function() {
                if (this.checked) {
                    var id = $(this).val();
                    ids += id + ',';
                }
            });
            $('#getSubCateId').val(ids);
            FilterForm();


        });
        $('.changeBrand').change(function() {
            var ids = '';
            $('.changeBrand').each(function() {
                if (this.checked) {
                    var id = $(this).val();
                    ids += id + ',';
                }
            });
            $('#getBrandId').val(ids);
            FilterForm()


        });
        $('.changeSize').change(function() {
            var ids = '';
            $('.changeSize').each(function() {
                if (this.checked) {
                    var id = $(this).val();
                    ids += id + ',';
                }
            });
            $('#getSizeId').val(ids);
            FilterForm();


        });
        $('.changeColor').click(function() {
            var id = $(this).attr('id');
            var status = $(this).attr('data-val');
            if (status == 0) {
                $(this).attr('data-val', 1);

                $(this).addClass('active-color');
            } else {
                $(this).attr('data-val', 0);

                $(this).removeClass('active-color');


            }
            var ids = '';


            $('.changeColor').each(function() {
                var status = $(this).attr('data-val');

                if (status == 1) {
                    id = $(this).attr('id');
                    ids += id + ',';
                }
            });
            $('#getColorId').val(ids);
            FilterForm();



        });
        var xhr = '';

        function FilterForm() {
            if (xhr && xhr.readyState != 4) {
                xhr.abort();
            }
            $('.LoadMore').html('Loading...');

            xhr = $.ajax({
                type: "POST",
                url: "{{ url('get_prodcut_filter_ajax') }}",
                data: $('#FilterForm').serialize(),
                // token:{{ csrf_field() }},
                dataType: "json",
                success: function(data) {
                    $('#getProductAjax').html(data.success);
                    $('.LoadMore').attr('data-page', data.page);
                    $('.LoadMore').html('Load More');

                    if (data.page == 0) {
                        $('.LoadMore').hide();

                    } else {
                        $('.LoadMore').show();

                    }
                },
                error: function(data) {

                }
            });

        }
        $('body').delegate('.LoadMore', 'click', function() {
            var page = $(this).attr('data-page');
            $('.LoadMore').html('Loading...');

            if (xhr && xhr.readyState != 4) {
                xhr.abort();
            }
            xhr = $.ajax({
                type: "POST",
                url: "{{ url('get_prodcut_filter_ajax') }}?page=" + page,
                data: $('#FilterForm').serialize(),
                // token:{{ csrf_field() }},
                dataType: "json",
                success: function(data) {
                    $('#getProductAjax').append(data.success);
                    $('.LoadMore').attr('data-page', data.page);
                    $('.LoadMore').html('Load More');

                    if (data.page == 0) {
                        $('.LoadMore').hide();

                    } else {
                        $('.LoadMore').show();

                    }

                },
                error: function(data) {

                }
            });
        });
        var i = 0;
        if (typeof noUiSlider === 'object') {
            var priceSlider = document.getElementById('price-slider');

            // Check if #price-slider elem is exists if not return
            // to prevent error logs

            noUiSlider.create(priceSlider, {
                start: [0, 1000],
                connect: true,
                step: 1,
                margin: 1,
                range: {
                    'min': 0,
                    'max': 1000
                },
                tooltips: true,
                format: wNumb({
                    decimals: 0,
                    prefix: '$'
                })
            });

            // Update Price Range
            priceSlider.noUiSlider.on('update', function(values, handle) {
                var start_price = values[0];
                var end_price = values[1];
                $('#getStartPrice').val(start_price);
                $('#getEndPrice').val(end_price);

                $('#filter-price-range').text(values.join(' - '));
                if (i == 0 || i == 1) {
                    i++;
                } else {
                    FilterForm();
                }
            });
        }
    </script>
@endsection
