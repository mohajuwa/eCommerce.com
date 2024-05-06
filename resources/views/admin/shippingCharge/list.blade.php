@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fuild">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Shipping Charge List</h1>
            </div>
            <div class="col-sm-6" style="text-align: right">
                <a href="{{ url('admin/shipping_charge/add') }}" class="btn  btn-primary">Add new Shipping Charge</a>
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
                        <h3 class="card-title">Shipping Charge List</h3>

                    </div>

                    <!-- /.card-header -->
                    <div class="card-body p-0   ">
                        <table
                            class="table table-striped table-responsive-lg  table-responsive-sm table-responsive-md table-responsive-xxl">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    {{-- <th>Type</th> --}}
                                    <th>Price</th>
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
                                    {{-- <td>{{ $value->price }}</td> --}}
                                    <td>
                                        @if ($value->price >= 50)
                                        <span class="badge   bg-pink">${{ (!empty($value->price) ?
                                            number_format($value->price,2) : '0.00')}}</span>
                                        @elseif ($value->price <= 20) <span class="badge    bg-success">${{
                                            (!empty($value->price) ?
                                            number_format($value->price,2) : '0.00')}}</span>
                                            @elseif ($value->price <= 100) <span class="badge    bg-danger">${{
                                                (!empty($value->price) ?
                                                number_format($value->price,2) : '0.00')}}</span>
                                                @else
                                                <span class="badge   bg-secondary">${{ (!empty($value->price) ?
                                                    number_format($value->price,2) : '0.00')}}</span>

                                                @endif


                                    </td>


                                    <td><span class="badge bg-{{ $value->status == 0 ? 'info' : 'danger' }}">{{
                                            $value->status == 0 ? 'Active' : 'Inactive' }}</span>
                                    </td>
                                    <td>{{ date('d-m-y', strtotime($value->created_at)) }}</td>

                                    <td>
                                        <a href="{{ url('admin/shipping_charge/edit/' . $value->id) }}"
                                            class="btn btn-primary"><i class="nav-icon fas fa-edit"></i></a>
                                        <a href="{{ url('admin/shipping_charge/delete/' . $value->id) }}"
                                            class="btn btn-danger"><i class="nav-icon fas fa-trash"></i></a>
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