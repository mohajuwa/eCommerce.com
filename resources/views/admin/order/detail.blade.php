@extends('admin.layouts.app')

@section('style')
<style type="text/css">
    .form-group {
        margin-bottom: 5px;

    }

    .form-group span {
        font-weight: normal;
        color: darkslateblue;
    }

    .form-group label {
        font-weight: bold;
        cursor: pointer;
        /* Add cursor pointer for indicating it's clickable */
    }

    .payment-data {
        /* Hide payment data initially */
        font-weight: normal;
        color: darkslateblue;
    }
</style>
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Order Details</h1>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Order Information </h3>
                        <div class="float-end" style="text-align: right;">
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary">
                                Back
                                <i class="nav-icon fas fa-arrow-right"></i>
                            </a>
                        </div>

                    </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="order_id">Order ID:</label>
                                <span>{{$getRecord->id}}</span>
                            </div>
                            <div class="form-group">
                                <label for="order_id">Order Number:</label>
                                <span>{{$getRecord->order_number}}</span>
                            </div>
                            <div class="form-group">
                                <label for="first_name">First Name:</label>
                                <span>{{$getRecord->first_name}}</span>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name:</label>
                                <span>{{$getRecord->last_name}}</span>
                            </div>
                            <div class="form-group">
                                <label for="company_name">Company Name:</label>
                                <span>{{$getRecord->company_name}}</span>
                            </div>
                            <div class="form-group">
                                <label for="country">Country:</label>
                                <span>{{$getRecord->country}}</span>
                            </div>
                            <div class="form-group">
                                <label for="address_one">Address Line 1:</label>
                                <span>{{$getRecord->address_one}}</span>
                            </div>
                            <div class="form-group">
                                <label for="address_two">Address Line 2:</label>
                                <span>{{$getRecord->address_two}}</span>
                            </div>
                            <div class="form-group">
                                <label for="city">City:</label>
                                <span>{{$getRecord->city}}</span>
                            </div>
                            <div class="form-group">
                                <label for="state">State:</label>
                                <span>{{$getRecord->state}}</span>
                            </div>
                            <div class="form-group">
                                <label for="post_code">Post Code:</label>
                                <span>{{$getRecord->post_code}}</span>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <span>{{$getRecord->phone}}</span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <span>{{$getRecord->email}}</span>
                            </div>
                            <div class="form-group">
                                <label for="note">Note:</label>
                                <span>{{$getRecord->note}}</span>
                            </div>
                            <div class="form-group">
                                <label for="shipping_id">Shipping ID:</label>
                                <span>{{$getRecord->shipping_id}}</span>
                            </div>
                            <div class="form-group">
                                <label for="shipping_amount">Shipping Amount ($):</label>
                                <span>${{number_format($getRecord->shipping_amount,2)}}</span>
                            </div>
                            <div class="form-group">
                                <label for="discount_code">Discount Code:</label>
                                <span>{{$getRecord->discount_code}}</span>
                            </div>
                            <div class="form-group">
                                <label for="discount_amount">Discount Amount ($):</label>
                                <span>${{number_format($getRecord->discount_amount,2)}}</span>
                            </div>
                            <div class="form-group">
                                <label for="total_amount">Total Amount ($):</label>
                                <span>${{number_format($getRecord->total_amount,2)}}</span>

                            </div>
                            <div class="form-group">
                                <label for="payment_method">Payment Method:</label>
                                <span>{{$getRecord->payment_method}}</span>
                            </div>
                            <div class="form-group">
                                <label for="transaction_id">Transaction ID:</label>
                                <span>{{$getRecord->transaction_id}}</span>
                            </div>
                            <div class="form-group">
                                <label for="stripe_session_id">Stripe Session ID:</label>
                                <span>{{$getRecord->stripe_session_id}}</span>
                            </div>
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <span>{{$getRecord->status}}</span>
                            </div>
                            <div class="form-group">
                                <label for="is_delete">Is Delete:</label>
                                <span>{{$getRecord->is_delete}}</span>
                            </div>
                            <div class="form-group">
                                <label for="is_payment">Is Payment:</label>
                                <span>{{$getRecord->is_payment}}</span>
                            </div>
                            <!-- Payment Data -->
                            @php
                            $paymentData = json_decode($getRecord->payment_data, true);
                            @endphp
                            <div class="form-group" id="paymentDataSection">
                                <label for="payment_data" class="payment_data" id="paymentDataToggle">Payment
                                    Data:
                                    @if (!empty($paymentData))
                                    <span style="color:green">View More</span>
                                    @endif
                                </label>
                                <div>

                                    @if (!empty($paymentData))
                                    @foreach($paymentData as $key => $value)
                                    <div class="form-group payment_data">
                                        <label> {{ ucfirst(str_replace('_', ' ', $key)) }}:</label>
                                        @if(is_array($value))
                                        <span>
                                            <pre
                                                style="color:crimson">{{ json_encode($value, JSON_PRETTY_PRINT) }}</pre>
                                        </span>
                                        @else
                                        <span style="color:#00790e">{{ $value }}</span>
                                        @endif
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="created_at">Created Date :</label>
                                <span>{{date('d-m-Y h:i A', strtotime($getRecord->created_at ))}}</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Product Information</h3>
                                </div>
                                <div class="card-body p-0" style="overflow:auto">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Product Name</th>
                                                <th>QTY</th>
                                                <th>price</th>
                                                <th>Size Name</th>
                                                <th>Color Name</th>
                                                <th>Size Amount($)</th>
                                                <th>Total Amount($)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($getRecord->getItem as $item )
                                            @php

                                            $getProductImage = $item->product->getImageSingle($item->product->id)
                                            @endphp
                                            <tr>
                                                <td>
                                                    <img style="width: 100px;height:100px;"
                                                        src="{{$getProductImage->getImage()}}" alt="">
                                                </td>
                                                <td class="text-center p-5">
                                                    <a href="{{url($item->product->slug)}}" class=" link-black"
                                                        target="_blank" rel="noopener noreferrer">
                                                        {{$item->product->title}}
                                                    </a>
                                                </td>
                                                <td class="text-center p-5">{{$item->quantity}}</td>
                                                <td class="text-center p-5">${{number_format($item->price,2)}}</td>
                                                <td class="text-center p-5">{{$item->size_name}}</td>
                                                <td class="text-center p-5">{{$item->color_name}}</td>

                                                <td class="text-center p-5">${{number_format($item->size_amount,2)}}
                                                </td>
                                                <td class="text-center p-5">${{number_format($item->total_price,2)}}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var paymentDataSection = document.getElementById('paymentDataSection');
            var paymentData = paymentDataSection.querySelector('div');
            paymentData.style.display = 'none';
        // Add click event listener to toggle the display of payment data
        document.getElementById('paymentDataToggle').addEventListener('click', function() {
          
            if (paymentData.style.display === 'none') {
                paymentData.style.display = 'block'; // Display payment data
            } else {
                paymentData.style.display = 'none'; // Hide payment data
            }
        });
    });
</script>
@endsection