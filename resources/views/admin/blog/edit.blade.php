@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fuild">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Blog </h1>
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
                        <h3 class="card-title">Edit Blog</h3>
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
                                <label>Title <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" value="{{ old('title', $getRecord->title) }}"
                                    name="title" placeholder="Enter Name">
                                <div style="color:red">{{ $errors->first('title') }}</div>
                            </div>

                            <div class="form-group">
                                <label>Category Name <span style="color:red;">*</span></label>
                                <select class=" form-control" name="blog_category_id" required>
                                    <option value="">Select</option>
                                    @foreach ($getCategory as $value)
                                    <option {{($value->id == $getRecord->blog_category_id) ? 'selected':''}}
                                        value="{{$value->id}}">
                                        {{$value->name}}</option>

                                    @endforeach
                                </select>
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
                                <img src="{{$getRecord->getImage()}}" style="width: 200px;" alt="Blog Image">
                            </div>
                            <div class="form-group">
                                <label>Short Description <span style="color:red;">*</span></label>
                                <textarea class="form-control " required name="short_description" rows="3"
                                    placeholder="Enter Short Description ">{{ old('short_description', $getRecord->short_description) }}</textarea>
                                <div style="color:red">{{ $errors->first('short_description') }}</div>
                            </div>

                            <div class="form-group">
                                <label>Description <span style="color:red;">*</span></label>
                                <textarea class="form-control editor" name="description" rows="5"
                                    placeholder="Enter Description ">{{ old('description', $getRecord->description) }}</textarea>
                                <div style="color:red">{{ $errors->first('description') }}</div>
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