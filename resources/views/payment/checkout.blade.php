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

// Create an instance of the Cart class
$cart = new Cart(app(SessionManager::class), Event::getFacadeRoot(), null, 'cart', 'cart');

// Get the content of the cart
$cartContent = $cart->getContent();

// Initialize total sum
$subTotal = 0;
$cartTotal = 0;

// Iterate over each item in the cart content
foreach ($cartContent as $item) {
// Assuming each item has a price attribute
$subTotal += $item->price * $item->quantity;
}
$cartTotal = number_format($subTotal, 2);

// Now $total contains the sum of all item prices in the cart

@endphp
@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Checkout<span>Shop</span></h1>
        </div>

    </div>

    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </div>

    </nav>

    <div class="page-content">
        <div class="checkout">
            <div class="container">
                <div class="checkout-discount">
                    <form action="#">
                        <input type="text" class="form-control" required id="checkout-discount-input">
                        <label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to
                                enter your code</span></label>
                    </form>
                </div>

                <form action="#">
                    <div class="row">
                        <div class="col-lg-9">
                            <h2 class="checkout-title">Billing Details</h2>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>First Name *</label>
                                    <input type="text" class="form-control" required>
                                </div>


                                <div class="col-sm-6">
                                    <label>Last Name *</label>
                                    <input type="text" class="form-control" required>
                                </div>

                            </div>


                            <label>Company Name (Optional)</label>
                            <input type="text" class="form-control">

                            <label>Country *</label>
                            <input type="text" class="form-control" required>

                            <label>Street address *</label>
                            <input type="text" class="form-control" placeholder="House number and Street name" required>
                            <input type="text" class="form-control" placeholder="Appartments, suite, unit etc ..."
                                required>

                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Town / City *</label>
                                    <input type="text" class="form-control" required>
                                </div>


                                <div class="col-sm-6">
                                    <label>State / County *</label>
                                    <input type="text" class="form-control" required>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Postcode / ZIP *</label>
                                    <input type="text" class="form-control" required>
                                </div>


                                <div class="col-sm-6">
                                    <label>Phone *</label>
                                    <input type="tel" class="form-control" required>
                                </div>

                            </div>


                            <label>Email address *</label>
                            <input type="email" class="form-control" required>

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="checkout-create-acc">
                                <label class="custom-control-label" for="checkout-create-acc">Create an account?</label>
                            </div>


                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="checkout-diff-address">
                                <label class="custom-control-label" for="checkout-diff-address">Ship to a different
                                    address?</label>
                            </div>


                            <label>Order notes (optional)</label>
                            <textarea class="form-control" cols="30" rows="4"
                                placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                        </div>

                        <aside class="col-lg-3">
                            <div class="summary">
                                <h3 class="summary-title">Your Order</h3>

                                <table class="table table-summary">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
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
                                            <td><a href="{{ url($getCartProduct->slug) }}">{{ $getCartProduct->title
                                                    }}</a>
                                            </td>
                                            <td>${{ number_format($cartItem->price * $cartItem->quantity, 2) }}
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach

                                        <tr class="summary-subtotal">
                                            <td>Subtotal:</td>
                                            <td><span>${{ $cartTotal }}</span></td>
                                        </tr>
                                        <tr class="summary-shipping">
                                            <td>Shipping:</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        @foreach ($getShippingCharge as $shippingChargeItem)
                                        <tr class=" summary-shipping-row">
                                            <td>
                                                <div class="custom-control  custom-radio">


                                                    <input type="radio" name="shipping"
                                                        id="standart-shipping{{ $shippingChargeItem->id }}"
                                                        class=" custom-control-input getShippingCharge"
                                                        data-price="{{ !empty($shippingChargeItem->price) ? $shippingChargeItem->price : 0 }}">
                                                    <label for="standart-shipping{{ $shippingChargeItem->id }}"
                                                        class=" custom-control-label">{{ $shippingChargeItem->name
                                                        }}</label>
                                                </div>
                                            </td>
                                            <td>
                                                @if (!empty($shippingChargeItem->price))
                                                ${{ number_format($shippingChargeItem->price, 2) }}
                                                @else
                                                $0.00
                                                @endif

                                            </td>

                                        </tr>
                                        @endforeach


                                        <tr>
                                            <td colspan="2">
                                                <div class="cart-discount">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="getDiscountCode"
                                                            placeholder="coupon code">
                                                        <div class="input-group-append">
                                                            <button type="button" id="ApplayDiscount"
                                                                class="btn btn-outline-primary-2  "
                                                                style="height: 38px"><i
                                                                    class="icon-long-arrow-right"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="summary-subtotal">
                                            <td> Discount:</td>
                                            <td><span id="getDiscountAmount"> $0.00</span></td>
                                        </tr>
                                        <tr class="summary-total">
                                            <td>Total:</td>
                                            <td>
                                                <input type="hidden" value="0" id="getShippingChargeTotal">
                                                <input type="hidden" value="{{ $cartTotal }}" id="PaypalTotal">

                                                <span id="getPaypalTotal">${{ number_format($cartTotal, 2) }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="accordion-summary" id="accordion-payment">



                                    <div class="card">
                                        <div class="card-header" id="heading-3">
                                            <h2 class="card-title">
                                                <a class="collapsed" role="button" data-toggle="collapse"
                                                    href="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                                                    Cash on delivery
                                                </a>
                                            </h2>
                                        </div>

                                        <div id="collapse-3" class="collapse" aria-labelledby="heading-3"
                                            data-parent="#accordion-payment">
                                            <div class="card-body">Quisque volutpat mattis eros. Lorem ipsum dolor sit
                                                amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis
                                                eros.
                                            </div>

                                        </div>

                                    </div>


                                    <div class="card">
                                        <div class="card-header" id="heading-4">
                                            <h2 class="card-title">
                                                <a class="collapsed" role="button" data-toggle="collapse"
                                                    href="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                                    PayPal <small class="float-right paypal-link">What is
                                                        PayPal?</small>
                                                </a>
                                            </h2>
                                        </div>

                                        <div id="collapse-4" class="collapse" aria-labelledby="heading-4"
                                            data-parent="#accordion-payment">
                                            <div class="card-body">
                                                Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non,
                                                semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis
                                                fermentum.
                                            </div>

                                        </div>

                                    </div>


                                    <div class="card">
                                        <div class="card-header" id="heading-5">
                                            <h2 class="card-title">
                                                <a class="collapsed" role="button" data-toggle="collapse"
                                                    href="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
                                                    Credit Card (Stripe)
                                                    <img src="assets/images/payments-summary.png" alt="payments cards">
                                                </a>
                                            </h2>
                                        </div>

                                        <div id="collapse-5" class="collapse" aria-labelledby="heading-5"
                                            data-parent="#accordion-payment">
                                            <div class="card-body"> Donec nec justo eget felis facilisis
                                                fermentum.Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                                                Donec odio. Quisque volutpat mattis eros. Lorem ipsum dolor sit ame.
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                    <span class="btn-text">Place Order</span>
                                    <span class="btn-hover-text">Proceed to Checkout</span>
                                </button>
                            </div>

                        </aside>
                    </div>

                </form>
            </div>

        </div>

    </div>

</main>
@endsection
@section('script')
<script src="{{ url('assets/js/bootstrap-input-spinner.js') }}"></script>

<script type="text/javascript">
    $('body').delegate('.getShippingCharge', 'change', function() {
            var price = $(this).attr('data-price');
            var total = $('#PaypalTotal').val();
            $('#getShippingChargeTotal').val(price);
            var final_total = parseFloat(price) + parseFloat(total);
            $('#getPaypalTotal').html('$' + final_total.toFixed(2));



        });
        $('body').delegate('#ApplayDiscount', 'click', function() {
            var discount_code = $('#getDiscountCode').val();

            console.log(discount_code);
            $.ajax({
                type: "POST",
                url: "{{ url('checkout/applay_discount_code') }}",
                data: {
                    discount_code: discount_code,
                    "_token": "{{ csrf_token() }}",

                },
                dataType: "json",
                success: function(data) {
                    $('#getDiscountAmount').html(data.discount_amount);
                    var shipping = $('#getShippingChargeTotal').val();

                    var final_total = parseFloat(shipping) + parseFloat(data.payable_total);

                    
                    $('#getPaypalTotal').html('$' + final_total.toFixed(2));
                    $('#PaypalTotal').val(data.payable_total);

                    if (data.status == false) {

                        alert(data.message);

                    }




                },
                error: function(data) {

                }
            });
        });
</script>
@endsection