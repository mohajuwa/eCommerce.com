@extends('layout.app')
@section('style')
<link rel="stylesheet" href="{{ url('assets/css/plugins/nouislider/nouislider.css') }}">
<style type="text/css">
    .active-color {
        border: 3px solid #000 !important;
    }
</style>
@endsection
@php
use Darryldecode\Cart\Cart;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Event;

$cart = new Cart(app(SessionManager::class), Event::getFacadeRoot(), null, 'cart', 'cart');
$cartTotal = 0;

$cartContent = $cart->getContent();
@endphp
@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
        </div>
    </div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="cart">
            <div class="container">
                @include('layout._message')
                @if (!empty($cartContent->count()))
                <div class="row">
                    <div class="col-lg-9">
                        <form action="{{ url('update_cart') }}" method="POST">
                            {{ csrf_field() }}
                            <table class="table table-cart table-mobile">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($cartContent as $key => $cartItem)
                                    @php
                                    $getCartProduct = App\Models\Product::getSingle($cartItem->id);
                                    $getProductImage = $getCartProduct->getImageSingle($getCartProduct->id);
                                    @endphp
                                    @if (!empty($getCartProduct))
                                    <tr>

                                        <td class="product-col">
                                            <div class="product">
                                                <figure class="product-media bg-transparent">
                                                    <a href="{{ url($getCartProduct->slug) }}">
                                                        <img src="{{ url($getProductImage->getImage()) }}"
                                                            alt="Product image">
                                                    </a>
                                                </figure>

                                                <h3 class="product-title">
                                                    <a href="{{ url($getCartProduct->slug) }}">{{ $getCartProduct->title
                                                        }}</a>
                                                </h3>
                                            </div>
                                        </td>


                                        <td class="price-col"> ${{ number_format($cartItem->price, 2) }}
                                        </td>
                                        <td class="quantity-col">
                                            <div class="cart-product-quantity">
                                                <input type="number" class="form-control"
                                                    value="{{ $cartItem->quantity }}" min="1" max="100"
                                                    name="cart[{{ $key }}][qty]" step="1" data-decimals="0" required>
                                            </div>
                                            <input type="hidden" value="{{ $cartItem->id }}" name="cart[{{ $key }}][id]"
                                                step="1">
                                        </td>
                                        <td class="total-col">
                                            ${{ number_format($cartItem->price * $cartItem->quantity, 2) }}
                                        </td>
                                        <td class="remove-col"><a href="{{ url('cart/delete/' . $cartItem->id) }}"
                                                class="btn-remove"><i class="icon-close"></i></a></td>
                                    </tr>
                                    @php
                                    $cartTotal += $cartItem->price * $cartItem->quantity;

                                    @endphp
                                    @endif
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="cart-bottom">


                                <button type="submit" class="btn btn-outline-dark-2"><span>UPDATE CART</span><i
                                        class="icon-refresh"></i></button>
                            </div>
                        </form>

                    </div>
                    <aside class="col-lg-3">
                        <div class="summary summary-cart">
                            <h3 class="summary-title">Cart Total</h3>

                            <table class="table table-summary">
                                <tbody>
                                    <tr class="summary-subtotal">
                                        <td>Subtotal:</td>
                                        <td>${{ number_format($cartTotal, 2) }}</td>
                                    </tr>

                                    {{-- <tr class="summary-shipping-estimate">
                                        <td>Estimate for Your Country<br> <a href="dashboard.html">Change address</a>
                                        </td>
                                        <td>&nbsp;</td>
                                    </tr> --}}

                                    <tr class="summary-total">
                                        <td>Total:</td>
                                        <td>${{ number_format($cartTotal, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <a href="{{ url('checkout') }}"
                                class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO
                                CHECKOUT</a>
                        </div>

                        <a href="{{ url('/') }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE
                                SHOPPING</span><i class="icon-refresh"></i></a>
                    </aside>
                </div>
                @else
                <h3>Cart empty</h3>
                @endif

            </div>
        </div>
    </div>
</main>
@endsection
@section('script')
<script src="{{ url('assets/js/bootstrap-input-spinner.js') }}"></script>
@endsection