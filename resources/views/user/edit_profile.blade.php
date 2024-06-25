@extends('layout.app')
@section('style')
@endsection
@section('content')
<main class="main">
    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title">Edit Profile</h1>
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
                                        <h2 class="checkout-title">Acount Details</h2>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>First Name <span style="color: red">*</span></label>
                                                <input name="first_name" value="{{old('first_name',$getRecord->name)}}"
                                                    type="text" class="form-control" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Last Name <span style="color: red">*</span></label>
                                                <input name="last_name"
                                                    value="{{old('last_name',$getRecord->last_name)}}" type="text"
                                                    class="form-control" required>
                                            </div>
                                        </div>

                                        <label>Company Name (Optional)</label>
                                        <input name="company_name"
                                            value="{{old('company_name',$getRecord->company_name)}}" type="text"
                                            class="form-control">

                                        <label>Country <span style="color: red">*</span></label>
                                        <input name="country" value="{{old('country',$getRecord->country)}}" type="text"
                                            class="form-control" required>

                                        <label>Street address <span style="color: red">*</span></label>
                                        <input name="address_one" value="{{old('address_one',$getRecord->address_one)}}"
                                            type="text" class="form-control" placeholder="House number and Street name"
                                            required>
                                        <input name="address_two" value="{{old('address_two',$getRecord->address_two)}}"
                                            type="text" class="form-control"
                                            placeholder="Appartments, suite, unit etc ..." required>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Town / City <span style="color: red">*</span></label>
                                                <input name="city" value="{{old('city',$getRecord->city)}}" type="text"
                                                    class="form-control" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>State / County <span style="color: red">*</span></label>
                                                <input name="state" value="{{old('state',$getRecord->state)}}"
                                                    type="text" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Postcode / ZIP <span style="color: red">*</span></label>
                                                <input name="post_code"
                                                    value="{{old('post_code',$getRecord->post_code)}}" type="text"
                                                    class="form-control" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Phone <span style="color: red">*</span></label>
                                                <input name="phone" value="{{old('phone',$getRecord->phone)}}"
                                                    type="tel" class="form-control" required>
                                            </div>
                                        </div>

                                        <label>Email address <span style="color: red">*</span></label>
                                        <input name="email" value="{{old('email',$getRecord->email)}}" type="email"
                                            class="form-control" required readonly>

                                        <label>Order notes (optional)</label>
                                        <textarea class="form-control" cols="30" rows="4" name="note"
                                            value="{{old('note',$getRecord->note)}}"
                                            placeholder="Notes about your order, e.g. special notes for delivery"></textarea>

                                        <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block w-50">
                                            Update Profile
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