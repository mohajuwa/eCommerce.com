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
    $cartTotal = $subTotal;

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
                    @include('layout._message')

                    <div class="checkout-discount">
                        <form action="#">
                            <input type="text" class="form-control" required id="checkout-discount-input">
                            <label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to
                                    enter your code</span></label>
                        </form>
                    </div>

                    <form action="" id="SubmitForm" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-9">
                                <h2 class="checkout-title">Billing Details</h2>
                                <div class="row">
                                    <div class="col-sm-6">














                                        <label>First Name <span style="color: red">*</span></label>
                                        <input name="first_name"
                                            value="{{ !empty(Auth::user()->name) ? Auth::user()->name : '' }}"
                                            type="text" class="form-control" required>
                                    </div>


                                    <div class="col-sm-6">
                                        <label>Last Name <span style="color: red">*</span></label>
                                        <input name="last_name"
                                            value="{{ !empty(Auth::user()->last_name) ? Auth::user()->last_name : '' }}"
                                            type="text" class="form-control" required>
                                    </div>

                                </div>


                                <label>Company Name (Optional)</label>
                                <input name="company_name"
                                    value="{{ !empty(Auth::user()->company_name) ? Auth::user()->company_name : '' }}"
                                    type="text" class="form-control">

                                <label>Country <span style="color: red">*</span></label>
                                <input name="country"
                                    value="{{ !empty(Auth::user()->country) ? Auth::user()->country : '' }}" type="text"
                                    class="form-control" required>

                                <label>Street address <span style="color: red">*</span></label>
                                <input name="address_one"
                                    value="{{ !empty(Auth::user()->address_one) ? Auth::user()->address_one : '' }}"
                                    type="text" class="form-control" placeholder="House number and Street name" required>
                                <input name="address_two"
                                    value="{{ !empty(Auth::user()->address_two) ? Auth::user()->address_two : '' }}"
                                    type="text" class="form-control" placeholder="Appartments, suite, unit etc ..."
                                    required>






                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Town / City <span style="color: red">*</span></label>
                                        <input name="city"
                                            value="{{ !empty(Auth::user()->city) ? Auth::user()->city : '' }}"
                                            type="text" class="form-control" required>
                                    </div>


                                    <div class="col-sm-6">
                                        <label>State / County <span style="color: red">*</span></label>
                                        <input name="state"
                                            value="{{ !empty(Auth::user()->state) ? Auth::user()->state : '' }}"
                                            type="text" class="form-control" required>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Postcode / ZIP <span style="color: red">*</span></label>
                                        <input name="post_code"
                                            value="{{ !empty(Auth::user()->post_code) ? Auth::user()->post_code : '' }}"
                                            type="text" class="form-control" required>
                                    </div>


                                    <div class="col-sm-6">
                                        <label>Phone <span style="color: red">*</span></label>
                                        <input name="phone"
                                            value="{{ !empty(Auth::user()->phone) ? Auth::user()->phone : '' }}"
                                            type="tel" class="form-control" required>
                                    </div>

                                </div>


                                <label>Email address <span style="color: red">*</span></label>
                                <input name="email" value="{{ !empty(Auth::user()->email) ? Auth::user()->email : '' }}"
                                    type="email" class="form-control" required>
                                @if (empty(Auth::check()))
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input creatAccount" name="is_create"
                                            value="{{ !empty(Auth::user()->is_create) ? Auth::user()->is_create : '' }}"
                                            id="checkout-create-acc">
                                        <label class="custom-control-label" for="checkout-create-acc">Create an
                                            account?</label>
                                    </div>
                                    <div id="showPassword" style="display: none">
                                        <label>Password<span style="color: red">*</span></label>
                                        <input name="password"
                                            value="{{ !empty(Auth::user()->password) ? Auth::user()->password : '' }}"
                                            id="input_password" type="text" class="form-control">
                                    </div>
                                @endif










                                <label>Order notes (optional)</label>
                                <textarea class="form-control" cols="30" rows="4" name="note"
                                    value="{{ !empty(Auth::user()->note) ? Auth::user()->note : '' }}"
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
                                                    $getProductImage = $getCartProduct->getImageSingle(
                                                        $getCartProduct->id,
                                                    );
                                                @endphp

                                                @if (!empty($getCartProduct))
                                                    <tr>
                                                        <td><a
                                                                href="{{ url($getCartProduct->slug) }}">{{ $getCartProduct->title }}</a>
                                                        </td>
                                                        <td>${{ number_format($cartItem->price * $cartItem->quantity, 2) }}
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach

                                            <tr class="summary-subtotal">
                                                <td>Subtotal:</td>
                                                <td><span>${{ number_format($cartTotal, 2) }}</span></td>
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
                                                                value="{{ !empty(Auth::user()->shipping) ? Auth::user()->shipping : '' }}"
                                                                required value="{{ $shippingChargeItem->id }}"
                                                                id="free-shipping{{ $shippingChargeItem->id }}"
                                                                class=" custom-control-input getShippingCharge"
                                                                data-price="{{ !empty($shippingChargeItem->price) ? $shippingChargeItem->price : 0 }}">
                                                            <label for="free-shipping{{ $shippingChargeItem->id }}"
                                                                class=" custom-control-label">{{ $shippingChargeItem->name }}</label>
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
                                                            <input type="text" name="discount_code"
                                                                value="{{ !empty(Auth::user()->discount_code) ? Auth::user()->discount_code : '' }}"
                                                                class="form-control" id="getDiscountCode"
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


                                                    <span id="getPaypalTotal">${{ number_format($cartTotal, 2) }}</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <input type="hidden" id="getShippingChargeTotal" value="0">
                                    <input type="hidden" id="PaypalTotal" value="{{ $cartTotal }}">
                                    <div class="accordion-summary" id="accordion-payment">


                                        <div class="custom-control  custom-radio" style="margin-top:0px;">
                                            <input type="radio" id="CashOnDelivery" name="payment_method"
                                                value="{{ !empty(Auth::user()->payment_method) ? Auth::user()->payment_method : '' }}"
                                                value="cash_on_delivery" required class=" custom-control-input">
                                            <label for="CashOnDelivery" class=" custom-control-label">Cash on
                                                delivery</label>
                                        </div>
                                        <div class="custom-control  custom-radio" style="margin-top:0px;">
                                            <input type="radio" id="PayPal" name="payment_method"
                                                value="{{ !empty(Auth::user()->payment_method) ? Auth::user()->payment_method : '' }}"
                                                value="paypal" required class=" custom-control-input">
                                            <label for="PayPal" class=" custom-control-label">PayPal</label>
                                        </div>
                                        <div class="custom-control  custom-radio" style="margin-top:0px;">
                                            <input type="radio" id="CreditCards" name="payment_method"
                                                value="{{ !empty(Auth::user()->payment_method) ? Auth::user()->payment_method : '' }}"
                                                value="stripe" required class=" custom-control-input">
                                            <label for="CreditCards" class=" custom-control-label">Credit
                                                Carts(Stripe)</label>

                                        </div>



                                    </div>


                                    <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                        <span class="btn-text">Place Order</span>
                                        <span class="btn-hover-text">Proceed to Checkout</span>
                                    </button>
                                    <br /><br />
                                    <img src="{{ url('assets/images/payments-summary.png') }}" alt="payments cards">

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
        $('body').delegate('#SubmitForm', 'submit', function(e) {
            e.preventDefault();
            console.log("Form submission intercepted.");

            $.ajax({
                type: "POST",
                url: "{{ url('checkout/placeOrder') }}",
                data: new FormData(this),
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(data) {
                    console.log("AJAX request succeeded:", data);
                    if (data.status == false) {
                        alert(data.message);
                    } else {
                        console.log("Redirecting to:", data.redirect);
                        window.location.href = data.redirect;
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX request failed:", status, error);
                    console.error("Response:", xhr.responseText);
                }
            });
        });


        $('body').delegate('.creatAccount', 'change', function() {
            if (this.checked) {
                $('#showPassword').show();
                $('#input_password').prop('required', true);


            } else {
                $('#showPassword').hide();
                $('#input_password').prop('required', false);


            }



        });

        $('body').delegate('#ApplayDiscount', 'click', function() {
            var discount_code = $('#getDiscountCode').val();

            console.log(discount_code);
            $.ajax({
                type: "POST",
                url: "{{ url('checkout/applyDiscountCode') }}",
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
