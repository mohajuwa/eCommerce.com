@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fuild">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Admin List</h1>
            </div>
            <div class="col-sm-6" style="text-align: right">
                <a href="{{ url('admin/admin/add') }}" class="btn  btn-primary">Add new admin</a>
            </div>
        </div>
    </div>
</section>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('admin.layouts._message')

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Admin List</h3>

                    </div>

                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getRecord as $value)
                                <tr>

                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td><span class="badge bg-{{ $value->status == 0 ? 'info' : 'danger' }}">{{
                                            $value->status == 0 ? 'Active' : 'Inactive' }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/admin/edit/' . $value->id) }}"
                                            class="btn btn-primary"><i
                                                            class="nav-icon fas fa-edit"></i></a>
                                        <a href="{{ url('admin/admin/delete/' . $value->id) }}"
                                            class="btn btn-danger"><i
                                                            class="nav-icon fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                        <div style="padding: 10px;float: right;">
                            {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')

@endsection