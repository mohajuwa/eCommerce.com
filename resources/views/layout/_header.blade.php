<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <div class="header-dropdown">
                    <a href="#">Usd</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#">Usd</a></li>
                        </ul>
                    </div>
                </div>

                <div class="header-dropdown">
                    <a href="#">Eng</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#">English</a></li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="header-right">
                <ul class="top-menu">
                    <li>
                        <a href="#">Links</a>
                        <ul>
                            <li><a href="tel:{{ $getSystemSettingApp->phone }}"><i class="icon-phone"></i>Call:
                                    {{ $getSystemSettingApp->phone }}</a>
                            </li>
                            @if (Auth::check())
                                <li><a href="{{ url('my-wishlist') }}"><i class="icon-heart-o"></i>My Wishlist
                                        <span>(3)</span></a></li>
                            @endif
                            <li><a href="{{ url('about') }}">About Us</a></li>
                            <li><a href="{{ url('contact') }}">Contact Us</a></li>

                            @if (!empty(Auth::check()))
                                <li><a href="{{ url('user/dashboard') }}"><i
                                            class=" icon-user"></i>{{ Auth::user()->name }}</a></li>
                            @else
                                <li><a href="#signin-modal" data-toggle="modal"><i class="icon-user"></i>Login</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="header-middle sticky-header">
            <div class="container">
                <div class="header-left">
                    <button class="mobile-menu-toggler">
                        <span class="sr-only">Toggle mobile menu</span>
                        <i class="icon-bars"></i>
                    </button>

                    <a href="{{ url('') }}" class="logo">
                        <img src="{{ $getSystemSettingApp->getLogo() }}" width="105" height="25">
                    </a>

                    <nav class="main-nav">
                        <ul class="menu sf-arrows">
                            <li class="{{(Request::segment(1) == '') ? 'active' : ''}}">
                                <a href="{{ url('/') }}">Home</a>


                            </li>
                            <li>
                                <a href="javascript:;" class="sf-with-ul">Shop</a>

                                <div class="megamenu megamenu-md">
                                    <div class="row no-gutters">
                                        <div class="col-md-12">
                                            <div class="menu-col">
                                                <div class="row">
                                                    @php
                                                        $getCategoriesHeader = App\Models\Category::getRecordMenu();

                                                    @endphp
                                                    @foreach ($getCategoriesHeader as $cateHedItem)
                                                        @if (!empty($cateHedItem->getSubCategory->count()))
                                                            <div class="col-md-4" style="margin-bottom:20px">
                                                                <a href="{{ url($cateHedItem->slug) }}"
                                                                    class="menu-title">{{ $cateHedItem->name }}</a>
                                                                <ul>
                                                                    @foreach ($cateHedItem->getSubCategory as $getSubCateHedItem)
                                                                        <li><a
                                                                                href="{{ url($cateHedItem->slug . '/' . $getSubCateHedItem->slug) }}"><span>{{ $getSubCateHedItem->name }}
                                                                                    {{-- <span class="tip tip-hot">Hot</span> --}}
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    @endforeach

                                                                </ul>

                                                            </div>
                                                        @endif
                                                    @endforeach



                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </li>
                            @php
                            $getCategoriesHeaderMenu = App\Models\Category::getRecordMenuHeader();
                            @endphp
                            @if (!empty($getCategoriesHeaderMenu->count()))
                            @foreach ($getCategoriesHeaderMenu as $menu)
                            <li class="{{(Request::segment(1) == $menu->slug) ? 'active' : ''}}">
                                <a href="{{ url($menu->slug) }}">{{ $menu->name }}</a>
                            </li>
                            @endforeach
                            @endif

                        </ul>
                    </nav>
                </div>
                @php
                    use Darryldecode\Cart\Cart;
                    use Illuminate\Session\SessionManager;
                    use Illuminate\Support\Facades\Event;

                    $cart = new Cart(app(SessionManager::class), Event::getFacadeRoot(), null, 'cart', 'cart');
                    $cartTotal = 0;

                    $headerContent = $cart->getContent();
                @endphp
                <div class="header-right">
                    <div class="header-search">
                        <a href="#" class="search-toggle" role="button" title="Search"><i
                                class="icon-search"></i></a>
                        <form action="{{ url('search') }}" method="get">
                            <div class="header-search-wrapper">
                                <button for="q" class="sr-only">Search</button>
                                <input type="search" class="form-control" name="q" id="q"
                                    placeholder="Search in..."
                                    value="{{ !empty(Request::get('q')) ? Request::get('q') : '' }}">
                            </div>
                        </form>
                    </div>

                    <div class="dropdown cart-dropdown">
                        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" data-display="static">
                            <i class="icon-shopping-cart"></i>
                            <span
                                class="cart-count">{{ !empty($headerContent->count()) ? $headerContent->count() : 0 }}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-cart-products">

                                @foreach ($headerContent as $cartItem)
                                    @php
                                        $getCartProduct = App\Models\Product::getSingle($cartItem->id);
                                        $getProductImage = $getCartProduct->getImageSingle($getCartProduct->id);

                                    @endphp
                                    @if (!empty($getCartProduct))
                                        <div class="product">
                                            <div class="product-cart-details">
                                                <h4 class="product-title">
                                                    <a
                                                        href="{{ url($getCartProduct->slug) }}">{{ $getCartProduct->title }}</a>
                                                </h4>

                                                <span class="cart-product-info">
                                                    <span class="cart-product-qty">{{ $cartItem->quantity }}</span>
                                                    x ${{ number_format($cartItem->price, 2) }}
                                                </span>
                                            </div>
                                            @php
                                                $cartTotal += $cartItem->price * $cartItem->quantity;

                                            @endphp
                                            <figure class="product-image-container">
                                                <a href="{{ url($getCartProduct->slug) }}" class="product-image">
                                                    <img src="{{ url($getProductImage->getImage()) }}" alt="product">
                                                </a>
                                            </figure>
                                            <a href="{{ url('cart/delete/' . $cartItem->id) }}" class="btn-remove"
                                                title="Remove Product"><i class="icon-close"></i></a>
                                        </div>
                                    @endif
                                @endforeach


                            </div>

                            <div class="dropdown-cart-total">
                                <span>Total</span>

                                <span class="cart-total-price">${{ number_format($cartTotal, 2) }}</span>
                            </div>

                            <div class="dropdown-cart-action">
                                <a href="{{ url('cart') }}" class="btn btn-primary">View Cart</a>
                                <a href="{{ url('checkout') }}"
                                    class="btn btn-outline-primary-2"><span>Checkout</span><i
                                        class="icon-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</header>
