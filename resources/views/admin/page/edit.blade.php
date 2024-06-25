@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fuild">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Page </h1>
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
                        <h3 class="card-title">Edit Page </h3>
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
                                <label>Page Name <span style="color:red;">*</span></label>
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
                                <label>Title <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" value="{{ old('title', $getRecord->title) }}"
                                    name="title" placeholder="Enter Title">
                                <div style="color:red">{{ $errors->first('title') }}</div>
                            </div>
                            <div class="form-group">
                                <label>Image <span style="color:red;">*</span></label>
                                <input type="file" class="form-control" name="image">
                                @if (!empty($getRecord->getImage()))
                                <img src="{{ $getRecord->getImage() }}" class=" img-fluid" alt="" style="width: 200px;">

                                @endif
                                <div style="color:red">{{ $errors->first('image') }}</div>
                            </div>

                            <div class="form-group">
                                <label>Description <span style="color:red;">*</span></label>
                                <textarea class="form-control editor" name="description"
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
                                    value="{{ old('meta_keywords', $getRecord->meta_keywords) }}" name="meta_keywords"
                                    placeholder="Enter Kaywords">
                                <div style="color:red">{{ $errors->first('meta_keywords') }}</div>
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



<script type="text/javascript">

</script>
@endsection