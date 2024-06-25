<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ !empty($meta_title) ? $meta_title . '| ModWir-eCommerce' : '' }}</title>
    @if (!empty($meta_keywords))
        <meta name="keywords" content="{{ $meta_keywords }}">
    @endif
    @if (!empty($meta_description))
        <meta name="description" content="{{ $meta_description }}">
    @endif

    @php
        $getSystemSettingApp = App\Models\SystemSettingModel::getSingle();
    @endphp
    <link rel="shortcut icon" href="{{ $getSystemSettingApp->getFevIcon() }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('assets/images/icons/apple-touch-icon.png') }}">
    {{-- <link rel="icon" type="image/png" sizes="32x32" href="{{ url('assets/images /icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('assets/images/icons/favicon-16x16.png') }}"> --}}
    <link rel="mask-icon" href="{{ url('assets/images/icons/safari-pinned-tab.svg') }}" color="#666666">

    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">

    <link rel="stylesheet" href="{{ url('assets/css/plugins/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/plugins/magnific-popup/magnific-popup.css') }}">
    <style type="text/css">
        .btn-wishlist-add::before {
            content: '\f233' !important;

        }
    </style>
    @yield('style')

</head>

<body>
    <div class="page-wrapper">

        @include('layout._header')
        @yield('content')
        @include('layout._footer')
    </div>
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    @include('layout._mobile-menu')

    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin"
                                        role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register"
                                        role="tab" aria-controls="register" aria-selected="false">Register</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="signin" role="tabpanel"
                                    aria-labelledby="signin-tab">
                                    <form action="#" method="POST" id="SubmitFormLogin">
                                        {{ csrf_field() }}


                                        <div class="form-group">
                                            <label for="singin-email">Email Address <span
                                                    style="color: red;">*</span></label>
                                            <input type="text" class="form-control" id="singin-email" name="email"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="singin-password">Password
                                                <span style="color: red;">*</span></label>
                                            <input type="password" class="form-control" id="singin-password"
                                                name="password" required>
                                        </div>
                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>LOG IN</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="is_remember"
                                                    class="custom-control-input" id="signin-remember">
                                                <label class="custom-control-label" for="signin-remember">Remember
                                                    Me</label>
                                            </div>
                                            <a href="{{ url('forgot-password') }}" class="forgot-link">Forgot
                                                Your
                                                Password?</a>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="register" role="tabpanel"
                                    aria-labelledby="register-tab">
                                    <form action="#" method="POST" id="SubmitFormRegister">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="register-name">Name
                                                <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" id="register-name"
                                                name="name" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="register-email">Email Address
                                                <span style="color: red;">*</span></label>
                                            <input type="email" class="form-control" id="register-email"
                                                name="email" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="register-password">Password
                                                <span style="color: red;">*</span></label>
                                            <input type="password" class="form-control" id="register-password"
                                                name="password" required>
                                        </div>
                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>SIGN
                                                    UP</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="register-policy" required>
                                                <label class="custom-control-label" for="register-policy">I
                                                    agree
                                                    to
                                                    the
                                                    <a href="#">privacy
                                                        policy</a>
                                                    <span style="color: red;">*</span></label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

    {{-- <div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="row no-gutters bg-white newsletter-popup-content">
                    <div class="col-xl-3-5col col-lg-7 banner-content-wrap">
                        <div class="banner-content text-center">
                            <img src="assets/images/popup/newsletter/logo.png" class="logo" alt="logo" width="60"
                                height="15">
                            <h2 class="banner-title">get <span>25<light>%</light></span> off</h2>
                            <p>Subscribe to the ModWir eCommerce newsletter to receive timely updates from your favorite
                                products.</p>
                            <form action="#">
                                <div class="input-group input-group-round">
                                    <input type="email" class="form-control form-control-white"
                                        placeholder="Your Email Address" aria-label="Email Adress" required>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit"><span>go</span></button>
                                    </div>
                                </div>
                            </form>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                <label class="custom-control-label" for="register-policy-2">Do not show this popup
                                    again</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2-5col col-lg-5 ">
                        <img src="assets/images/popup/newsletter/img-1.jpg" class="newsletter-img" alt="newsletter">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <script src="{{ url('assets/js/jquery.min.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/js/jquery.hoverIntent.min.js') }}"></script>
    <script src="{{ url('assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ url('assets/js/superfish.min.js') }}"></script>
    <script src="{{ url('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ url('assets/js/jquery.magnific-popup.min.js') }}"></script>
    @yield('script')

    <script src="{{ url('assets/js/main.js') }}"></script>
    <script type="text/javascript">
        $('body').delegate('#SubmitFormRegister', 'submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "{{ url('auth_register') }}",
                data: $(this).serialize(),
                // token:{{ csrf_field() }},
                dataType: "json",
                success: function(data) {
                    alert(data.message);
                    if (data.status == true) {
                        location.reload();

                    }

                },
                error: function(data) {

                }
            });

        });
        $('body').delegate('#SubmitFormLogin', 'submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "{{ url('auth_login') }}",
                data: $(this).serialize(),
                // token:{{ csrf_field() }},
                dataType: "json",
                success: function(data) {
                    if (data.status == true) {
                        location.reload();

                    } else {
                        alert(data.message);

                    }

                },
                error: function(data) {

                }
            });

        });
        $('body').delegate('.addToWishlist', 'click', function(e) {
            var product_id = $(this).attr('id');

            $.ajax({
                type: "POST",
                url: "{{ url('add_to_wishlist') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    product_id: product_id,

                },
                dataType: "json",
                success: function(data) {

                    if (data.is_wishlist == 0) {
                        $('.addToWishlist' + product_id).removeClass('btn-wishlist-add');

                    } else {
                        $('.addToWishlist' + product_id).addClass('btn-wishlist-add');


                    }
                },

            });

        });
    </script>
</body>

</html>
