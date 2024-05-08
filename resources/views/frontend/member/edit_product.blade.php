@extends('layouts.app')

@section('content')
@include('layouts.inc.frontend.header')
<div class="col-md-12">
    @if (session('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>
    @endif
    <div class="container">
        @if ($errors->any())
        <div class="alert alert-warning">
            @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
            @endforeach
        </div>
        @endif

        <form action="{{ url('member/products/update/'.$product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    @include('frontend.member.sidebar')
                </div>

                <div class="col-md-6">
                    <div class="card mb-5">
                        <div class="card-header bg-white d-flex justify-content-between align-items-start">
                            <h6 class="my-auto">Edit Products</h6>
                            <a href="{{ url('member/products/update/' .$product->id) }}"
                                class="btn btn-success text-white">Add
                                Product</a>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6">
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


                                <div class="col-md-6">
                                    <label class="form-label">Type</label>
                                    <select id="state-dropdown" class="form-select" name="type_id">
                                    </select>

                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" value="{{$product->name}}"
                                        class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Short Description</label>
                                    <textarea name="short_description" id="summernote2"
                                        class="form-control @error('short_description') is-invalid @enderror">{{$product->short_description}}</textarea>
                                    @error('short_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" id="summernote"
                                        class="form-control @error('description') is-invalid @enderror">{{$product->description}}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <h3 class="my-3 pt-3 border-top">Meta Tag Seo</h3>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">meta Title</label>
                                    <input type="text" name="meta_title"
                                        class="form-control @error('meta_title') is-invalid @enderror"
                                        value="{{$product->meta_title}}">
                                    @error('meta_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">meta description </label>
                                    <textarea name="meta_description"
                                        class="form-control @error('meta_description') is-invalid @enderror">{{$product->meta_description}}</textarea>
                                    @error('meta_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">meta keyword</label>
                                    <textarea name="meta_keyword"
                                        class="form-control @error('meta_keyword') is-invalid @enderror">{{$product->meta_keyword}}</textarea>
                                    @error('meta_keyword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <h3 class="my-3 pt-3 border-top">Detail</h3>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Price</label>
                                    <input type="text" name="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{$product->price}}">
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Url Demo</label>
                                    <input type="text" name="url_demo"
                                        class="form-control @error('url_demo') is-invalid @enderror"
                                        value="{{$product->link_demo}}">
                                    @error('url_demo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-header bg-white">
                            Upload File Product
                        </div>
                        <div class="card-body">
                            <input type="file" name="file_download" class="form-control">
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header bg-white">
                            Image Cover
                        </div>
                        <div class="card-body">
                            <label class="form-label"></label>
                            <img src="{{asset($product->image_cover)}}">
                            <div id="imagePreview" src="https://webdevtrick.com/wp-content/uploads/preview-img.jpg"
                                class="border" alt="placeholder image goes here">
                            </div>
                            <input id="uploadFile" type="file" name="image_cover" class="form-control">

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-white">
                            Image Preview
                        </div>
                        <div class="card-body">

                            <div class="col-md-12">
                                <input type="file" onchange="preview()" id="file-input" multiple name="image[]"
                                    class="form-control">

                                <p id="num-of-files"></p>
                                <div id="images" class="text-center text-muted my-5">
                                    <div class="display-1"> @if($product->productImages)
                                        @foreach($product->productImages as $image)
                                        <div class="col-md-12">
                                            <div class="card border p-2">
                                                <img class="img-fluid" src="{{asset($image->image)}}">
                                                <a href="{{url('admin/product-image/delete/' .$image->id)}}"
                                                    class="btn btn-danger btn-sm mt-2 text-white">Remove</a>
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        <h3>No Images added </h3>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="mt-5">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-success">Publish</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')

{{-- Mutiple File Input --}}
<script src="{{asset('assets/js/multipleinput.js')}}"></script>
<script>
    // Upload File

$(function() {
    $("#uploadFile").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function(){ // set image data as background of div
                $("#imagePreview").css("background-image", "url("+this.result+")");
            }
        }
    });
});

$('#imagePreview').click(function(){
  $('#uploadFile').click();
});

// End Upload File

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
                url: "{{url('member/category/fetch-types')}}",
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

    });

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
       
</script>

@endsection