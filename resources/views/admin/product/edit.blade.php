@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fuild">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Product </h1>
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
                        <h3 class="card-title">Edit Product</h3>
                    </div>
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>Product Title <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" value="{{ old('title', $getRecord->title) }}"
                                    name="title" placeholder="Enter Title">
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
<script src="{{ asset('assets/dist/js/pages/dashboard3.js') }}"></script>
@endsection