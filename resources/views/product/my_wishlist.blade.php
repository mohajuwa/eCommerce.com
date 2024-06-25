@extends('layout.app')
@section('style')
    <style type="text/css">

    </style>
@endsection
@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image:{{ url('assets/images/page-header-bg.jpg') }}">
            <div class="container">
                <h1 class="page-title">My Wishlist</h1>
            </div>
        </div>
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:;">Shop</a></li>

                </ol>
            </div>
        </nav>

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <div id="getProductAjax">
                            @include('product._list')
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    <script type="text/javascript"></script>
@endsection
