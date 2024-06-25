@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fuild">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Category List</h1>
            </div>
            <div class="col-sm-6" style="text-align: right">
                <a href="{{ url('admin/category/add') }}" class="btn btn-sm  btn-primary">Add new Category</a>
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
                        <h3 class="cardtitle">Category List</h3>

                    </div>

                    <!-- /.card-header -->
                    <div class="card-body p-0   ">
                        <table
                            class="table table-striped table-responsive-lg  table-responsive-sm table-responsive-md table-responsive-xxl">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Slug</th>
                                    <th class="text-center">Meta Title</th>
                                    {{-- <th class="text-center">Meta Description</th>
                                    <th class="text-center">Meta Keywords</th> --}}
                                    <th class="text-center">Created By</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Home</th>
                                    <th class="text-center">Menu</th>
                                    <th class="text-center">Created Date</th>
                                    <th class="text-center">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getRecord as $value)
                                <tr>

                                    <td class="text-center">{{ $value->id }}</td>
                                    <td class="text-center">
                                        @if (!empty($value->getImage()))
                                        <img src="{{$value->getImage()}}" style="width: 60px" alt="">

                                        @endif
                                    </td>
                                    <td class="text-center">{{ $value->name }}</td>
                                    <td class="text-center">{{ $value->slug }}</td>
                                    <td class="text-center">{{ $value->meta_title }}</td>
                                    {{-- <td class="text-center">{{ $value->meta_description }}</td>
                                    <td class="text-center">{{ $value->meta_keyword }}</td> --}}
                                    <td class="text-center"><span class="badge   bg-gray">{{ $value->created_by_name
                                            }}</span>



                                    <td class="text-center"><span
                                            class="badge bg-{{ $value->status == 0 ? 'info' : 'secondary' }}">{{
                                            $value->status == 0 ? 'Active' : 'Inactive' }}</span>
                                    </td>
                                    <td class="text-center"><span
                                            class="badge bg-{{ $value->is_home == 1 ? 'info' : 'secondary' }}">{{
                                            $value->is_home == 1 ? 'YES' : 'NO' }}</span>
                                    </td>
                                    <td class="text-center"><span
                                            class="badge bg-{{ $value->is_menu == 1 ? 'info' : 'secondary' }}">{{
                                            $value->is_menu == 1 ? 'YES' : 'NO' }}</span>
                                    </td>
                                    <td class="text-center">{{ date('d-m-y', strtotime($value->created_at)) }}</td>

                                    <td class="text-center">
                                        <a href="{{ url('admin/category/edit/' . $value->id) }}"
                                            class="btn btn-sm btn-primary"><i class="nav-icon fas fa-edit"></i></a>
                                        <a href="{{ url('admin/category/delete/' . $value->id) }}"
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