@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fuild">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> Home Setting </h1>
            </div>

        </div>
    </div>
</section>
@include('admin.layouts._message')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card   card-info">
                    <div class="card-header">
                        <h3 class="card-title"> Home Setting</h3>
                    </div>



                    <form action="" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label> Trendy Product Title <span style="color:red;">*</span></label>
                                <input type="text" class="form-control"
                                    value="{{ old('trendy_product_title', $getRecord->trendy_product_title) }}"
                                    name='trendy_product_title' placeholder="Enter Trendy Product Title">
                                <div style="color:red">{{ $errors->first('trendy_product_title') }}</div>
                            </div>

                            <div class="form-group">
                                <label> Shop Category Title <span style="color:red;">*</span></label>
                                <input type="text" class="form-control"
                                    value="{{ old('shop_category_title', $getRecord->shop_category_title) }}"
                                    name='shop_category_title' placeholder="Enter Shop Category Title">
                                <div style="color:red">{{ $errors->first('shop_category_title') }}</div>
                            </div>

                            <div class="form-group">
                                <label> Recent Arrival Title <span style="color:red;">*</span></label>
                                <input type="text" class="form-control"
                                    value="{{ old('recent_arrival_title', $getRecord->recent_arrival_title) }}"
                                    name='recent_arrival_title' placeholder="Enter Recent Arrival Title">
                                <div style="color:red">{{ $errors->first('recent_arrival_title') }}</div>
                            </div>

                            <div class="form-group">
                                <label> Blog Title <span style="color:red;">*</span></label>
                                <input type="text" class="form-control"
                                    value="{{ old('blog_title', $getRecord->blog_title) }}" name='blog_title'
                                    placeholder="Enter Blog Title">
                                <div style="color:red">{{ $errors->first('blog_title') }}</div>
                            </div>

                            <div class="form-group">
                                <label> Payment Delivery Title <span style="color:red;">*</span></label>
                                <input type="text" class="form-control"
                                    value="{{ old('payment_delivery_title', $getRecord->payment_delivery_title) }}"
                                    name='payment_delivery_title' placeholder="Enter Payment Delivery Title">
                                <div style="color:red">{{ $errors->first('payment_delivery_title') }}</div>
                            </div>

                            <div class="form-group">
                                <label> Payment Delivery Description <span style="color:red;">*</span></label>
                                <input type="text" class="form-control"
                                    value="{{ old('payment_delivery_description', $getRecord->payment_delivery_description) }}"
                                    name='payment_delivery_description'
                                    placeholder="Enter Payment Delivery Description">
                                <div style="color:red">{{ $errors->first('payment_delivery_description') }}</div>
                            </div>

                            <div class="form-group">
                                <label> Payment Delivery Image <span style="color:red;">*</span></label>
                                <input type="file" class="form-control" name='payment_delivery_image'>
                                <div style="color:red">{{ $errors->first('payment_delivery_image') }}</div>
                                @if (!empty($getRecord->paymentDeliveryImage()))
                                <img src="{{ $getRecord->paymentDeliveryImage() }}" style="width:200px;">
                                @endif
                            </div>

                            <div class="form-group">
                                <label> Refund Title <span style="color:red;">*</span></label>
                                <input type="text" class="form-control"
                                    value="{{ old('refund_title', $getRecord->refund_title) }}" name='refund_title'
                                    placeholder="Enter Refund Title">
                                <div style="color:red">{{ $errors->first('refund_title') }}</div>
                            </div>

                            <div class="form-group">
                                <label> Refund Description <span style="color:red;">*</span></label>
                                <input type="text" class="form-control"
                                    value="{{ old('refund_description', $getRecord->refund_description) }}"
                                    name='refund_description' placeholder="Enter Refund Description">
                                <div style="color:red">{{ $errors->first('refund_description') }}</div>
                            </div>

                            <div class="form-group">
                                <label> Refund Image <span style="color:red;">*</span></label>
                                <input type="file" class="form-control" name='refund_image'>
                                <div style="color:red">{{ $errors->first('refund_image') }}</div>
                                @if (!empty($getRecord->refundImage()))
                                <img src="{{ $getRecord->refundImage() }}" style="width:200px;">
                                @endif
                            </div>

                            <div class="form-group">
                                <label> Support Title <span style="color:red;">*</span></label>
                                <input type="text" class="form-control"
                                    value="{{ old('support_title', $getRecord->support_title) }}" name='support_title'
                                    placeholder="Enter Support Title">
                                <div style="color:red">{{ $errors->first('support_title') }}</div>
                            </div>

                            <div class="form-group">
                                <label> Support Description <span style="color:red;">*</span></label>
                                <input type="text" class="form-control"
                                    value="{{ old('support_description', $getRecord->support_description) }}"
                                    name='support_description' placeholder="Enter Support Description">
                                <div style="color:red">{{ $errors->first('support_description') }}</div>
                            </div>

                            <div class="form-group">
                                <label> Support Image <span style="color:red;">*</span></label>
                                <input type="file" class="form-control" name='support_image'>
                                <div style="color:red">{{ $errors->first('support_image') }}</div>
                                @if (!empty($getRecord->supportImage()))
                                <img src="{{ $getRecord->supportImage() }}" style="width:200px;">
                                @endif
                            </div>

                            <div class="form-group">
                                <label> Signup Title <span style="color:red;">*</span></label>
                                <input type="text" class="form-control"
                                    value="{{ old('signup_title', $getRecord->signup_title) }}" name='signup_title'
                                    placeholder="Enter Signup Title">
                                <div style="color:red">{{ $errors->first('signup_title') }}</div>
                            </div>

                            <div class="form-group">
                                <label> Signup Description <span style="color:red;">*</span></label>
                                <input type="text" class="form-control"
                                    value="{{ old('signup_description', $getRecord->signup_description) }}"
                                    name='signup_description' placeholder="Enter Signup Description">
                                <div style="color:red">{{ $errors->first('signup_description') }}</div>
                            </div>

                            <div class="form-group">
                                <label> Signup Image <span style="color:red;">*</span></label>
                                <input type="file" class="form-control" name='signup_image'>
                                <div style="color:red">{{ $errors->first('signup_image') }}</div>
                                @if (!empty($getRecord->signupImage()))
                                <img src="{{ $getRecord->signupImage() }}" style="width:200px;">
                                @endif
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
@endsection