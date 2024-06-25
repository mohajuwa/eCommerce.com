@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fuild">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Customer List</h1>
            </div>
            <div class="col-sm-6" style="text-align: right">
                <a href="{{ url('admin/customer/add') }}" class="btn btn-sm  btn-primary">Add new Customer</a>
            </div>
        </div>
    </div>
</section>


<section class="content">
    <div class="container-fuild">
        <div class="row">
            <div class="col-12">
                @include('admin.layouts._message')
                <form action="" method="get">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Customer Search</h3>
                        </div>
                        <div class="card-body " style="overflow:auto">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="id">ID</label>
                                        <input type="text" name="id" placeholder="ID" value="{{ Request::get('id') }}"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="name"> Name</label>
                                        <input type="text" name="name" placeholder=" Name"
                                            value="{{ Request::get('name') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" placeholder="Email"
                                            value="{{ Request::get('email') }}" class="form-control">
                                    </div>
                                </div>




                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="from_date">From Date</label>
                                        <input type="date" style="padding: 6px;" name="from_date"
                                            placeholder="From Date" value="{{ Request::get('from_date') }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="to_date">To Date</label>
                                        <input type="date" style="padding: 6px;" name="to_date" placeholder="To Date"
                                            value="{{ Request::get('to_date') }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-sm btn-info">Search</button>
                                    <a href="{{ url('admin/customer/list') }}"
                                        class="btn btn-sm btn-secondary">Reset</a>
                                </div>
                            </div>


                        </div>
                    </div>
                </form>
                <div class="card  card-info">

                    <div class="card-header">
                        <h3 class="card-title">Customer List (Total : {{ $getRecord->total() }}) </h3>
                        <div class="float-end" style="text-align: right;">
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary">
                                Back
                                <i class="nav-icon fas fa-arrow-right"></i>
                            </a>
                        </div>

                    </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body p-0   ">
                        <table
                            class="table table-striped table-responsive-lg  table-responsive-sm table-responsive-md table-responsive-xxl">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Date</th>
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
                                    <td>{{ date('d-m-y', strtotime($value->created_at)) }}</td>

                                    <td>
                                        <a href="{{ url('admin/customer/edit/' . $value->id) }}"
                                            class="btn btn-sm btn-primary"><i class="nav-icon fas fa-edit"></i></a>
                                        <a href="{{ url('admin/customer/delete/' . $value->id) }}"
                                            class="btn btn-sm btn-danger"><i class="nav-icon fas fa-trash"></i></a>
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