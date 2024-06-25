@extends('layout.app')
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
    <main class="main">
        <div class="page-header text-center">
            <div class="container">
                <h1 class="page-title">Orders Details</h1>
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

                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card card-info">
                                                <div class="card-header">
                                                    <h3 class="card-title">Order Information</h3>
                                                </div>
                                                <div class="">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="order_id">Order Number:</label>
                                                            <span>{{ $getRecord->order_number }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="first_name">First Name:</label>
                                                            <span>{{ $getRecord->first_name }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="last_name">Last Name:</label>
                                                            <span>{{ $getRecord->last_name }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="company_name">Company Name:</label>
                                                            <span>{{ $getRecord->company_name }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="country">Country:</label>
                                                            <span>{{ $getRecord->country }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="address_one">Address Line 1:</label>
                                                            <span>{{ $getRecord->address_one }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="address_two">Address Line 2:</label>
                                                            <span>{{ $getRecord->address_two }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="city">City:</label>
                                                            <span>{{ $getRecord->city }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="state">State:</label>
                                                            <span>{{ $getRecord->state }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="post_code">Post Code:</label>
                                                            <span>{{ $getRecord->post_code }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="phone">Phone:</label>
                                                            <span>{{ $getRecord->phone }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email:</label>
                                                            <span>{{ $getRecord->email }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="note">Note:</label>
                                                            <span>{{ $getRecord->note }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="shipping_id">Shipping ID:</label>
                                                            <span>{{ $getRecord->shipping_id }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="shipping_amount">Shipping Amount ($):</label>
                                                            <span>${{ number_format($getRecord->shipping_amount, 2) }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="discount_code">Discount Code:</label>
                                                            <span>{{ $getRecord->discount_code }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="discount_amount">Discount Amount ($):</label>
                                                            <span>${{ number_format($getRecord->discount_amount, 2) }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="total_amount">Total Amount ($):</label>
                                                            <span>${{ number_format($getRecord->total_amount, 2) }}</span>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="payment_method">Payment Method:</label>
                                                            <span>{{ $getRecord->payment_method }}</span>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="status">Status:</label>
                                                            @if ($getRecord->status == 0)
                                                                <span style="color:cornflowerblue">Pending</span>
                                                            @elseif ($getRecord->status == 1)
                                                                <span style="color:aquamarine">In Progress</span>
                                                            @elseif ($getRecord->status == 2)
                                                                <span style="color: green">Delivered</span>
                                                            @elseif ($getRecord->status == 3)
                                                                <span style="color:chartreuse">Complated</span>
                                                            @elseif ($getRecord->status == 4)
                                                                <span style="color: red">Cancelled</span>
                                                            @endif
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="created_at">Created Date :</label>
                                                            <span>{{ date('d-m-Y h:i A', strtotime($getRecord->created_at)) }}</span>
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
                                                                            <th>Size Amount($)</th>

                                                                            <th>Total Amount($)</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($getRecord->getItem as $item)
                                                                            @php

                                                                                $getProductImage = $item->product->getImageSingle(
                                                                                    $item->product->id,
                                                                                );
                                                                            @endphp
                                                                            <tr>
                                                                                <td>
                                                                                    <img style="width: 100px;height:100px;"
                                                                                        src="{{ $getProductImage->getImage() }}"
                                                                                        alt="">
                                                                                </td>
                                                                                <td class="text-center p-5">
                                                                                    <a href="{{ url($item->product->slug) }}"
                                                                                        class=" link-black" target="_blank"
                                                                                        rel="noopener noreferrer">
                                                                                        {{ $item->product->title }}



                                                                                    </a>
                                                                                    @if (!empty($item->color_name))
                                                                                        <br />
                                                                                        Color Name: {{ $item->color_name }}
                                                                                    @endif
                                                                                    @if (!empty($item->size_name))
                                                                                        <br />
                                                                                        Size Name: {{ $item->size_name }}
                                                                                    @endif

                                                                                    <br />

                                                                                    @if ($getRecord->status == 3)
                                                                                        @php
                                                                                            $getReview = $item->getReview(
                                                                                                $item->product->id,
                                                                                                $getRecord->id,
                                                                                            );
                                                                                        @endphp
                                                                                        @if (!empty($getReview))
                                                                                            <div class="ratings-container">
                                                                                                <div class="ratings">
                                                                                                    <div class="ratings-val"
                                                                                                        style="width: {{ (($getReview->rating * 1000) / 100) * 2 }}%;">
                                                                                                    </div>
                                                                                                </div>
                                                                                                @if (!empty($getReview->review))
                                                                                                    @php
                                                                                                        // Split the review text into an array of words
                                                                                                        $reviewWords = explode(
                                                                                                            ' ',
                                                                                                            $getReview->review,
                                                                                                        );
                                                                                                        // Get the first three words
                                                                                                        $firstThreeWords = array_slice(
                                                                                                            $reviewWords,
                                                                                                            0,
                                                                                                            3,
                                                                                                        );
                                                                                                        // Join the first three words back into a string
                                                                                                        $reviewSnippet = implode(
                                                                                                            ' ',
                                                                                                            $firstThreeWords,
                                                                                                        );
                                                                                                    @endphp
                                                                                                    <span
                                                                                                        class="ratings-text">({{ $reviewSnippet }}...)</span>
                                                                                                @endif



                                                                                            </div>
                                                                                        @else
                                                                                            <button
                                                                                                class="btn btn-primary makeReview"
                                                                                                id="{{ $item->product->id }}"
                                                                                                data-order="{{ $getRecord->id }}">Make
                                                                                                Review</button>
                                                                                        @endif
                                                                                    @endif
                                                                                </td>
                                                                                <td class="text-center p-5">
                                                                                    {{ $item->quantity }}
                                                                                </td>
                                                                                <td class="text-center p-5">
                                                                                    ${{ number_format($item->price, 2) }}
                                                                                </td>


                                                                                <td class="text-center p-5">
                                                                                    ${{ number_format($item->size_amount, 2) }}
                                                                                </td>
                                                                                <td class="text-center p-5">
                                                                                    ${{ number_format($item->total_price, 2) }}
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <!-- Modal -->
    <div class="modal fade" id="makeReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Make Review</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('user/make-review') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" required id="getProductId" name="product_id">
                    <input type="hidden" required id="getOrderId" name="order_id">
                    <div class="modal-body" style="padding: 20px">
                        <div class="form-group" style="margin-bottom: 15px">
                            <label>How many star? <span class="text-danger">*</span></label>
                            <select class="form-control" required name="rating">
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Review</label>
                            <textarea class="form-control" name="review"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('body').delegate('.makeReview', 'click', function() {

            var product_id = $(this).attr('id');
            var order_id = $(this).attr('data-order');
            $('#getProductId').val(product_id);
            $('#getOrderId').val(order_id);
            $('#makeReviewModal').modal('show');

        });
    </script>
@endsection
