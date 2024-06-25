@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fuild">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Partner </h1>
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
                        <h3 class="card-title">Edit Partner </h3>
                        <div class="float-end" style="text-align: right;">
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary">
                                Back
                                <i class="nav-icon fas fa-arrow-right"></i>
                            </a>
                        </div>

                    </div>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">





                            <div class="form-group">
                                <label>Image </label>
                                <input type="file" class="form-control" name="image_name">
                                <div style="color:red">{{ $errors->first('image_name') }}</div>
                                <img src="{{$getRecord->getImage()}}" style="width: 200px;" alt="Partner">
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Button Name<span style="color:red;"></span></label>
                                    <input type="text" class="form-control"
                                        value="{{ old('button_name', $getRecord->button_name) }}" name="button_name"
                                        placeholder="Enter Button Name">
                                    <div style="color:red">{{ $errors->first('button_name') }}</div>
                                </div>
                                <div class="form-group">
                                    <label>Button Link<span style="color:red;"></span></label>
                                    <input type="text" class="form-control"
                                        value="{{ old('button_link', $getRecord->button_link) }}" name="button_link"
                                        placeholder="Enter Button Link">
                                    <div style="color:red">{{ $errors->first('button_link') }}</div>
                                </div>
                                <div class="form-group">
                                    <label>Status <span style="color:red;"></span></label>
                                    <select class="form-control" name="status">
                                        <option {{ old('status', $getRecord->status) == 0 ? 'selected' : '' }}
                                            value="0">Active</option>
                                        <option {{ old('status', $getRecord->status) == 1 ? 'selected' : '' }}
                                            value="1">Inactive</option>

                                    </select>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Update</button>
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