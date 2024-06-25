@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fuild">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Customer </h1>
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
                        <h3 class="card-title">Edit Customer </h3>
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
                                <label>Name</label>
                                <input type="text" class="form-control" required
                                    value="{{ old('name',$getRecord->name) }}" name="name" placeholder="Enter Name">
                                <div style="color:red">{{$errors->first('name')}}</div>

                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" required
                                    value="{{ old('email',$getRecord->email )}}" name="email" placeholder="Enter email">
                                <div style="color:red">{{ $errors->first('email') }}</div>

                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" class="form-control " value="" name="password"
                                    placeholder="Password">
                                <p>Do you want to change password so , please add</p>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" required name="status">
                                    <option {{ $getRecord->status == 0 ? 'selected' : '' }} value="0">Active
                                    </option>
                                    <option {{ $getRecord->status == 1 ? 'selected' : '' }} value="1">Inactive
                                    </option>

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