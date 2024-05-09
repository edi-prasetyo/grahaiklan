@extends('layouts.app')
@section('title', 'Atrans Auto')
@section('content')





    <section class="bg-success">
        <div class="hero-img">
            <div class="container px-4 px-lg-0 ">
                <!-- Hero Section -->
                <div class="row align-items-center">
                    <div class=" col-md-7">
                        <div class=" mb-4 text-center text-xl-start px-md-8 px-lg-19 px-xl-0">
                            <!-- Caption -->
                            <h1 class="display-3 fw-bold mb-3 ls-sm text-white">
                                <span class="text-warning">Cari Pasang Iklan</span> Gratis?
                            </h1>
                            <p class="mb-6 lead pe-lg-6 text-white">
                                Pasang disini Aja Gratis tanpa Daftar
                            </p>

                        </div>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end">
                        <img src="{{ asset('uploads/logo/hero.png') }}" alt="Geeks UI Academy bootstrap 5 Templates"
                            class="img-fluid rounded-3 smooth-shadow-md">


                    </div>
                </div>
            </div>
        </div>
    </section>




    <section>
        <div class="container">





            <div class="form-search">
                <div class="card shadow-sm rounded p-5">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-3">
                                <select class="form-select single-select-field" aria-label="Default select example">
                                    <option value="">Lokasi</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select single-select-field" aria-label="Default select example">
                                    <option value="">Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <input type="text" class="form-control" name="keyword" placeholder="Keyword..">

                            </div>
                            <div class="col-md-2">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-success btn-lg" type="button"><i class="ti ti-search"></i>
                                        Cari</button>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="my-5">
        <div class="container">

            <div class="col-md-11 mx-auto">
                <div class="row">

                    <div class="col-md-9">
                        <div class="row mb-md-2">
                            @foreach ($ads as $data)
                                <div class="col-md-4">
                                    <div class="card shadow mb-3">
                                        <div class="card-img-cover">

                                            <div class="card-img-frame">
                                                <img src="{{ $data->images[0]->image_url }}" class="card-img-top img-fluid"
                                                    alt="{{$data->title}}">
                                                <div class="tag badge text-bg-success"><i class="ti ti-tag"></i>
                                                    {{ $data->category_name }}</div>
                                            </div>

                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title archive-title"><a class="text-muted text-decoration-none"
                                                    href="{{ url('detail/' . $data->slug) }}">
                                                    {{ $data->title }} </a></h5>


                                            <h4 class="text-success">
                                                
                                                
                                                
                                                
                                                @php
                                                $n = $data->price;
                                                $presisi=1;
                                                    if ($n < 900) {
		$format_angka = number_format($n, $presisi);
		$simbol = '';
	} else if ($n < 900000) {
		$format_angka = number_format($n / 1000, $presisi);
		$simbol = 'rb';
	} else if ($n < 900000000) {
		$format_angka = number_format($n / 1000000, $presisi);
		$simbol = 'jt';
	} else if ($n < 900000000000) {
		$format_angka = number_format($n / 1000000000, $presisi);
		$simbol = 'M';
	} else {
		$format_angka = number_format($n / 1000000000000, $presisi);
		$simbol = 'T';
	}
 
	if ( $presisi > 0 ) {
		$pisah = '.' . str_repeat( '0', $presisi );
		$format_angka = str_replace( $pisah, '', $format_angka );
	}
                                                @endphp
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                Rp. {{ $format_angka .' '. $simbol}}</h4>
                                            <div class="row">
                                                @foreach (App\Models\AdditionalField::where('advertisement_id', $data->id)->take(2)->get() as $field)
                                                    <div class="col-md-6">
                                                        {!! $field->field_icon !!} : {!! $field->field_value !!}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <span class="me-3"><i class="ti ti-map-pin"></i> 
                                                {{ $data->province_name }}
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            @endforeach


                        </div>

                    </div>
                    <div class="col-md-3">



                        <div class="card">
                            <div class="d-flex card-header justify-content-between">
                                <h5 class="me-3 mb-0">Category</h5>
                                <a class="text-muted text-decoration-none" href="{{ url('category') }}">View All</a>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">

                                    @foreach ($categories as $category)
                                        <!--List-item-->

                                        <li class="list-group-item pt-0">
                                            <a class="text-decoration-none text-muted"
                                                href="{{ url('category/' . $category->slug) }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <img src="{{ $category->image_url }}" alt=""
                                                            class="avatar rounded-circle" />
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-0">{{ $category->name }}</h6>
                                                    </div>
                                                    <div class="flex-shrink-0 text-end">
                                                        <span
                                                            class="badge rounded-pill text-bg-primary bg-success-subtle text-success">
                                                            {{ $category->advertisements->count() }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>




                    </div>



                </div>

            </div>
        </div>
    </section>



@endsection

@section('scripts')
    <script>
        $('.single-select-field').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
    </script>
@endsection
