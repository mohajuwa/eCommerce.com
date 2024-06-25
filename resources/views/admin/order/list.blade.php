@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fuild">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Order List</h1>
            </div>

        </div>
    </div>
</section>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('admin.layouts._message')
                <form action="" method="get">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Order Search</h3>
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
                                        <label for="order_number">Order Number</label>
                                        <input type="text" name="order_number" placeholder="Order Number"
                                            value="{{ Request::get('order_number') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="company_name">Company Name</label>
                                        <input type="text" name="company_name" placeholder="Company Name"
                                            value="{{ Request::get('company_name') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" name="first_name" placeholder="First Name"
                                            value="{{ Request::get('first_name') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" name="last_name" placeholder="Last Name"
                                            value="{{ Request::get('last_name') }}" class="form-control">
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
                                        <label for="country">Country</label>
                                        <input type="text" name="country" placeholder="Country"
                                            value="{{ Request::get('country') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <input type="text" name="state" placeholder="State"
                                            value="{{ Request::get('state') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" name="city" placeholder="City"
                                            value="{{ Request::get('city') }}" class="form-control">
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
                                    <a href="{{ url('admin/order/list') }}" class="btn btn-sm btn-secondary">Reset</a>
                                </div>
                            </div>


                        </div>
                    </div>
                </form>
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Order List (Total : {{ $getRecord->total() }}) </h3>
                        <div class="float-end" style="text-align: right;">
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary">
                                Back
                                <i class="nav-icon fas fa-arrow-right"></i>
                            </a>
                        </div>

                    </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body p-0" style="overflow: auto">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Company Name</th>

                                    <th>Order Number</th>
                                    <th>Country</th>
                                    <th>PymentMethod</th>
                                    <th>Date</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getRecord as $value)
                                <tr>

                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->company_name }}</td>

                                    <td>{{ $value->order_number }}</td>



                                    <td>{{ $value->country }}</td>
                                    <td>{{ $value->payment_method }}</td>
                                    <td>{{ date('d-m-y h:i A', strtotime($value->created_at)) }}</td>
                                    <td>${{ number_format($value->total_amount, 2) }}</td>


                                    <td>
                                        <select class="form-control changeStatus" id="{{ $value->id }}"
                                            style="width:120px;">
                                            <option {{ $value->status == 0 ? 'selected' : '' }} value="0">
                                                Pending
                                            </option>
                                            <option {{ $value->status == 1 ? 'selected' : '' }} value="1">
                                                In progress
                                            </option>
                                            <option {{ $value->status == 2 ? 'selected' : '' }} value="2">
                                                Delivered
                                            </option>
                                            <option {{ $value->status == 3 ? 'selected' : '' }} value="3">
                                                Complated
                                            </option>
                                            <option {{ $value->status == 4 ? 'selected' : '' }} value="4">
                                                Cancelled
                                            </option>

                                        </select>
                                        {{-- <span class="badge bg-{{ $value->is_payment == 1 ? 'info' : 'danger' }}">{{
                                            $value->is_payment == 1 ? 'Done' : 'un-done' }}</span> --}}
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/order/detail/' . $value->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="  small fas fa-eye"></i>
                                        </a>

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
<script type="text/javascript">
    $('body').delegate('.changeStatus', 'change', function() {
            var status = $(this).val();
            var order_id = $(this).attr('id');
            $.ajax({
                type: "GET",
                url: "{{ url('admin/order_status') }}",
                data: {
                    status: status,
                    order_id: order_id
                },
                // token:{{ csrf_field() }},
                dataType: "json",
                success: function(data) {
                    alert(data.message);

                }
            });
        });
</script>
@endsection