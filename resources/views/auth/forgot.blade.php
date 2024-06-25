@extends('layout.app')
@section('style')
@endsection

@section('content')
<main class="main">


    <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17"
        style="background-image: url('{{url('assets/images/backgrounds/login-bg.jpg')}}')">
        <div class="container">
            <div class="form-box">
                <div class="form-tab">
                    <ul class="nav nav-pills nav-fill" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab"
                                aria-controls="signin-2" aria-selected="false">Forgot Password</a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="" style="display: block">
                            <form action="" method="POST">
                                @include('layout._message')
                                {{csrf_field()}}
                                <div class="form-group" style="margin-top: 40px">
                                    <label for="singin-email-2">Email Address</label>
                                    <input type="text" class="form-control" id="singin-email" name="email" required>
                                </div>



                                <div class="form-footer">
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>LOG IN</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>

                                  

                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
@section('script')
<script src="{{ url('assets/js/bootstrap-input-spinner.js') }}"></script>
@endsection