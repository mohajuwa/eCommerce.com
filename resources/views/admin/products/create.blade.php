@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Add Products
                    <a href="{{ url('admin/products/') }}" class="btn btn-primary btn-sm float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">

                @if ($errors->any())
                <div class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                    @endforeach
                </div>
                @endif
                <form action="{{ url('admin/products') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                                aria-selected="true">Home</button>

                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link " id="seotag-tab" data-bs-toggle="tab"
                                data-bs-target="#seotag-tab-pane" type="button" role="tab"
                                aria-controls="seotag-tab-pane" aria-selected="true">SEO-Tags</button>

                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link " id="details-tab" data-bs-toggle="tab"
                                data-bs-target="#details-tab-pane" type="button" role="tab"
                                aria-controls="details-tab-pane" aria-selected="true">Details</button>

                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link " id="image-tab" data-bs-toggle="tab"
                                data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane"
                                aria-selected="true">Product Image</button>

                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link " id="color-tab" data-bs-toggle="tab"
                                data-bs-target="#color-tab-pane" type="button" role="tab" aria-controls="color-tab-pane"
                                aria-selected="true">Product Colors</button>

                        </li>

                    </ul>
                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                            aria-labelledby="home-tab">
                            <div class="mb-3">
                                <label>Category</label>
                                <select name="category_id" class=" form-control">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="">Product Name</label>
                                <input type="text" name="name" class=" form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Product Slug</label>
                                <input type="text" name="slug" class=" form-control">
                            </div>
                            <div class="mb-3">
                                <label>Select Brand</label>
                                <select name="brand" class=" form-control">
                                    @foreach ($brands as $brand)
                                    <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="">Small Description (500 Words)</label>
                                <textarea type="text" name="small_description" class=" form-control"
                                    rows="4"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="">Description</label>
                                <textarea type="text" name="description" class=" form-control" rows="4"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="">Meta Title</label>
                                <input type="text" name="meta_title" class=" form-control">
                            </div>

                            <div class="mb-3">
                                <label for="">Meta Description</label>
                                <textarea type="text" name="meta_descrition" class=" form-control" rows="4"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="">Meta Keyword</label>
                                <textarea type="text" name="meta_keyword" class=" form-control" rows="4"></textarea>
                            </div>
                        </div>



                        <div class="tab-pane fade" id="seotag-tab-pane" role="tabpanel" aria-labelledby="seo-tab"
                            tabindex="0">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="">Meta Title</label>
                                            <input type="text" name="meta_title" class=" form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Meta Description</label>
                                            <textarea type="text" name="meta_description" class=" form-control"
                                                rows="4"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="">Meta Keyword</label>
                                            <textarea type="text" name="meta_keyword" class=" form-control"
                                                rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab"
                            tabindex="0">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="">Origingal Price</label>
                                        <input type="text" name="origingal_price" class=" form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="">Selling Price</label>
                                        <input type="text" name="selling_price" class=" form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="">Quantity</label>
                                        <input type="number" name="quantity" class=" form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="">Trending</label>
                                        <input type="checkbox" name="trending" style="width: 20px;height:20px">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="">Status</label>
                                        <input type="checkbox" name="status" style="width: 20px;height:20px">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab"
                            tabindex="0">
                            <div class="mb-3">
                                <label for="">Upload Product Images</label>
                                <input type="file" name="image[]" multiple class=" form-control">
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3" id="color-tab-pane" role="tabpanel"
                            aria-labelledby="color-tab" tabindex="0">
                            <div class="mb-3">
                                <label for="">Select Color</label>
                                <br />
                                <div class="row">
                                    @forelse ($colors as $coloritem)
                                    <div class="col-md-3">
                                        <div class="p-2 border mb-3">

                                            Color: <input type="checkbox" name="colors[{{$coloritem->id}}]"
                                                value="{{$coloritem->id}}">{{$coloritem->name}}

                                            <br />
                                            Quantity: <input type="number" name="colorquantity[{{$coloritem->id}}]"
                                                style="width: 70px;height:23px ; border:1px soild">
                                        </div>


                                    </div>

                                    @empty
                                    <div class="col-md-12">
                                        <h1>No Color Found</h1>
                                    </div>
                                    @endforelse
                                </div>
                            </div>

                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>
</div>
</div>
@endsection