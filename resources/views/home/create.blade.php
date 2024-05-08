@extends('layouts.app')
@section('content')
    @include('layouts.inc.frontend.header')
    <div class="container my-3 mb-5">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('activated'))
                <div class="alert alert-success" role="alert">
                    {{ session('activated') }}
                </div>
            @endif
            <!-- /User Card -->
            <div class="col-md-8 mx-auto">
                @if ($errors->any())
                    <div class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <div class="card shadow-sm">
                    <div class="card-header">
                        Buat Iklan Baru
                    </div>
                    <div class="card-body">
                        <form action="{{ url('member-store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <div class="col-md-6 ">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Kategori Iklan</label>
                                        <select
                                            class="form-select single-select-field @error('category_id') is-invalid @enderror"
                                            id="category-dropdown" name="category_id">
                                            <option value="">--Pilih Kategori--</option>
                                            @foreach ($categories as $key => $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Subcategory</label>
                                        <select id="subcategory-dropdown"
                                            class="form-select single-select-field @error('subcategory_id') is-invalid @enderror"
                                            name="subcategory_id">
                                        </select>
                                        @error('subcategory_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Judul Iklan</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            name="title" value="{{ old('title') }}">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-12 my-5">

                                    <div class="row">

                                        <div class="col-md-3 col-6 mb-3">

                                            <div id="imagePreview"
                                                class="d-flex flex-column min-vh-50 justify-content-center align-items-center p-4">
                                                <p class="text-muted">COVER</p>
                                                <i class="ti ti-photo-plus fs-1 mx-auto"></i>
                                            </div>
                                            <input id="uploadFile" type="file" name="image_cover" class="img">

                                        </div>

                                        <div class="col-md-3 col-6 mb-3">

                                            <div id="imagePreview2"
                                                class="d-flex flex-column min-vh-50 justify-content-center align-items-center">
                                                <p class="text-muted">PHOTO 1</p>
                                                <i class="ti ti-photo-plus fs-1 mx-auto"></i>
                                            </div>
                                            <input id="uploadFile2" type="file" name="image[]" class="img">

                                        </div>

                                        <div class="col-md-3 col-6 mb-3">

                                            <div id="imagePreview3"
                                                class="d-flex flex-column min-vh-50 justify-content-center align-items-center">
                                                <p class="text-muted">PHOTO 2</p>
                                                <i class="ti ti-photo-plus fs-1 mx-auto"></i>
                                            </div>
                                            <input id="uploadFile3" type="file" name="image[]" class="img">

                                        </div>

                                        <div class="col-md-3 col-6 mb-3">

                                            <div id="imagePreview3"
                                                class="d-flex flex-column min-vh-50 justify-content-center align-items-center">
                                                <p class="text-muted">PHOTO 3</p>
                                                <i class="ti ti-photo-plus fs-1 mx-auto"></i>
                                            </div>
                                            <input id="uploadFile3" type="file" name="image[]" class="img">

                                        </div>

                                    </div>


                                    {{-- <div class="post-image post-image-placeholder mrm mts empty">
                                        <div class="upload-section">
                                            <input type="file" id="Photofile1" class="upload-img" name="image_cover"
                                                required>
                                            <label class="icon-camera" for="Photofile1">
                                                <i class="ti ti-camera"></i>
                                            </label>
                                            <p class="uppercase">Thumbnail</p>
                                        </div>
                                        <div class="preview-section"></div>
                                    </div> --}}
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Deskripsi Iklan</label>
                                        <textarea id="summernote" class="form-control @error('description') is-invalid @enderror" name="description"
                                            value="{{ old('description') }}" style="white-space: pre-wrap">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Sub Judul</label>
                                        <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                            name="meta_title" value="{{ old('meta_title') }}">
                                        @error('meta_title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Sub Deskripsi</label>
                                        <input type="text"
                                            class="form-control @error('meta_description') is-invalid @enderror"
                                            name="meta_description" value="{{ old('meta_description') }}">
                                        @error('meta_description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <hr>

                                <div class="col-md-6">

                                    <input type="hidden" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ $user->name }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="col-md-6">

                                    <input type="hidden" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ $user->email }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="col-md-12">

                                    <input type="hidden" class="form-control @error('phone') is-invalid @enderror"
                                        name="phone" value="{{ $user->phone }}">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">

                                        <label class="form-label">Website Text <span class="text-success"> * Optional
                                            </span></label>

                                        <input type="text" class="form-control @error('website') is-invalid @enderror"
                                            name="website" value="{{ old('website') }}">
                                        @error('website')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Target url <span class="text-success"> * Optional
                                        </span></label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="ti ti-link"></i></span>
                                        <input type="text" name="url"
                                            class="form-control @error('url') is-invalid @enderror"
                                            placeholder="https://.." aria-label="Username"
                                            aria-describedby="basic-addon1">
                                        @error('url')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="col-md-6 ">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Pilih Provinsi</label>
                                        <select
                                            class="form-select single-select-field @error('province_id') is-invalid @enderror"
                                            id="country-dropdown" data-placeholder="Pilih Provinsi" name="province_id">
                                            <option value=""></option>
                                            @foreach ($provinces as $key => $province)
                                                <option value="{{ $province->id }}"
                                                    {{ old('province_id') == $province->id ? 'selected' : '' }}>
                                                    {{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('province_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Kota</label>
                                        <select id="state-dropdown"
                                            class="form-select single-select-field @error('city_id') is-invalid @enderror"
                                            name="city_id">
                                        </select>
                                        @error('city_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Alamat Bisnis/Toko</label>
                                        <textarea name="address" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <hr>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Keywords ( Pisahkan dengan koma)</label>
                                        <input type="text"
                                            class="form-control @error('meta_keywords') is-invalid @enderror"
                                            name="meta_keywords" value="{{ old('meta_keywords') }}">
                                        @error('meta_keywords')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Gambar</label>
                                        <input type="file" name="image_cover">
                                    </div>
                                </div> --}}

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Posting Iklan</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        Tips
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Nomor Handphone hanya di gunakan untuk 1 kali pemasangan Iklan</li>
                            <li>Daftar jadi member untuk memasang lebih banyak iklan</li>
                            <li>Dapatkan Badge Verified dengan membeli Iklan Premium dan Iklan akan tayang paling atas</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Dependence Dropdown for Applicant
        $('#country-dropdown').on('change', function() {
            var idProvince = this.value;
            $("#state-dropdown").html('');
            $.ajax({
                url: "{{ url('/fetch-city') }}",
                type: "POST",
                data: {
                    province_id: idProvince,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#state-dropdown').html('<option value="">-- Pilih Kota --</option>');
                    $.each(result.cities, function(key, value) {
                        $("#state-dropdown").append('<option value="' + value.id + '">' + value
                            .name + '</option>');
                    });
                }
            });
        });


        // Category Dependence Dropdown for Applicans
        $('#category-dropdown').on('change', function() {
            var idCategory = this.value;
            $("#subcategory-dropdown").html('');
            $.ajax({
                url: "{{ url('/fetch-subcategory') }}",
                type: "POST",
                data: {
                    category_id: idCategory,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#subcategory-dropdown').html(
                        '<option value="">-- Pilih Subcategori --</option>');
                    $.each(result.subcategory, function(key, value) {
                        $("#subcategory-dropdown").append('<option value="' + value.id + '">' +
                            value
                            .name + '</option>');
                    });
                }
            });
        });


        // Select2
        $('.single-select-field').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });

        // Datepicker
        $(function() {
            $('#datepicker').datepicker({
                format: 'yyyy-dd-mm',
            });
        });
        //summernote
        $("#summernote").summernote({
            height: 300,
            tooltip: false,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ol', 'ul', 'paragraph']],
                ['table', ['table']],


            ]
        });
        // $("#summernote2").summernote({
        //     height: 300,
        //     tooltip: false,
        //     toolbar: [
        //         ['style', ['style']],
        //         ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
        //         ['fontname', ['fontname']],
        //         ['fontsize', ['fontsize']],
        //         ['color', ['color']],
        //         ['para', ['ol', 'ul', 'paragraph', 'height']],
        //         ['table', ['table']],
        //         ['insert', ['link']],
        //         ['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
        //     ]
        // });

        // Image Preview
        $(function() {
            var count = 0;
            $('.upload-img').on('change', function(evt) {
                var file = evt.target.files[0];
                var _this = evt.target;
                $(this).parent('.upload-section').hide();
                var reader = new FileReader();
                reader.onload = function(e) {
                    var span = '<img class="thumb mrm mts" src="' + e.target.result + '" title="' +
                        escape(file.name) +
                        '"/><span class="remove_img_preview"><i class="ti ti-trash text-white"></i></span>';
                    $(_this).parent('.upload-section').next().append($(span));
                };
                reader.readAsDataURL(file);
                evt.target.value = "image_cover";
            });

            $('.preview-section').on('click', '.remove_img_preview', function() {
                $(this).parent('.preview-section').prev().show();
                $(this).parent('.preview-section').remove();
            });
        });


        // Image Preview 2

        $(function() {
            $("#uploadFile").on("change", function() {
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader)
                    return; // no file selected, or no FileReader support

                if (/^image/.test(files[0].type)) { // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function() { // set image data as background of div
                        $("#imagePreview").css("background-image", "url(" + this.result + ")");
                    }
                }
            });
        });

        $('#imagePreview').click(function() {
            $('#uploadFile').click();
        });

        $(function() {
            $("#uploadFile2").on("change", function() {
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader)
                    return; // no file selected, or no FileReader support

                if (/^image/.test(files[0].type)) { // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function() { // set image data as background of div
                        $("#imagePreview2").css("background-image", "url(" + this.result + ")");
                    }
                }
            });
        });

        $('#imagePreview2').click(function() {
            $('#uploadFile2').click();
        });

        $(function() {
            $("#uploadFile3").on("change", function() {
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader)
                    return; // no file selected, or no FileReader support

                if (/^image/.test(files[0].type)) { // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function() { // set image data as background of div
                        $("#imagePreview3").css("background-image", "url(" + this.result + ")");
                    }
                }
            });
        });

        $('#imagePreview3').click(function() {
            $('#uploadFile3').click();
        });

        $(function() {
            $("#uploadFile4").on("change", function() {
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader)
                    return; // no file selected, or no FileReader support

                if (/^image/.test(files[0].type)) { // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function() { // set image data as background of div
                        $("#imagePreview4").css("background-image", "url(" + this.result + ")");
                    }
                }
            });
        });

        $('#imagePreview4').click(function() {
            $('#uploadFile4').click();
        });
    </script>
@endsection
