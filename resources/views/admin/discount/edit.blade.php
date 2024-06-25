@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fuild">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Discount Code </h1>
            </div>

        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card   card-info">
                    <div class="card-header">
                        <h3 class="card-title">Edit Discount Code </h3>
                        <div class="float-end" style="text-align: right;">
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary">
                                Back
                                <i class="nav-icon fas fa-arrow-right"></i>
                            </a>
                        </div>

                    </div>
                    </div>
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>Discount Code Name <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" value="{{ old('name', $getRecord->name) }}"
                                    name="name" placeholder="Enter Name">
                                <div style="color:red">{{ $errors->first('name') }}</div>
                            </div>


                            <div class="form-group">
                                <label>Type <span style="color:red;">*</span></label>
                                <select class="form-control" name="type">
                                    <option {{ old('type', $getRecord->type) == 'Amount' ? 'selected' : '' }}
                                        value="Amount">Amount</option>
                                    <option {{ old('type', $getRecord->type) == 'Precent' ? 'selected' : '' }}
                                        value="Precent">Precent (%)</option>

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Amount / Precent <span style="color:red;">*</span></label>
                                <input type="text" class="form-control"
                                    value="{{ old('precent_amount', $getRecord->precent_amount) }}"
                                    name="precent_amount" placeholder="Enter Precent Amount">
                                <div style="color:red">{{ $errors->first('precent_amount') }}</div>
                            </div>
                            <div class="form-group">
                                <label>Expare Date <span style="color:red;">*</span></label>
                                <input type="date" class="form-control"
                                    value="{{ old('expare_date', $getRecord->expare_date) }}" name="expare_date">
                                <div style="color:red">{{ $errors->first('expare_date') }}</div>
                            </div>
                            <div class="form-group">
                                <label>Status <span style="color:red;">*</span></label>
                                <select class="form-control" name="status">
                                    <option {{ old('status', $getRecord->status) == 0 ? 'selected' : '' }}
                                        value="0">Active</option>
                                    <option {{ old('status', $getRecord->status) == 1 ? 'selected' : '' }}
                                        value="1">Inactive</option>

                                </select>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')

@endsection