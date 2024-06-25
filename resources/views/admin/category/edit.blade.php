@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fuild">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Category </h1>
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
                        <h3 class="card-title">Edit Category</h3>
                        </h3>
                        <div class="float-end" style="text-align: right;">
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary">
                                Back
                                <i class="nav-icon fas fa-arrow-right"></i>
                            </a>
                        </div>

                    </div>


                    <form action="" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>Category Name <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" value="{{ old('name', $getRecord->name) }}"
                                    name="name" placeholder="Enter Name">
                                <div style="color:red">{{ $errors->first('name') }}</div>
                            </div>
                            <div class="form-group">
                                <label>Slug <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" value="{{ old('slug', $getRecord->slug) }}"
                                    name="slug" placeholder="Enter Slug Ex. URL">
                                <div style="color:red">{{ $errors->first('slug') }}</div>
                            </div>
                            <div class="form-group">
                                <label>Status <span style="color:red;">*</span></label>
                                <select class="form-control" name="status">
                                    <option {{ old('status', $getRecord->status) == 0 ? 'selected' : '' }}
                                        value="0">Active</option>
                                    <option {{ old('status', $getRecord->status) == 1 ? 'selected' : '' }}
                                        value="1">Inactive</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Image </label>
                                <input type="file" class="form-control" name="image_name">
                                <div style="color:red">{{ $errors->first('image_name') }}</div>
                                <img src="{{$getRecord->getImage()}}" style="width: 200px;" alt="Category Image">
                            </div>
                            <div class="form-group">
                                <label>Button Name<span style="color:red;"></span></label>
                                <input type="text" class="form-control"
                                    value="{{ old('button_name', $getRecord->button_name) }}" name="button_name"
                                    placeholder="Enter Button Name">
                                <div style="color:red">{{ $errors->first('button_name') }}</div>
                            </div>
                            <div class="form-group">
                                <label style="display: block">Home Screen<span style="color:red;"></span></label>
                                <input type="checkbox" {{!empty($getRecord->is_home)? 'checked':''}} name="is_home">
                                <div style="color:red">{{ $errors->first('is_home') }}</div>
                            </div>
                            <div class="form-group">
                                <label style="display: block">Menu<span style="color:red;"></span></label>
                                <input type="checkbox" {{!empty($getRecord->is_menu)? 'checked':''}} name="is_menu">
                                <div style="color:red">{{ $errors->first('is_menu') }}</div>
                            </div>
                            <div class="form-group">
                                <label>Meta title <span style="color:red;">*</span></label>
                                <input type="text" class="form-control"
                                    value="{{ old('meta_title', $getRecord->meta_title) }}" name="meta_title"
                                    placeholder="Enter Meta Title">
                                <div style="color:red">{{ $errors->first('meta_title') }}</div>
                            </div>
                            <div class="form-group">
                                <label>Meta Description</label>
                                <input type="text" class="form-control"
                                    value="{{ old('meta_description', $getRecord->meta_description) }}"
                                    name="meta_description" placeholder="Enter Meta Description">
                                <div style="color:red">{{ $errors->first('meta_description') }}</div>
                            </div>
                            <div class="form-group">
                                <label>Meta Keyword</label>
                                <input type="text" class="form-control"
                                    value="{{ old('meta_keyword', $getRecord->meta_keyword) }}" name="meta_keyword"
                                    placeholder="Enter Kaywords">
                                <div style="color:red">{{ $errors->first('meta_keyword') }}</div>
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