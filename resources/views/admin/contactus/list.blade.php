@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fuild">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Contact Us </h1>
            </div>
            {{-- <div class="col-sm-6" style="text-align: right">
                <a href="{{ url('admin/contact_us/add') }}" class="btn btn-sm  btn-primary">Add new Contact Us</a>
            </div> --}}
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
                            <h3 class="card-title">Contact Us Search</h3>
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
                                        <input type="text" name="name" placeholder="First Name"
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
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" placeholder="Phone"
                                            value="{{ Request::get('phone') }}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="subject">Subject</label>
                                        <input type="text" name="subject" placeholder="Subject"
                                            value="{{ Request::get('subject') }}" class="form-control">
                                    </div>
                                </div>



                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-sm btn-info">Search</button>
                                    <a href="{{ url('admin/contact_us') }}" class="btn btn-sm btn-secondary">Reset</a>
                                </div>
                            </div>


                        </div>
                    </div>
                </form>
                <div class="card  card-info ">
                    <div class="card-header">
                        <h3 class="card-title">Contact Us </h3>

                    </div>

                    <!-- /.card-header -->
                    <div class="card-body p-0   ">
                        <table
                            class="table table-striped table-responsive-lg  table-responsive-sm table-responsive-md table-responsive-xxl">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Login Name</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getRecord as $value)
                                <tr>

                                    <td>{{ $value->id }}</td>
                                    <td>{{ !empty($value->getUser) ? $value->getUser->name : '' }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->phone }}</td>
                                    <td>{{ $value->subject }}</td>
                                    <td>{{ $value->message }}</td>



                                    <td>
                                        <a href="{{ url('admin/contact_us/delete/' . $value->id) }}"
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