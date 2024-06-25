@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fuild">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Product </h1>
            </div>

        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        @include('admin.layouts._message')

        <div class="row">

            <div class="col-12">
                <div class="card   card-info">
                    <div class="card-header">
                        <h3 class="card-title">Edit Product </h3>
                        <div class="float-end" style="text-align: right;">
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary">
                                Back
                                <i class="nav-icon fas fa-arrow-right"></i>
                            </a>
                        </div>

                    </div>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control"
                                            value="{{ old('title', $product->title) }}" name="title"
                                            placeholder="Enter Title">
                                        <div style="color:red">{{ $errors->first('title') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Slug <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control"
                                            value="{{ old('slug', $product->slug) }}" name="slug"
                                            placeholder="Enter Slug">
                                        <div style="color:red">{{ $errors->first('slug') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>SKU <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('sku', $product->sku) }}"
                                            name="sku" placeholder="Enter SKU">
                                        <div style="color:red">{{ $errors->first('sku') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Category <span style="color:red;">*</span></label>
                                        <select class="form-control" id="ChangeCategory" name="category_id">
                                            <option value="">Select Category</option>
                                            @foreach ($getCategory as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $product->
                                                category_id) == $category->id ? 'selected' : '' }}>
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
                                            @foreach ($getSubCategory as $subCatItem)
                                            <option value="{{ $subCatItem->id }}" {{ old('sub_category_id', $product->
                                                sub_category_id) == $subCatItem->id ? 'selected' : '' }}>
                                                {{ $subCatItem->name }}
                                            </option>
                                            @endforeach

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
                                            <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) ==
                                                $brand->id ? 'selected' : '' }}>
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
                                            <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : ''
                                                }}>
                                                Active
                                            </option>
                                            <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : ''
                                                }}>
                                                Inactive
                                            </option>
                                        </select>
                                        <div style="color:red">{{ $errors->first('status') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label style="display: block">Trendy Product<span
                                                style="color:red;"></span></label>
                                        <input type="checkbox" {{!empty($product->is_trendy)? 'checked':''}}
                                        name="is_trendy">
                                        <div style="color:red">{{ $errors->first('is_trendy') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Color <span style="color: red">*</span></label>
                                    <div class="row">
                                        @foreach ($getColor as $colorItem)
                                        @php
                                        $checked = '';
                                        @endphp
                                        @foreach ($product->getColor as $pColor)
                                        @if ($pColor->color_id == $colorItem->id)
                                        @php
                                        $checked = 'checked';
                                        @endphp
                                        @endif
                                        @endforeach
                                        <div class="col-md-8">
                                            <!-- Adjust col-md-* as per your preference -->
                                            <input type="checkbox" {{ $checked }} name="color_id[]"
                                                value="{{ $colorItem->id }}" {{ is_array(old('color_id')) &&
                                                in_array($colorItem->id, old('color_id')) ? 'checked' : '' }}>
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
                                    <input type="number" class="form-control"
                                        value="{{ !empty(old('price')) ? old('price') : ($product->price > 0 ? $product->price : '') }}"
                                        name="price" placeholder="Enter Price">
                                    <div style="color:red;">{{ $errors->first('price') }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Old Price ($)<span style="color:red;">*</span> </label>
                                    <input type="number" class="form-control"
                                        value="{{ !empty(old('old_price')) ? old('old_price') : ($product->old_price > 0 ? $product->old_price : '') }}"
                                        name="old_price" placeholder="Enter Old Price">
                                    <div style="color:red;">{{ $errors->first('old_price') }}</div>
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
                                            <tbody id="AppendSize">
                                                @php
                                                $i_s = 1;
                                                @endphp
                                                @foreach ($product->getSize as $pSize)
                                                <tr id="deleteSize{{ $i_s }}">
                                                    <td><input type="text" value="{{ $pSize['name'] }}"
                                                            name="size[{{ $i_s }}][name]" placeholder="Name"
                                                            class="form-control"></td>
                                                    <td><input type="text" value="{{ $pSize['price'] }}"
                                                            name="size[{{ $i_s }}][price]" placeholder="Price"
                                                            class="form-control"></td>
                                                    <td> <button type="button" id="{{ $i_s }}"
                                                            class="btn btn-danger deleteSize "> <i
                                                                class="nav-icon fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                @php
                                                $i_s++;
                                                @endphp
                                                @endforeach

                                                <tr>
                                                    <td><input type="text" value="{{ old('size[naem]') }}"
                                                            name="size[100][name]" placeholder="Name"
                                                            class="form-control"></td>
                                                    <td><input type="text" name="size[100][price]" placeholder="Price"
                                                            class="form-control"></td>
                                                    <td style="width: 200px">
                                                        <button type="button" name=""
                                                            class="btn btn-primary addSize ">Add</button>

                                                    </td>
                                                </tr>
                                                {{-- <tr>
                                                    <td><input type="text" name="" class="form-control"></td>
                                                    <td><input type="text" name="" class="form-control"></td>
                                                    <td>

                                                        <button type="button" name="" class="btn btn-danger "> <i
                                                                class="nav-icon fas fa-trash"></i></button>
                                                    </td>
                                                </tr> --}}
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Images <span style="color:red;">*</span></label>
                                    <input type="file" name="image[]" class="form-control" multiple accept="image/*"
                                        style="padding: 5px;">
                                    <div style="color:red">{{ $errors->first('short_description') }}</div>
                                </div>
                            </div>
                        </div>
                        @if (!empty($product->getImage->count()))
                        <div class="row" id="sortable">
                            @foreach ($product->getImage as $image)
                            @if (!empty($image->getImage()))
                            <div class="col-md-1 sortable_image" id="{{ $image->id }}" style="text-align:center;">

                                <img src="{{ $image->getImage() }}" class=" img-fluid" alt=""
                                    style="width: 150px;max-height:150px;">
                                <a onclick="return confirm ('Are sure ..! ,You want to delete ?');"
                                    href="{{ url('admin/product/image_delete/' . $image->id) }}"
                                    style="margin-top: 20px" class="btn btn-danger btn-sm  "> <i
                                        class="nav-icon fas fa-trash"></i>
                                </a>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        @endif
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Short Description <span style="color:red;">*</span></label>
                                    <textarea class="form-control " name="short_description" rows="3"
                                        placeholder="Enter Short Description">{{ old('short_description', $product->short_description) }}</textarea>
                                    <div style="color:red">{{ $errors->first('short_description') }}</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description <span style="color:red;">*</span></label>
                                    <textarea class="form-control editor" name="description" rows="5"
                                        placeholder="Enter Description ">{{ old('description', $product->description) }}</textarea>
                                    <div style="color:red">{{ $errors->first('description') }}</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Additional Information <span style="color:red;">*</span></label>
                                    <textarea class="form-control editor" name="addetional_information" rows="3"
                                        placeholder="Enter Additional Information">{{ old('addetional_information', $product->addetional_information) }}</textarea>
                                    <div style="color:red">{{ $errors->first('addetional_information') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label>Shopping Returns <span style="color:red;">*</span></label>
                                    <textarea class="form-control editor" name="shopping_returns" rows="3"
                                        placeholder="Enter Shopping Returns">{{ old('shopping_returns', $product->shopping_returns) }}</textarea>
                                    <div style="color:red">{{ $errors->first('shopping_returns') }}</div>
                                </div>
                            </div>
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
<script src="https://cdn.tiny.cloud/1/q1saq3k78cjzjqltytcty86k9feclpb3de8zgdxqa87ewcg7/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>


<script src="{{ url('public/tinymce/tinymce-jquery.min.js') }}"></script>
<script src="{{ url('public/sortable/jquery-ui.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
            $("#sortable").sortable({
                update: function(event, ui) {
                    var photo_id = new Array();
                    $('.sortable_image').each(function() {
                        var id = $(this).attr('id');
                        photo_id.push(id);
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('admin/product_image_sortable') }}",
                        data: {
                            "photo_id": photo_id,
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {},
                        error: function(data) {
                            // Handle errors if necessary
                        }
                    });
                }
            });

        });
       



       

        $(document).ready(function() {
            $('body').delegate('#ChangeCategory', 'change', function(e) {
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
            var i = 101;
            $('body').delegate('.addSize', 'click', function(e) {
                var html =
                    '<tr id="deleteSize' + i +
                    '">\n\
                                                                                                                                                                                                                                                                                                        <td><input type="text" name="size[' +
                    i +
                    '][name]"  placeholder="Name" class="form-control"></td>\n\
                                                                                                                                                                                                                                                                                                         <td><input type="text" name="size[' +
                    i +
                    '][price]" placeholder="Price" class="form-control"></td> \n\
                                                                                                                                                                                                                                                                                                         <td> <button type="button" id="' +
                    i +
                    '"  class="btn btn-danger deleteSize "> \n\
                                              <i class = "nav-icon fas fa-trash" > < /i></button > < /td>\n\ < /tr > ';
                i++;
                $('#AppendSize').append(html);
            });

            $('body').delegate('.deleteSize', 'click', function(e) {
                var id = $(this).attr('id');
                $('#deleteSize' + id).remove();
            });
        });
</script>
@endsection