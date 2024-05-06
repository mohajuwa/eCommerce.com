@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fuild">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add new color </h1>
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
                        <h3 class="card-title">Add new color</h3>
                    </div>
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        <div class="card-body">

                            <div class="form-group">
                                <label>Color Name <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                                    placeholder="Enter Name">
                                <div style="color:red">{{ $errors->first('name') }}</div>
                            </div>
                            <div class="form-group">
                                <label>Code <span style="color:red;">*</span></label>
                                <input type="color" class="form-control" value="{{ old('code') }}" name="code"
                                    placeholder="Enter Code Ex. URL">
                                <div style="color:red">{{ $errors->first('code') }}</div>
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