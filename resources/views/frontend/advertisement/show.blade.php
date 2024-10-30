@extends('layouts.app')
@section('content')

    @php

        $nohp = $ads->phone;
        if (!preg_match('/[^+0-9]/', trim($nohp))) {
            // cek apakah no hp karakter ke 1 dan 2 adalah angka 62
            if (substr(trim($nohp), 0, 2) == '62') {
                $hp = trim($nohp);
            }
            // cek apakah no hp karakter ke 1 adalah angka 0
            elseif (substr(trim($nohp), 0, 1) == '0') {
                $hp = '62' . substr(trim($nohp), 1);
            }
        }

    @endphp
    <div class="container py-md-5">
        <div class="row">
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif
            <!-- /User Card -->
            <div class="row">
                <div class="col-md-9 mx-auto">

                    @if ($ads->status == 0)
                        Maaf Iklan ini Sudah tidak Aktif, Silahkan Hubungi Admin untuk alasan penonaktifan Iklan Anda
                    @else
                        <div class="row">
                            <h1 class="fw-bold mb-5">{{ $ads->title }}</h1>

                            <div class="col-md-6">
                                <div id="carouselExampleIndicators" class="carousel slide " data-bs-ride="carousel">
                                    <div class="carousel-inner">

                                        @foreach ($ads->images as $key => $slider)
                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                <a href="{{ asset('uploads/images/' . $slider->image) }}"
                                                    data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-4">
                                                    <div class="carousel-img-height rounded">
                                                        <img src="{{ asset('uploads/images/' . $slider->image) }}"
                                                            class="d-block" alt="{{ $slider->title }}">
                                                    </div>
                                                </a>

                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">

                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>

                                        <span class="visually-hidden">Previous</span>

                                    </button>

                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="next">

                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>

                                        <span class="visually-hidden">Next</span>

                                    </button>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="row">
                                    <h6 class="col-md-4 col-6"><i class="ti ti-map-pin"></i> {{ $ads->province_name }} </h6>
                                    <h6 class="col-md-4 col-6"><i class="ti ti-tag"></i> {{ $ads->category_name }}</h6>
                                    <h6 class="col-md-4 col-6"><i class="ti ti-eye"></i> {{ $ads->views }} Kali
                                        Dilihat</h6>
                                </div>

                                <h2 class="fw-bold my-3 text-success">Rp. {{ number_format($ads->price) }}</h2>
                                @if (count($additional_field) === 0)
                                @else
                                    <h3 class="fw-bold my-3">Spesifikasi</h3>
                                @endif




                                <div class="row">

                                    @foreach ($additional_field as $field)
                                        <div class="col-6">
                                            <div class="d-flex">
                                                <div class="icon icon-shape border text-muted rounded me-3">
                                                    <img style="filter: invert(58%) sepia(27%) saturate(26%) hue-rotate(19deg) brightness(95%) contrast(96%);"
                                                        src="{{ $field->field_icon }}">
                                                </div>
                                                <div>
                                                    {{ $field->field_name }} <br>
                                                    <p class="fw-bold"> {{ $field->field_value }} </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="alert alert-warning"><i class="ti ti-alert-triangle"></i> Hati-hati dalam
                                    bertransaksi, kami tidak
                                    bertanggung jawab apabila terjadi penipuan pada iklan yang di tayangkan, silahkan baca
                                    pedoman dalam bertransaksi </div>
                                <a href="" class="text-decoration-none text-body-emphasis"><i class="ti ti-flag"></i>
                                    Laporkan Iklan Ini</a>
                                <div class="d-grid gap-2">
                                    {{-- <a class="first btn btn-success">First Button</a>
                                    <a class="second btn btn-success">Second Button</a> --}}

                                </div>
                            </div>

                        </div>

                        <h4 class="fw-bold my-3">Deskripsi</h4>
                        <div class="text-muted">
                            {!! $ads->description !!}

                        </div>
                    @endif

                    <h4>Related Ads</h4>
                    <div class="row">
                        @forelse ($related_ads as $data)
                            <div class="col-md-3 col-6">

                                <div class="card mb-3 shadow-sm">
                                    <div class="card-img-cover">
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

                                        <h4 class="text-success">
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




                                    </div>
                                    <div class="card-footer">
                                        <span class="me-3"><i class="ti ti-map-pin"></i>
                                            {{ $data->province_name }}
                                        </span>
                                    </div>
                                </div>

                            </div>
                        @empty

                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h3> Pencarian anda tidak di temukan</h3>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            Info Penjual
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center position-relative pb-3">
                                <div class="flex-shrink-0">
                                    @if ($user_detail->photo_url == null)
                                        <img src="{{ asset('uploads/logo/avatar.jpg') }}"
                                            class="img-fluid avatar-md rounded-circle" alt="">
                                    @else
                                        <img src="{{ $user_detail->photo_url }}" class="img-fluid avatar-md rounded-circle"
                                            alt="">
                                    @endif
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <a href="{{ url('user/' . $ads->user_id) }}"
                                        class="h5 stretched-link text-decoration-none">{{ $ads->name }}</a><br>
                                    <small class="text-muted"> Bergabung Sejak<br>
                                        {{ date('d M Y', strtotime($ads->userjoin)) }}</small>


                                </div>



                            </div>
                            <div class="col-md-9 mb-3">
                                @if ($user_detail->logo_url == null)
                                @else
                                    <img class="" src="{{ $user_detail->logo_url }}" alt="Profile Picture"
                                        loading="lazy">
                                @endif
                            </div>

                            <div class=" d-grid gap-2">
                                <a href="https://wa.me/{{ $hp }}?text=Halo%20Saya%20melihat%20iklan%20di%20{{ $global_option->title }}%20dengan%20judul%20{{ $ads->title }}"
                                    class="second btn btn-success btn-lg"> <i class="ti ti-brand-whatsapp"></i> Hubungi
                                    Penjual
                                </a>
                                <a href="https://wa.me/{{ $hp }}?text=Halo%20Saya%20melihat%20iklan%20di%20{{ $global_option->title }}%20dengan%20judul%20{{ $ads->title }}"
                                    class="first btn btn-success btn-lg"> <i class="ti ti-brand-whatsapp"></i> Hubungi
                                    Penjual
                                </a>
                            </div>




                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



@endsection

@section('scripts')
    <script>
        import Lightbox from 'bs5-lightbox';

        const options = {
            keyboard: true,
            size: 'fullscreen'
        };

        document.querySelectorAll('.my-lightbox-toggle').forEach((el) => el.addEventListener('click', (e) => {
            e.preventDefault();
            const lightbox = new Lightbox(el, options);
            lightbox.show();
        }));
    </script>
@endsection
