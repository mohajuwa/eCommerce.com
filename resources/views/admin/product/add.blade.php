@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fuild">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add new product </h1>
            </div>

        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Add new product </h3>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('title') }}" name="title"
                                            placeholder="Enter Title">
                                        <div style="color:red">{{ $errors->first('title') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>SKU <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('sku') }}" name="sku"
                                            placeholder="Enter SKU">
                                        <div style="color:red">{{ $errors->first('sku') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Category <span style="color:red;">*</span></label>
                                        <select class="form-control" id="ChangeCategory" name="category_id">
                                            <option value="">Select Category</option>
                                            @foreach ($getCategory as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id')==$category->id ?
                                                'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div style="color:red">{{ $errors->first('category_id') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sub Category <span style="color:red;">*</span></label>
                                        <select class="form-control" id="GetSubCategory" name="sub_category_id">
                                            <option value="">Select Sub Category</option>

                                        </select>
                                        <div style="color:red">{{ $errors->first('sub_category_id') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Brand <span style="color:red;">*</span></label>
                                        <select class="form-control" name="brand_id">
                                            <option value="">Select Brand</option>
                                            @foreach ($getBrand as $brand)
                                            <option value="{{ $brand->id }}" {{ old('brand_id')==$brand->id ? 'selected'
                                                : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div style="color:red">{{ $errors->first('brand_id') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status <span style="color:red;">*</span></label>
                                        <select class="form-control" name="status">
                                            <option value="0" {{ old('status')==0 ? 'selected' : '' }}>Active</option>
                                            <option value="1" {{ old('status')==1 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        <div style="color:red">{{ $errors->first('status') }}</div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="display: block">Trendy Product<span
                                                style="color:red;"></span></label>
                                        <input type="checkbox" name="is_trendy">
                                        <div style="color:red">{{ $errors->first('is_trendy') }}</div>
                                    </div>
                                </div>
                            </div>


                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Color <span style="color: red">*</span></label>
                                        <div class="row">
                                            @foreach ($getColor as $colorItem)
                                            <div class="col-md-8">
                                                <!-- Adjust col-md-* as per your preference -->
                                                <input type="checkbox" name="color_id[]" value="{{ $colorItem->id }}" {{
                                                    is_array(old('color_id')) && in_array($colorItem->id,
                                                old('color_id')) ?
                                                'checked' : '' }}>
                                                <label>{{ $colorItem->name }}</label>

                                            </div>
                                            @endforeach
                                        </div>
                                        @error('color_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>




                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Price ($) <span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" value="{{ old('price') }}"
                                            name="price" placeholder="Enter Price">
                                        <div style="color:red">{{ $errors->first('price') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Old Price ($)<span style="color:red;">*</span> </label>
                                        <input type="number" class="form-control" value="{{ old('old_price') }}"
                                            name="old_price" placeholder="Enter Old Price">
                                        <div style="color:red">{{ $errors->first('old_price') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Size <span style="color: red">*</span> </label>
                                        <div>
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Price</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input type="text" name="" class="form-control"></td>
                                                        <td><input type="text" name="" class="form-control"></td>
                                                        <td>
                                                            <button type="button" name=""
                                                                class="btn btn-primary ">Add</button>
                                                            <button type="button" name="" class="btn btn-danger "> <i
                                                                    class="nav-icon fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" name="" class="form-control"></td>
                                                        <td><input type="text" name="" class="form-control"></td>
                                                        <td>

                                                            <button type="button" name="" class="btn btn-danger "> <i
                                                                    class="nav-icon fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" name="" class="form-control"></td>
                                                        <td><input type="text" name="" class="form-control"></td>
                                                        <td>

                                                            <button type="button" name="" class="btn btn-danger "> <i
                                                                    class="nav-icon fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Short Description <span style="color:red;">*</span></label>
                                        <textarea class="form-control" name="short_description" rows="3"
                                            placeholder="Enter Short Description">{{ old('short_description') }}</textarea>
                                        <div style="color:red">{{ $errors->first('short_description') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description <span style="color:red;">*</span></label>
                                        <textarea class="form-control" name="description" rows="5"
                                            placeholder="Enter Description">{{ old('description') }}</textarea>
                                        <div style="color:red">{{ $errors->first('description') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Additional Information <span style="color:red;">*</span></label>
                                        <textarea class="form-control" name="addetional_information" rows="3"
                                            placeholder="Enter Additional Information">{{ old('addetional_information') }}</textarea>
                                        <div style="color:red">{{ $errors->first('addetional_information') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label>Shopping Returns <span style="color:red;">*</span></label>
                                        <textarea class="form-control" name="shopping_returns" rows="3"
                                            placeholder="Enter Shopping Returns">{{ old('shopping_returns') }}</textarea>
                                        <div style="color:red">{{ $errors->first('shopping_returns') }}</div>
                                    </div>
                                </div>

                                <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="is_delete" value="0">
                            </div>
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Add Product(s)</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() { // Ensure the document is ready before binding the event
    $('#ChangeCategory').change(function(e) { // Use direct binding instead of delegation
        var id = $(this).val();
        $.ajax({
            type: "POST",
            url: "{{ url('admin/get_sub_category') }}",
            data: {
                "id": id,
                "_token": "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(data) {
                $('#GetSubCategory').html(data.html);
            },
            error: function(data) {
                // Handle errors if necessary
            }
        });
    });
});

</script>
@endsection