@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
        <h2 class="alert alert-success">{{ session('message') }},</h2>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Add Slider
                    <a href="{{ url('admin/sliders') }}" class="btn btn-primary btn-sm float-end">
                        Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{url('admin/sliders/create')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="">Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Description</label>
                        <textarea name="description" rows="3" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Status</label><br />
                        <input type="checkbox" name="status" style="width: 20px; height:20px">
                        Checked=Hidden,Un-Checked=Visible
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection