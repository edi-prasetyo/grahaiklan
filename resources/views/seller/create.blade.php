@extends('layouts.app')
@section('content')
    @include('layouts.inc.frontend.header')

    <div class="container">


        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-start">
                    <h4 class="my-auto">Add Product</h4>
                    <a href="{{ url('seller/vehicle') }}" class="btn btn-success text-white"><i
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
                    <form action="{{ url('seller/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tipe kendaraan.</label>
                                <select name="category_id" id="country-dropdown"
                                    class="form-select form-select mb-3 @error('category_id') is-invalid @enderror">
                                    <option value="">--Pilih Kendaraan--</option>
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


                            <div class="col-md-4 mb-3">
                                <label class="form-label">Merek</label>
                                <select id="state-dropdown" class="form-select" name="brand_id">
                                </select>

                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Type</label>
                                <select id="city-dropdown" class="form-select" name="type_id">
                                </select>

                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Judul Iklan</label>
                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tahun Kendaraan</label>
                                <input type="text" name="year"
                                    class="form-control @error('year') is-invalid @enderror">
                                @error('year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Kapasitas Mesin</label>
                                <input type="text" name="engine_capacity"
                                    class="form-control @error('engine_capacity') is-invalid @enderror">
                                @error('engine_capacity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Odometer</label>
                                <input type="text" name="odometer"
                                    class="form-control @error('odometer') is-invalid @enderror">
                                @error('odometer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Warna</label>
                                <input type="text" name="color"
                                    class="form-control @error('color') is-invalid @enderror">
                                @error('color')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Jumlah Seat</label>
                                <input type="text" name="seat"
                                    class="form-control @error('seat') is-invalid @enderror">
                                @error('seat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Jenis</label>
                                <select class="form-select @error('variant_id') is-invalid @enderror" name="variant_id"
                                    aria-label="Default select example">
                                    <option value="">--Pilih Jenis Mobil--</option>
                                    @foreach ($variants as $variant)
                                        <option value="{{ $variant->name }}">{{ $variant->name }}</option>
                                    @endforeach
                                </select>
                                @error('condition')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Kondisi</label>
                                <select class="form-select @error('condition') is-invalid @enderror" name="condition"
                                    aria-label="Default select example">
                                    <option value="">--Pilih Kondsi--</option>
                                    <option value="new">Bekas</option>
                                    <option value="second">Baru</option>
                                </select>
                                @error('condition')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                            <div class="col-md-4 mb-3">
                                <label class="form-label">Transmisi</label>
                                <select class="form-select @error('transmision') is-invalid @enderror" name="transmision"
                                    aria-label="Default select example">
                                    <option value="">--Pilih Transmisi--</option>
                                    <option value="matic">Matic</option>
                                    <option value="manual">Manual</option>
                                </select>
                                @error('condition')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Bahan Bakar</label>
                                <select class="form-select @error('fuel') is-invalid @enderror" name="fuel"
                                    aria-label="Default select example">
                                    <option value="">--Pilih Bahan Bakar--</option>
                                    <option value="bensin">Bensin</option>
                                    <option value="diesel">Diesel</option>
                                </select>
                                @error('fuel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Plat Nomor</label>
                                <select class="form-select @error('plat_number') is-invalid @enderror" name="plat_number"
                                    aria-label="Default select example">
                                    <option value="">--Pilih Plat--</option>
                                    <option value="ganjil">Ganjil</option>
                                    <option value="genap">Genap</option>
                                </select>
                                @error('plat_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">STNK</label>
                                <select class="form-select @error('stnk') is-invalid @enderror" name="stnk"
                                    aria-label="Default select example">
                                    <option value="">--STNK--</option>
                                    <option value="1">Ada</option>
                                    <option value="0">Tidak Ada</option>
                                </select>
                                @error('stnk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">BPKB</label>
                                <select class="form-select @error('bpkb') is-invalid @enderror" name="bpkb"
                                    aria-label="Default select example">
                                    <option value="">--BPKB--</option>
                                    <option value="1">Ada</option>
                                    <option value="0">Tidak Ada</option>
                                </select>
                                @error('bpkb')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">FAKTUR</label>
                                <select class="form-select @error('faktur') is-invalid @enderror" name="faktur"
                                    aria-label="Default select example">
                                    <option value="">--Faktur--</option>
                                    <option value="1">Ada</option>
                                    <option value="0">Tidak Ada</option>
                                </select>
                                @error('faktur')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Grade Mesin</label>
                                <select class="form-select @error('grade_engine') is-invalid @enderror"
                                    name="grade_engine" aria-label="Default select example">
                                    <option value="">--Mesin--</option>
                                    <option value="a">A</option>
                                    <option value="b">B</option>
                                    <option value="c">C</option>
                                </select>
                                @error('grade_engine')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Grade Exterior</label>
                                <select class="form-select @error('grade_exterior') is-invalid @enderror"
                                    name="grade_exterior" aria-label="Default select example">
                                    <option value="">--Exterior--</option>
                                    <option value="a">A</option>
                                    <option value="b">B</option>
                                    <option value="c">C</option>
                                </select>
                                @error('grade_exterior')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Grade Interior</label>
                                <select class="form-select @error('grade_interior') is-invalid @enderror"
                                    name="grade_interior" aria-label="Default select example">
                                    <option value="">--Interior--</option>
                                    <option value="a">A</option>
                                    <option value="b">B</option>
                                    <option value="c">C</option>
                                </select>
                                @error('grade_interior')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                            <div class="col-md-12 mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" id="summernote" class="form-control @error('description') is-invalid @enderror"></textarea>
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
                                    class="form-control @error('meta_title') is-invalid @enderror">
                                @error('meta_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">meta description </label>
                                <textarea name="meta_description" class="form-control @error('meta_description') is-invalid @enderror"></textarea>
                                @error('meta_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">meta keyword</label>
                                <textarea name="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror"></textarea>
                                @error('meta_keywords')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <h3 class="my-3 pt-3 border-top">Detail</h3>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Price</label>
                                <input type="text" name="price"
                                    class="form-control @error('price') is-invalid @enderror">
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <label class="form-check-label">Status</label>
                                        <input class="form-check-input" type="checkbox" name="status" checked>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Gambar Utama</label>
                                <input type="file" name="image_cover" class="form-control">
                            </div>
                            <h3 class="my-3 pt-3 border-top">Gambar</h3>
                            <div class="col-md-4">
                                <label class="form-label">Product Image</label>
                                <input type="file" name="image[]" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Product Image</label>
                                <input type="file" name="image[]" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Product Image</label>
                                <input type="file" name="image[]" class="form-control">
                            </div>

                            <div class="mt-5">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            /*------------------------------------------
            --------------------------------------------
            Country Dropdown Change Event
            --------------------------------------------
            --------------------------------------------*/
            $('#country-dropdown').on('change', function() {
                var idCategory = this.value;
                $("#state-dropdown").html('');
                $.ajax({
                    url: "{{ url('seller/vehicle/fetch-brands') }}",
                    type: "POST",
                    data: {
                        category_id: idCategory,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#state-dropdown').html(
                            '<option value="">-- Select Brand --</option>');
                        $.each(result.brands, function(key, value) {
                            $("#state-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#city-dropdown').html(
                            '<option value="">-- Select Model --</option>');
                    }
                });
            });

            /*------------------------------------------
            --------------------------------------------
            State Dropdown Change Event
            --------------------------------------------
            --------------------------------------------*/
            $('#state-dropdown').on('change', function() {
                var idBrand = this.value;
                $("#city-dropdown").html('');
                $.ajax({
                    url: "{{ url('seller/vehicle/fetch-types') }}",
                    type: "POST",
                    data: {
                        brand_id: idBrand,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#city-dropdown').html(
                            '<option value="">-- Select Model --</option>');
                        $.each(res.types, function(key, value) {
                            $("#city-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });




        });

        $('#summernote').summernote({
            tabsize: 2,
            height: 230,

            tooltip: false
        });

        $('#summernote2').summernote({
            tabsize: 2,
            height: 130,

            tooltip: false
        });
    </script>
@endsection
