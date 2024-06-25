@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fuild">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Page List</h1>
                </div>
                {{-- <div class="col-sm-6" style="text-align: right">
                    <a href="{{ url('admin/page/add') }}" class="btn btn-sm  btn-primary">Add new Page</a>
                </div> --}}
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fuild">
            <div class="row">
                <div class="col-12">
                    @include('admin.layouts._message')

                    <div class="card card-info ">
                        <div class="card-header">
                            <h3 class="card-title">Page List</h3>

                        </div>

                        <!-- /.card-header -->
                        <div class="card-body p-0   ">
                            <table
                                class="table table-striped table-responsive-lg  table-responsive-sm table-responsive-md table-responsive-xxl">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Title</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $value)
                                        <tr>

                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->title }}</td>

                                            <td>
                                                <a href="{{ url('admin/page/edit/' . $value->id) }}"
                                                    class="btn btn-sm btn-primary"><i class="nav-icon fas fa-edit"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                           
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
