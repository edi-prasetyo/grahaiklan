@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    @if(session('message'))
    <div class="alert alert-danger">{{session('message')}}</div>
    @endif
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-start">
            <h4 class="my-auto">Edit Product</h4>
            <a href="{{ url('admin/products') }}" class="btn btn-success text-white"><i
                    class="fa-solid fa-arrow-left"></i>
                Back</a>
        </div>
        <div class="card-body">

            @if ($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif

            <form action="{{ url('admin/products/' .$product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Category</label>
                        <select name="category_id" id="country-dropdown"
                            class="form-select form-select mb-3 @error('category_id') is-invalid @enderror">
                            <option value="">--Select Category--</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <div class="col-md-4">
                        <label class="form-label">Type</label>
                        <select id="state-dropdown" class="form-select" name="type_id">
                        </select>

                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" value="{{$product->name}}" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Short Description</label>
                        <textarea name="short_description" id="summernote2"
                            class="form-control">{{$product->short_description}}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control"
                            id="summernote">{{$product->description}}</textarea>
                    </div>
                    <h3 class="my-3 pt-3 border-top">Meta Tag Seo</h3>
                    <div class="col-md-6">
                        <label class="form-label">meta Title</label>
                        <textarea name="meta_title" class="form-control">{{$product->meta_title}}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">meta description </label>
                        <textarea name="meta_description" class="form-control">{{$product->meta_description}}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">meta keyword</label>
                        <textarea name="meta_keyword" class="form-control">{{$product->meta_keyword}}</textarea>
                    </div>
                    <h3 class="my-3 pt-3 border-top">Detail</h3>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Price</label>
                        <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                            value="{{$product->price}}">
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Single Price</label>
                        <input type="text" name="single_price"
                            class="form-control @error('single_price') is-invalid @enderror"
                            value="{{$product->single_price}}">
                        @error('single_price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Full Price</label>
                        <input type="text" name="full_price"
                            class="form-control @error('full_price') is-invalid @enderror"
                            value="{{$product->full_price}}">
                        @error('full_price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Url Demo</label>
                        <input type="text" name="link_demo"
                            class="form-control @error('link_demo') is-invalid @enderror"
                            value="{{$product->link_demo}}">
                        @error('link_demo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">File Download {{$product->file_download}}</label>
                        <input type="file" name="file_download" class="form-control">
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <label class="form-check-label">Status</label>
                                <input class="form-check-input" type="checkbox" name="status" {{$product->status == '1'
                                ? 'checked':''}}>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <label class="form-check-label">Trending</label>
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="flexSwitchCheckDefault" name="trending" {{$category->trending == '1' ?
                                'checked':''}}>
                            </div>
                        </div>
                    </div>
                    <h3 class="my-3 pt-3 border-top">Images</h3>
                    <div class="col-md-12">
                        <label class="form-label">Image Preview</label>
                        <input type="file" multiple name="image[]" class="form-control">
                    </div>
                    <div class="row my-3">
                        @if($product->productImages)
                        @foreach($product->productImages as $image)
                        <div class="col-md-2">
                            <div class="card border p-2">
                                <img class="img-fluid" src="{{asset($image->image)}}">
                                <a href="{{url('admin/product-image/delete/' .$image->id)}}"
                                    class="btn btn-danger mt-2 text-white">Remove</a>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <h3>No Images added </h3>
                        @endif
                    </div>


                    <div class="mt-5">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
    $(document).ready(function () {

        /*------------------------------------------
        --------------------------------------------
        Country Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#country-dropdown').on('change', function () {
            var idCategory = this.value;
            $("#state-dropdown").html('');
            $.ajax({
                url: "{{url('admin/category/fetch-types')}}",
                type: "POST",
                data: {
                    category_id: idCategory,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#state-dropdown').html('<option value="">-- Select Type --</option>');
                    $.each(result.types, function (key, value) {
                        $("#state-dropdown").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                    $('#city-dropdown').html('<option value="">-- Select Program --</option>');
                }
            });
        });

        /*------------------------------------------
        --------------------------------------------
        State Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        // $('#state-dropdown').on('change', function () {
        //     var idType = this.value;
        //     $("#city-dropdown").html('');
        //     $.ajax({
        //         url: "{{url('admin/category/fetch-programs')}}",
        //         type: "POST",
        //         data: {
        //             type_id: idType,
        //             _token: '{{csrf_token()}}'
        //         },
        //         dataType: 'json',
        //         success: function (res) {
        //             $('#city-dropdown').html('<option value="">-- Select Program --</option>');
        //             $.each(res.programs, function (key, value) {
        //                 $("#city-dropdown").append('<option value="' + value
        //                     .id + '">' + value.name + '</option>');
        //             });
        //         }
        //     });
        // });

        $('#summernote').summernote({
            tabsize: 2
            , height: 230,

            tooltip: false
        });
       
    $('#summernote2').summernote({
            tabsize: 2
            , height: 130,

            tooltip: false
        });

    });

    
</script>

@endsection