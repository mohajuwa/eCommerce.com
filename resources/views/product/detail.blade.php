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
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url($getProduct->getCategory->slug) }}">{{
                        $getProduct->getCategory->name }}</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ url($getProduct->getCategory->slug . '/' . $getProduct->getSubCategory->slug) }}">{{
                        $getProduct->getSubCategory->name }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $getProduct->title }}</li>
            </ol>


        </div>
    </nav>

    <div class="page-content">
        <div class="container">
            <div class="product-details-top mb-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery">
                            <figure class="product-main-image">
                                @php
                                $getProductImage = $getProduct->getImageSingle($getProduct->id);
                                @endphp
                                @if (!empty($getProductImage) && !empty($getProductImage->getImage()))
                                <img id="product-zoom" src="{{ $getProductImage->getImage() }}"
                                    data-zoom-image="{{ $getProductImage->getImage() }}" alt="product image">

                                <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                    <i class="icon-arrows"></i>
                                </a>
                                @endif

                            </figure>

                            <div id="product-zoom-gallery" class="product-image-gallery">
                                @foreach ($getProduct->getImage as $imageItem)
                                <a class="product-gallery-item" href="#" data-image="{{ $imageItem->getImage() }}"
                                    data-zoom-image="{{ $imageItem->getImage() }}">
                                    <img src="{{ $imageItem->getImage() }}" alt="product side">
                                </a>
                                @endforeach


                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="product-details">
                            <h1 class="product-title">{{ $getProduct->title }}</h1>

                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val"
                                        style="width: {{ $getProduct->getReviewRating($getProduct->id) }}%;"></div>
                                </div>

                                <a class="ratings-text" href="#product-review-link" id="review-link">(
                                    {{ $getProduct->getTotalReview() }} Reviews)</a>
                            </div>

                            <div class="product-price">
                                <span id="getTotalPrice"> ${{ number_format($getProduct->price, 2) }}
                                </span>

                            </div>

                            <div class="product-content">
                                <p>{{ $getProduct->short_description }}. </p>
                            </div>
                            <form action="{{ url('product/add-to-cart') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="product_id" value="{{ $getProduct->id }}">
                                @if (!empty($getProduct->getColor->count()))
                                <div class="details-filter-row details-row-size">
                                    <label for="size">Color:</label>
                                    <div class="select-custom">
                                        {{-- <a href="#" class="active" style="background: #eab656;"><span
                                                class="sr-only">Color name</span> --}}
                                            {{-- @foreach ($getProduct->getColor as $colorItem)
                                            <a href="javascript:;" id="{{ $colorItem->id }}" class="changeColor"
                                                data-value="{{ $colorItem->id }}" data-val="0"
                                                data-status="{{$colorItem->status}}" style="background: {{ $colorItem->getColor->code }};
                                                    "><span class="sr-only">{{ $colorItem->name }}</span>
                                            </a>
                                            @endforeach --}}

                                            <select name="color_id" id="color"
                                                class="form-control changeColor text-black">
                                                <option data-price="0" value="" selected="selected">Select a color
                                                </option>
                                                @foreach ($getProduct->getColor as $colorItem)
                                                <option value="{{ $colorItem->id }}">
                                                    {{ $colorItem->getColor->name }}

                                                </option>
                                                @endforeach
                                            </select>

                                    </div>
                                </div>
                                @endif
                                @if (!empty($getProduct->getSize->count()))
                                <div class="details-filter-row details-row-size">
                                    <label for="size">Size:</label>
                                    <div class="select-custom">
                                        <select name="size_id" id="size" class="form-control getSizePrice">
                                            <option data-price="0" value="" selected="selected">Select a size
                                            </option>
                                            @foreach ($getProduct->getSize as $sizeItem)
                                            <option data-price="{{ !empty($sizeItem->price) ? $sizeItem->price : 0 }}"
                                                value="{{ $sizeItem->id }}">
                                                {{ $sizeItem->name }}
                                                @if (!empty($sizeItem->price))
                                                (${{ number_format($sizeItem->price, 2) }})
                                                @endif
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                @endif

                                <div class="details-filter-row details-row-size">
                                    <label for="qty">Qty:</label>
                                    <div class="product-details-quantity">
                                        <input type="number" id="qty" class="form-control" value="1" min="1" max="100"
                                            name="qty" step="1" data-decimals="0" required>
                                    </div>
                                </div>
                                {{-- <div class="details-filter-row details-row-size">
                                    <div class="alert alert-danger" role="alert">Out of stack

                                    </div>
                                </div> --}}
                                <div class="product-details-action">
                                    <button type="submit" class="btn-product btn-cart addToCarBtn"
                                        style="background: #fff; color:#c96" title="Wishlist"><span>Add to
                                            Cart</span></button>
                                    <div class="details-action-wrapper">
                                        @if (Auth::check())
                                        <a href="javascript:;"
                                            class="addToWishlist addToWishlist{{ $getProduct->id }} {{ !empty($getProduct->checkWishlist($getProduct->id)) ? 'btn-wishlist-add' : '' }} btn-product btn-wishlist"
                                            id="{{ $getProduct->id }}" title="Wishlist">
                                            <span>Add to Wishlist</span>
                                        </a>
                                        @else
                                        <a href="#signin-modal" data-toggle="modal" class="btn-product btn-wishlist"
                                            title="Wishlist">
                                            <span>Add to Wishlist</span>
                                        </a>
                                        @endif
                                    </div>

                                </div>

                                <div class="product-details-footer">
                                    <div class="product-cat">
                                        <span>Category:</span>
                                        <a href="{{ url($getProduct->getCategory->slug) }}">{{
                                            $getProduct->getCategory->name }}</a>
                                        ,

                                        <a
                                            href="{{ url($getProduct->getCategory->slug . '/' . $getProduct->getSubCategory->slug) }}">{{
                                            $getProduct->getSubCategory->name }}</a>

                                    </div>

                                    <div class="social-icons social-icons-sm">
                                        <span class="social-label">Share:</span>
                                        <a href="#" class="social-icon" title="Facebook" target="_blank"><i
                                                class="icon-facebook-f"></i></a>
                                        <a href="#" class="social-icon" title="Twitter" target="_blank"><i
                                                class="icon-twitter"></i></a>
                                        <a href="#" class="social-icon" title="Instagram" target="_blank"><i
                                                class="icon-instagram"></i></a>
                                        <a href="#" class="social-icon" title="Pinterest" target="_blank"><i
                                                class="icon-pinterest"></i></a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="product-details-tab product-details-extended">
            <div class="container">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab"
                            role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab"
                            aria-controls="product-info-tab" aria-selected="false">Additional
                            information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab"
                            role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab"
                            role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews
                            ({{ $getProduct->getTotalReview() }})</a>
                    </li>
                </ul>
            </div>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel"
                    aria-labelledby="product-desc-link">
                    <div class="product-desc-content">
                        <div class="container" style="margin-top: 20px">
                            {!! $getProduct->description !!}
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                    <div class="product-desc-content">
                        <div class="container" style="margin-top: 20px">
                            {!! $getProduct->addetional_information !!}
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel"
                    aria-labelledby="product-shipping-link">
                    <div class="product-desc-content">
                        <div class="container" style="margin-top: 20px">
                            {!! $getProduct->shopping_returns !!}
                        </div>
                    </div>
                </div>

                <!-- Correct placement for the reviews tab -->
                <div class="tab-pane fade" id="product-review-tab" role="tabpanel"
                    aria-labelledby="product-review-link">
                    <div class="reviews">
                        <div class="container">
                            <h3>Reviews <span class="text-info">({{ $getProduct->getTotalReview() }})</span></h3>
                            @if ($getReviewProduct->total() > 0)
                            @foreach ($getReviewProduct as $review)
                            <div class="review">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <h4><a href="#">{{ $review->Name }}</a></h4>
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: {{ $review->getPercent() }}%;">
                                                </div>
                                            </div>
                                        </div>
                                        <span class="review-date">{{
                                            Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</span>
                                    </div>
                                    <div class="col">
                                        <h4>{{ $review->review }}</h4>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <div class="pagination-wrapper" id="pagination-links">
                                {!!
                                $getReviewProduct->appends(Illuminate\Support\Facades\Request::except('page'))->links()
                                !!}
                            </div>
                            @else
                            <p>No reviews yet.</p>
                            @endif
                        </div>


                    </div>
                </div>
            </div>

            <div class="container">
                <h2 class="title text-center mb-4">You May Also Like</h2>
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                    data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "480": {
                                    "items":2
                                },
                                "768": {
                                    "items":3
                                },
                                "992": {
                                    "items":4
                                },
                                "1200": {
                                    "items":4,
                                    "nav": true,
                                    "dots": false
                                }
                            }
                        }'>
                    @foreach ($getRelatedProducts as $relProdItem)
                    @php
                    $getProductImage = $relProdItem->getImageSingle($relProdItem->id);
                    @endphp
                    <div class="product product-7 text-center">
                        <figure class="product-media bg-transparent">
                            <a href="{{ url($relProdItem->slug) }}">
                                @if (!empty($getProductImage) && !empty($getProductImage->getImage()))
                                <img src="{{ url($getProductImage->getImage()) }}" alt="Product image"
                                    class="product-image" style="height:280px;width:100%;object-fit:contain">
                                @endif
                            </a>
                            <div class="product-action-vertical">
                                @if (Auth::check())
                                <a href="javascript:;"
                                    class="addToWishlist addToWishlist{{ $relProdItem->id }} {{ !empty($relProdItem->checkWishlist($relProdItem->id)) ? 'btn-wishlist-add' : '' }} btn-product-icon btn-wishlist btn-expandable"
                                    id="{{ $relProdItem->id }}" title="Wishlist">
                                    <span>Add to Wishlist</span>
                                </a>
                                @else
                                <a href="#signin-modal" data-toggle="modal"
                                    class="btn-product-icon btn-wishlist btn-expandable" title="Wishlist">
                                    <span>Add to Wishlist</span>
                                </a>
                                @endif
                            </div>
                        </figure>
                        <div class="product-body">
                            <div class="product-cat">
                                <a
                                    href="{{ url($relProdItem->category_slug . '/' . $relProdItem->sub_category_slug) }}">{{
                                    $relProdItem->sub_category_name }}</a>
                            </div>
                            <h3 class="product-title"><a href="{{ url($relProdItem->slug) }}">{{ $relProdItem->title
                                    }}</a></h3>
                            <div class="product-price">
                                ${{ number_format($relProdItem->price, 2) }}
                            </div>
                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: 20%;"></div>
                                </div>
                                <span class="ratings-text">( {{ $getProduct->getTotalReview() }} Reviews)</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>


    </div>
</main>
@endsection
@section('script')
<script src="{{ url('assets/js/jquery.elevateZoom.min.js') }}"></script>
<script src="{{ url('assets/js/bootstrap-input-spinner.js') }}"></script>
<script src="{{ url('assets/js/jquery.magnific-popup.min.js') }}"></script>

<script type="text/javascript">
    $('.getSizePrice').change(function() {
            var productPrice = '{{ $getProduct->price }}';
            var price = $('option:selected', this).attr('data-price');
            var totalPrice = parseFloat(productPrice) + parseFloat(price);
            $('#getTotalPrice').html('$' + totalPrice.toFixed(2));
        });
        
</script>
@endsection