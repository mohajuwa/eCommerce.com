@extends('layout.app')

@section('style')
<style>
    .btn-xs {
        padding: 2px 5px;
        font-size: 10px;
        line-height: 1.5;
        border-radius: 3px;
        width: 50px !important;
        /* Adjust the width as needed */
    }
</style>
@endsection

@section('content')
<main class="main">
    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title">Orders</h1>
        </div>
    </div>
    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <br />
                <div class="row">
                    @include('user._sidebar')
                    <div class="col-md-8 col-lg-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Order List</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Order Number</th>
                                                <th>Payment Method</th>
                                                <th>Date</th>
                                                <th>Total Amount</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->order_number }}</td>
                                                <td>{{ $value->payment_method }}</td>
                                                <td><span class="text-sm text-info" style="font-size: 8px">{{
                                                        date('d-m-y h:i A', strtotime($value->created_at)) }}</span>
                                                </td>
                                                <td>${{ number_format($value->total_amount, 2) }}</td>
                                                <td>
                                                    @if ($value->status == 0)
                                                    <span style="color: cornflowerblue">Pending</span>
                                                    @elseif ($value->status == 1)
                                                    <span style="color: aquamarine">In Progress</span>
                                                    @elseif ($value->status == 2)
                                                    <span style="color: green">Delivered</span>
                                                    @elseif ($value->status == 3)
                                                    <span style="color: chartreuse">Completed</span>
                                                    @elseif ($value->status == 4)
                                                    <span style="color: red">Cancelled</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('user/detail/' . $value->id) }}"
                                                        class="btn btn-primary btn-xs">
                                                        Detail
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div style="padding: 10px; float: right;">
                                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links()
                                    !!}
                                </div>
                            </div>
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