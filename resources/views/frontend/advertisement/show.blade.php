@extends('layouts.app')
@section('content')


    <div class="container p-4 py-md-5">
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

                                        @foreach ($images as $key => $slider)
                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                <a href="{{ $slider->image_url }}" data-toggle="lightbox"
                                                    data-gallery="example-gallery" class="col-sm-4">
                                                    <div class="carousel-img-height rounded">
                                                        <img src="{{ $slider->image_url }}" class="d-block"
                                                            alt="{{ $slider->title }}">
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
                                    <h6 class="col-md-4 col-6"><i class="ti ti-chart-bar"></i> {{ $ads->views }} Kali
                                        Dilihat</h6>
                                </div>

                                <h2 class="fw-bold my-3 text-success">Rp. {{ number_format($ads->price) }}</h2>
                                <h3 class="fw-bold my-3">Spesifikasi</h3>
                                <div class="row">

                                    @foreach ($additional_field as $field)
                                        <div class="col-6">
                                            <div class="d-flex">
                                                <div class="icon icon-shape border text-muted rounded me-3">
                                                    {!! $field->field_icon !!}
                                                </div>
                                                <div>
                                                    {{ $field->field_name }} <br>
                                                    <p class="fw-bold"> {{ $field->field_value }} </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="d-grid gap-2">
                                    <a href="https://wa.me/{{ $ads->phone }}?text=Halo%20Saya%20melihat%20iklan%20di%20{{ $option_nav->title }}%20dengan%20judul%20{{ $ads->title }}"
                                        class="btn btn-success btn-lg"> <i class="ti ti-brand-whatsapp"></i> Hubungi
                                        Penjual
                                    </a>
                                </div>
                            </div>

                        </div>

                        <h4 class="fw-bold my-3">Deskripsi</h4>
                        <div class="text-muted stretched-link">
                            {!! $ads->description !!}
                            {{-- {{ $ads->description }} --}}
                        </div>
                    @endif

                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            Info Penjual
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center position-relative pb-3">
                                <div class="flex-shrink-0">
                                    <img class="avatar-md rounded-circle img-thumbnail"
                                        src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Profile Picture"
                                        loading="lazy">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <a href="{{ url('listing/' . $ads->user_id) }}"
                                        class="h5 stretched-link text-decoration-none">{{ $ads->name }}</a><br>

                                </div>

                            </div>

                            <small class="text-muted"> Bergabung Sejak
                                {{ date('d M Y', strtotime($ads->userjoin)) }}</small>
                            <div class=" d-grid gap-2">
                                <a href="https://wa.me/{{ $ads->phone }}?text=Halo%20Saya%20melihat%20iklan%20di%20{{ $option_nav->title }}%20dengan%20judul%20{{ $ads->title }}"
                                    class="btn btn-success"> <i class="ti ti-brand-whatsapp"></i> Hubungi
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
