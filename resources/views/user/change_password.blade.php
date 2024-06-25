@extends('layout.app')
@section('style')
@endsection
@section('content')
<main class="main">
    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title">Change Password</h1>
        </div>
    </div>

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <br />
                <div class="row">


                    @include('user._sidebar')
                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            @include('layout._message')

                            <form action="" id="SubmitForm" method="POST">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-lg-9">
                                        <h2 class="checkout-title">Change Password</h2>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Old Password <span style="color: red">*</span></label>
                                                <input name="old_password" value="{{old('old_password')}}"
                                                    type="password" class="form-control" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>New Password <span style="color: red">*</span></label>
                                                <input name="password" value="{{old('password')}}"
                                                    type="password" class="form-control" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Confirm New Password <span style="color: red">*</span></label>
                                                <input name="cpassword" value="{{old('cpassword')}}" type="password"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block w-50">
                                            Change Password
                                        </button>
                                    </div>
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
<script src="{{ url('assets/js/jquery.elevateZoom.min.js') }}"></script>
<script src="{{ url('assets/js/bootstrap-input-spinner.js') }}"></script>
<script src="{{ url('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script type="text/javascript"></script>
@endsection