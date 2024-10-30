@extends('layouts.app')
@section('title', 'Atrans Auto')
@section('content')

    {{-- <div class="container my-3">
        <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" navigation="true" space-between="30"
            centered-slides="true" autoplay-delay="2500" autoplay-disable-on-interaction="false">
            <swiper-slide><img class="rounded-4"
                    src="https://images.tokopedia.net/img/cache/1208/NsjrJu/2024/6/27/d00dbb58-ecca-456f-97ac-8eca1f30aeb5.jpg">
            </swiper-slide>
            <swiper-slide><img class="rounded-4"
                    src="https://images.tokopedia.net/img/cache/1208/NsjrJu/2024/7/26/10da9fec-9073-441d-a88e-6f674a28a877.jpg">
            </swiper-slide>
            <swiper-slide><img class="rounded-4"
                    src="https://images.tokopedia.net/img/cache/1208/NsjrJu/2024/7/26/bd0e2845-41a2-4ea4-af13-9415d6ecccb3.jpg">
            </swiper-slide>


        </swiper-container>
    </div> --}}

    <section class="bg-success">
        <div class="hero-img">
            <div class="container px-4 px-lg-0 py-5 ">
                <!-- Hero Section -->
                <div class="row align-items-center">
                    <div class=" col-md-12 text-center">
                        <div class=" mb-4 text-center text-xl-start px-md-8 px-lg-19 px-xl-0">
                            <!-- Caption -->
                            <h1 class="display-3 fw-bold mb-3 ls-sm text-white">
                                <span class="text-warning">Pasang Iklan</span> Gratis?
                            </h1>
                            <p class="mb-6 lead pe-lg-6 text-white">
                                Pasang disini Aja Gratis Tayang Selamanya
                            </p>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>




    <section>
        <div class="container">
            <div class="form-search">
                <div class="card rounded p-2">
                    <div class="card-body">


                        <form action="{{ url('result') }}" method="GET">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <select class="form-select single-select-field" name="province_id"
                                        aria-label="Default select example">
                                        <option value="">Lokasi</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select single-select-field" name="category_id"
                                        aria-label="Default select example">
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
                                        <button class="btn btn-success" type="submit"><i class="ti ti-search"></i>
                                            Cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>



                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="my-5">
        <div class="container">
            <div class="row">
                @foreach ($categories as $category)
                    <!--List-item-->
                    <div class="col-md-1 text-center">
                        {{-- <div class="card shadow-sm border-0 bg-body">
                            <div class="card-body"> --}}
                        <a class="text-decoration-none text-muted" href="{{ url('category/' . $category->slug) }}">
                            <div class="">
                                <div class="">
                                    <div class="icon-bg-circle">
                                        <img src="{{ $category->image_url }}" alt=""
                                            class="avatar bg-light rounded" />
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h6 class="mb-0">{{ $category->name }}</h6>
                                </div>
                                {{-- <div class="">
                                    <span class="badge rounded-pill text-bg-primary bg-success-subtle text-success">
                                        {{ $category->advertisements->count() }}
                                    </span>
                                </div> --}}
                            </div>
                        </a>
                        {{-- </div>
                        </div> --}}
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="my-5">
        <div class="container">

            <div class="col-md-12 mx-auto">

                <h3 class="mb-5"> Iklan Populer</h3>
                <div class="row">

                    <div class="col-md-12">
                        <div class="row mb-md-2">
                            @foreach ($popular_ads as $data)
                                <div class="col-md-2">
                                    <div class="card shadow-sm border-0 mb-3">
                                        <div class="card-img-cover rounded-top">

                                            <div class="card-img-frame">
                                                <img src="{{ $data->images[0]->image_url }}" class="card-img-top img-fluid"
                                                    alt="{{ $data->title }}">
                                                <div class="tag badge text-bg-success"><i class="ti ti-tag"></i>
                                                    {{ $data->category_name }}</div>
                                            </div>

                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title archive-title"><a class="text-muted text-decoration-none"
                                                    href="{{ url('detail/' . $data->slug) }}">
                                                    {{ $data->title }} </a></h5>


                                            <h4 class="text-success fw-bold">
                                                @php
                                                    $n = $data->price;
                                                    $presisi = 1;
                                                    if ($n < 900) {
                                                        $format_angka = number_format($n, $presisi);
                                                        $simbol = '';
                                                    } elseif ($n < 900000) {
                                                        $format_angka = number_format($n / 1000, $presisi);
                                                        $simbol = 'rb';
                                                    } elseif ($n < 900000000) {
                                                        $format_angka = number_format($n / 1000000, $presisi);
                                                        $simbol = 'jt';
                                                    } elseif ($n < 900000000000) {
                                                        $format_angka = number_format($n / 1000000000, $presisi);
                                                        $simbol = 'M';
                                                    } else {
                                                        $format_angka = number_format($n / 1000000000000, $presisi);
                                                        $simbol = 'T';
                                                    }

                                                    if ($presisi > 0) {
                                                        $pisah = '.' . str_repeat('0', $presisi);
                                                        $format_angka = str_replace($pisah, '', $format_angka);
                                                    }
                                                @endphp
                                                Rp. {{ $format_angka . ' ' . $simbol }}</h4>
                                            {{-- <div class="row">
                                                @foreach (App\Models\AdditionalField::where('advertisement_id', $data->id)->take(2)->get() as $field)
                                                    <div class="col-md-6">
                                                        <img style="width:20%;" src="{{ $field->field_icon }}"> :
                                                        {!! $field->field_value !!}
                                                    </div>
                                                @endforeach
                                            </div> --}}
                                        </div>
                                        <div class="card-footer bg-body border-0">
                                            <span class="me-3"><i class="ti ti-map-pin"></i>
                                                {{ $data->province_name }}
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            @endforeach


                        </div>

                    </div>



                    {{-- <div class="col-md-3">
                        <div class="card">
                            <div class="d-flex card-header justify-content-between">
                                <h5 class="me-3 mb-0">Category</h5>
                                <a class="text-muted text-decoration-none" href="{{ url('category') }}">View All</a>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">

                                    @foreach ($categories as $category)
                                        <li class="list-group-item pt-2">
                                            <a class="text-decoration-none text-muted"
                                                href="{{ url('category/' . $category->slug) }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="icon-bg-circle">
                                                            <img src="{{ $category->image_url }}" alt=""
                                                                class="avatar bg-white rounded" />
                                                        </div>
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
                    </div> --}}



                </div>
            </div>
        </div>
    </section>


    <section class="my-5">
        <div class="container">

            <div class="col-md-12 mx-auto">

                <h3 class="mb-5"> Iklan Terbaru</h3>
                <div class="row">

                    <div class="col-md-12">
                        <div class="row mb-md-2">
                            @foreach ($ads as $data)
                                <div class="col-md-2">
                                    <div class="card shadow-sm border-0 mb-3">
                                        <div class="card-img-cover rounded-top">

                                            <div class="card-img-frame">
                                                <img src="{{ $data->images[0]->image_url }}" class="card-img-top img-fluid"
                                                    alt="{{ $data->title }}">
                                                <div class="tag badge text-bg-success"><i class="ti ti-tag"></i>
                                                    {{ $data->category_name }}</div>
                                            </div>

                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title archive-title"><a class="text-muted text-decoration-none"
                                                    href="{{ url('detail/' . $data->slug) }}">
                                                    {{ $data->title }} </a></h5>


                                            <h4 class="text-success fw-bold">
                                                @php
                                                    $n = $data->price;
                                                    $presisi = 1;
                                                    if ($n < 900) {
                                                        $format_angka = number_format($n, $presisi);
                                                        $simbol = '';
                                                    } elseif ($n < 900000) {
                                                        $format_angka = number_format($n / 1000, $presisi);
                                                        $simbol = 'rb';
                                                    } elseif ($n < 900000000) {
                                                        $format_angka = number_format($n / 1000000, $presisi);
                                                        $simbol = 'jt';
                                                    } elseif ($n < 900000000000) {
                                                        $format_angka = number_format($n / 1000000000, $presisi);
                                                        $simbol = 'M';
                                                    } else {
                                                        $format_angka = number_format($n / 1000000000000, $presisi);
                                                        $simbol = 'T';
                                                    }

                                                    if ($presisi > 0) {
                                                        $pisah = '.' . str_repeat('0', $presisi);
                                                        $format_angka = str_replace($pisah, '', $format_angka);
                                                    }
                                                @endphp
                                                Rp. {{ $format_angka . ' ' . $simbol }}</h4>
                                            {{-- <div class="row">
                                                @foreach (App\Models\AdditionalField::where('advertisement_id', $data->id)->take(2)->get() as $field)
                                                    <div class="col-md-6">
                                                        <img style="width:20%;" src="{{ $field->field_icon }}"> :
                                                        {!! $field->field_value !!}
                                                    </div>
                                                @endforeach
                                            </div> --}}
                                        </div>
                                        <div class="card-footer bg-body border-0">
                                            <span class="me-3"><i class="ti ti-map-pin"></i>
                                                {{ $data->province_name }}
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            @endforeach


                        </div>

                    </div>



                    {{-- <div class="col-md-3">
                        <div class="card">
                            <div class="d-flex card-header justify-content-between">
                                <h5 class="me-3 mb-0">Category</h5>
                                <a class="text-muted text-decoration-none" href="{{ url('category') }}">View All</a>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">

                                    @foreach ($categories as $category)
                                        <li class="list-group-item pt-2">
                                            <a class="text-decoration-none text-muted"
                                                href="{{ url('category/' . $category->slug) }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="icon-bg-circle">
                                                            <img src="{{ $category->image_url }}" alt=""
                                                                class="avatar bg-white rounded" />
                                                        </div>
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
                    </div> --}}



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
