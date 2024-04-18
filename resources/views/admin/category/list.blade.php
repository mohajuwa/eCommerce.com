@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fuild">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Category List</h1>
            </div>
            <div class="col-sm-6" style="text-align: right">
                <a href="{{ url('admin/category/add') }}" class="btn  btn-primary">Add new Category</a>
            </div>
        </div>
    </div>
</section>


<section class="content">
    <div class="container-fuild">
        <div class="row">
            <div class="col-12">
                @include('admin.layouts._message')

                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title">Category List</h3>

                    </div>

                    <!-- /.card-header -->
                    <div class="card-body p-0   ">
                        <table
                            class="table table-striped table-responsive-lg  table-responsive-sm table-responsive-md table-responsive-xxl">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Meta Title</th>
                                    <th>Meta Description</th>
                                    <th>Meta Keywords</th>
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
                                    <td>{{ $value->slug }}</td>
                                    <td>{{ $value->meta_title }}</td>
                                    <td>{{ $value->meta_description }}</td>
                                    <td>{{ $value->meta_keyword }}</td>
                                    <td>{{ $value->created_by_name }}</td>



                                    <td><span class="badge bg-{{ $value->status == 0 ? 'info' : 'danger' }}">{{
                                            $value->status == 0 ? 'Active' : 'Inactive' }}</span>
                                    </td>
                                    <td>{{ date('d-m-y', strtotime($value->created_at)) }}</td>

                                    <td>
                                        <a href="{{ url('admin/category/edit/' . $value->id) }}"
                                            class="btn btn-primary">Edit</a>
                                        <a href="{{ url('admin/category/delete/' . $value->id) }}"
                                            class="btn btn-danger">delete</a>
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
<script src="{{ asset('assets/dist/js/pages/dashboard3.js') }}"></script>
@endsection