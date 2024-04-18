@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fuild">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add new admin </h1>
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
                            <h3 class="card-title">Add new admin</h3>
                        </div>
                        <form action="" method="POST">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                                        placeholder="Enter Name">
                                    <div style="color:red">{{ $errors->first('name') }}</div>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" value="{{ old('email') }}" name="email"
                                        placeholder="Enter email">
                                    <div style="color:red">{{ $errors->first('email') }}</div>

                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control " name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option {{ old('status') == 0 ? 'selected' : '' }} value="0">Active</option>
                                        <option {{ old('status') == 1 ? 'selected' : '' }} value="1">Inactive</option>

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
    <script src="{{ asset('assets/dist/js/pages/dashboard3.js') }}"></script>
@endsection
