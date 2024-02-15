@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
        <h2 class="alert alert-success">{{ session('message') }},</h2>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Eidt Color
                    <a href="{{ url('admin/colors/') }}" class="btn btn-primary btn-sm float-end">
                        Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{url('admin/colors/'.$color->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="">Color Name</label>
                        <input type="text" value="{{$color->name}}" name="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Colors Code</label>
                        <input type="text" value="{{$color->code}}" name="code" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Status</label><br />
                        <input type="checkbox" {{$color->status ? 'checked':''}} name="status" style="width: 20px;
                        height:20px"> Checked=Hidden,Un-Checked=Visible
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection