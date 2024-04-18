@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fuild">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add new product </h1>
                </div>

            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card   card-info">
                        <div class="card-header">
                            <h3 class="card-title">Add new product</h3>
                        </div>
                        <form action="" method="POST">
                            {{ csrf_field() }}
                            <div class="card-body">

                                <div class="form-group">
                                    <label> Title <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" value="{{ old('title') }}" name="title"
                                        placeholder="Enter Title">
                                    <div style="color:red">{{ $errors->first('title') }}</div>
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
    <script src="{{ asset('assets/dist/js/pages/dashboard3.js') }}"></script>
@endsection
