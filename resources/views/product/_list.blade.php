<div class="products mb-3">
    <div class="row justify-content-center">

        @foreach ($getProduct as $prodItem)
            @php
                $getProductImage = $prodItem->getImageSingle($prodItem->id);
            @endphp
            <div class="col-12 col-md-4 col-lg-4">
                <div class="product product-7 text-center">
                    <figure class="product-media">
                        {{-- <span class="product-label label-new">New</span> --}}
                        <a href="{{ url($prodItem->slug) }}">
                            @if (!empty($getProductImage) && !empty($getProductImage->getImage()))
                                <img src="{{ url($getProductImage->getImage()) }}" alt="Product image"
                                    class="product-image" style="height:280px;width:100%;object-fit:cover">
                            @endif

                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                    wishlist</span></a>


                        </div>
                    </figure>

                    <div class="product-body">
                        <div class="product-cat">
                            <a
                                href="{{ url($prodItem->category_slug . '/' . $prodItem->sub_category_slug) }}">{{ $prodItem->sub_category_name }}</a>
                        </div>
                        <h3 class="product-title"><a href="{{ url($prodItem->slug) }}">{{ $prodItem->title }}</a>
                        </h3>
                        <div class="product-price">
                            ${{ number_format($prodItem->price, 2) }}
                        </div>
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 20%;"></div>
                            </div>
                            <span class="ratings-text">( 2 Reviews )</span>
                        </div>
                        {{-- 
                            <div class="product-nav product-nav-thumbs">
                                <a href="#" class="active">
                                    <img src="{{ url('assets/images/products/product-4-thumb') }}.jpg"
                                        alt="product desc">
                                </a>
                                <a href="#">
                                    <img src="{{ url('assets/images/products/product-4-2') }}-thumb.jpg"
                                        alt="product desc">
                                </a>

                                <a href="#">
                                    <img src="{{ url('assets/images/products/product-4-3') }}-thumb.jpg"
                                        alt="product desc">
                                </a>
                            </div><!-- End .product-nav --> --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
{{-- <nav aria-label="Page navigation">

    <ul class="pagination justify-content-center">

        <!-- Previous Page Link -->
        @if ($getProduct->previousPageUrl())
            <li class="page-item">
                <a class="page-link page-link-prev" href="{{ $getProduct->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span> Prev
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link page-link-prev" aria-hidden="true">
                    <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span> Prev
                </span>
            </li>
        @endif

        <!-- Pagination Elements -->
        {!! $getProduct->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}


        <!-- Next Page Link -->
        @if ($getProduct->nextPageUrl())
            <li class="page-item">
                <a class="page-link page-link-next" href="{{ $getProduct->nextPageUrl() }}" aria-label="Next">
                    Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link page-link-next" aria-hidden="true">
                    Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                </span>
            </li>
        @endif
    </ul>
</nav> --}}
