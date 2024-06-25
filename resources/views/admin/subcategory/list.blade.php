@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fuild">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Sub Category List</h1>
            </div>
            <div class="col-sm-6" style="text-align: right">
                <a href="{{ url('admin/sub_category/add') }}" class="btn btn-sm  btn-primary">Add new Sub Category</a>
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
                        <h3 class="cardtitle">Sub Category List</h3>

                    </div>

                    <!-- /.card-header -->
                    <div class="card-body p-0   ">
                        <table
                            class="table table-striped table-responsive-lg  table-responsive-sm table-responsive-md table-responsive-xxl">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>CategoryName</th>
                                    <th>SubCategoryName</th>
                                    <th>Slug</th>
                                    <th>MetaTitle</th>
                                    {{-- <th>MetaKeywords</th> --}}
                                    {{-- <th>MetaDescription</th> --}}

                                    <th>CreatedBy</th>
                                    <th>Status</th>
                                    <th>CreatedDate</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getRecord as $value)
                                <tr>

                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->category_name }}</td>

                                    <td>{{ $value->name }}</td>

                                    <td>{{ $value->slug }}</td>
                                    <td>{{ $value->meta_title }}</td>
                                    {{-- <td>{{ $value->meta_description }}</td>
                                    <td>{{ $value->meta_keyword }}</td> --}}
                                    <td><span class="badge bg-secondary">{{ $value->created_by_name }}</span>



                                    <td><span class="badge bg-{{ $value->status == 0 ? 'info' : 'danger' }}">{{
                                            $value->status == 0 ? 'Active' : 'Inactive' }}</span>
                                    </td>
                                    <td>{{ date('d-m-y', strtotime($value->created_at)) }}</td>

                                    <td>
                                        <a href="{{ url('admin/sub_category/edit/' . $value->id) }}"
                                            class="btn btn-sm btn-primary"><i
                                                            class="nav-icon fas fa-edit"></i></a>
                                        <a href="{{ url('admin/sub_category/delete/' . $value->id) }}"
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