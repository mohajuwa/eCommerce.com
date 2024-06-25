@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fuild">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add new Shipping Charge </h1>
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
                        <h3 class="card-title">Add new Shipping Charge </h3>
                        <div class="float-end" style="text-align: right;">
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary">
                                Back
                                <i class="nav-icon fas fa-arrow-right"></i>
                            </a>
                        </div>

                    </div>
                    </div>
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        <div class="card-body">

                            <div class="form-group">
                                <label>Shipping Charge Name <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                                    placeholder="Enter Name">
                                <div style="color:red">{{ $errors->first('name') }}</div>
                            </div>

                            <div class="form-group">
                                <label>Price <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" value="{{ old('price') }}" name="price"
                                    placeholder="Enter Price Amount">
                                <div style="color:red">{{ $errors->first('price') }}</div>
                            </div>

                            <div class="form-group">
                                <label>Status <span style="color:red;">*</span></label>
                                <select class="form-control" name="status">
                                    <option {{ old('status')==0 ? 'selected' : '' }} value="0">Active</option>
                                    <option {{ old('status')==1 ? 'selected' : '' }} value="1">Inactive</option>

                                </select>
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