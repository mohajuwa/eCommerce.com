@extends('layout.app')
@section('style')
<style type="text/css">
    .box-btn {
        padding: 10px;
        text-align: center;
        border-radius: 5px;
        box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
    }
</style>
@endsection
@section('content')
<main class="main">
    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title">Dashboard</h1>
        </div>
    </div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Account</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <br />
                <div class="row">


                    @include('user._sidebar')

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <div class="row">
                                <div class="col-md-3" style="margin-bottom:20px">
                                    <div class="box-btn">
                                        <div style="font-size: 20px;font-weight:bold;">{{$TotalOrders}}<div>
                                                <div style="font-size: 16px">Total Orders<div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="margin-bottom:20px">
                                    <div class="box-btn">
                                        <div style="font-size: 20px;font-weight:bold;">{{$TodayTotalOrders}}<div>
                                                <div style="font-size: 16px">Today's Orders<div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="margin-bottom:20px">
                                    <div class="box-btn">
                                        <div style="font-size: 20px;font-weight:bold;">
                                            ${{number_format($TotalAmount,2)}}<div>
                                                <div style="font-size: 16px">Total Amount<div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="margin-bottom:20px">
                                    <div class="box-btn">
                                        <div style="font-size: 20px;font-weight:bold;">
                                            ${{number_format($TodayTotalAmount,2)}}<div>
                                                <div style="font-size: 16px">Today's Amount<div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="margin-bottom:20px">
                                    <div class="box-btn">
                                        <div style="font-size: 20px;font-weight:bold;">{{$TotalPending}}<div>
                                                <div style="font-size: 16px">Pending Orders<div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="margin-bottom:20px">
                                    <div class="box-btn">
                                        <div style="font-size: 20px;font-weight:bold;">{{$TotalInprogress}}<div>
                                                <div style="font-size: 16px">In Progress Orders<div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="margin-bottom:20px">
                                    <div class="box-btn">
                                        <div style="font-size: 20px;font-weight:bold;">{{$TotalComplated}}<div>
                                                <div style="font-size: 16px">Complated Orders<div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="box-btn">
                                        <div style="font-size: 20px;font-weight:bold;">{{$TotalDelivered}}<div>
                                                <div style="font-size: 16px">Delivered Orders<div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="box-btn">
                                        <div style="font-size: 20px;font-weight:bold;">{{$TotalCancelled}}<div>
                                                <div style="font-size: 16px">Cancelled Orders<div>
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
@endsection
@section('script')
<script src="{{ url('assets/js/jquery.elevateZoom.min.js') }}"></script>
<script src="{{ url('assets/js/bootstrap-input-spinner.js') }}"></script>
<script src="{{ url('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script type="text/javascript"></script>
@endsection