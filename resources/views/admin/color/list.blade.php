@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fuild">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Color List</h1>
            </div>
            <div class="col-sm-6" style="text-align: right">
                <a href="{{ url('admin/color/add') }}" class="btn btn-sm  btn-primary">Add new Color</a>
            </div>
        </div>
    </div>
</section>


<section class="content">
    <div class="container-fuild">
        <div class="row">
            <div class="col-12">
                @include('admin.layouts._message')

                <div class="card  card-info ">
                    <div class="card-header">
                        <h3 class="cardtitle">Color List</h3>

                    </div>

                    <!-- /.card-header -->
                    <div class="card-body p-0   ">
                        <table
                            class="table table-striped table-responsive-lg  table-responsive-sm table-responsive-md table-responsive-xxl">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getRecord as $value)
                                <tr>

                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>
                                        <span class="badge  shadow  @if ($value->code == '#ffffff')
                                            bg-secondary
                                        " style="width:35px;" @endif>


                                            <span class="badge  shadow "
                                                style="background-color:{{$value->code}}; width:25px;">

                                            </span> </span>
                                        {{ $value->code }}
                                    </td>
                                    <td><span class="badge bg-secondary">{{ $value->created_by_name }}</span>
                                    </td>


                                    <td><span class="badge bg-{{ $value->status == 0 ? 'info' : 'danger' }}">{{
                                            $value->status == 0 ? 'Active' : 'Inactive' }}</span>
                                    </td>
                                    <td>{{ date('d-m-y', strtotime($value->created_at)) }}</td>

                                    <td>
                                        <a href="{{ url('admin/color/edit/' . $value->id) }}"
                                            class="btn btn-sm btn-primary"><i
                                                            class="nav-icon fas fa-edit"></i></a>
                                        <a href="{{ url('admin/color/delete/' . $value->id) }}"
                                            class="btn btn-sm btn-danger"><i
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