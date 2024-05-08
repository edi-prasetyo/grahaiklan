@extends('layouts.app')
@section('title', 'Products')
@section('content')
@include('layouts.inc.frontend.header')
<div class="container my-3">
    <div class="col-md-10 mx-auto">
        @if(session('success'))
        <div class="col-md-12">
            <div class="alert alert-success d-flex justify-content-between align-items-start">
                {{session('success')}}
                <a href="{{url('cart')}}" class="btn btn-success">View Cart</a>
            </div>
        </div>
        @endif

        <div class="row">
            <h1 class="card-title mb-3">{{$product->name}}</h1>
            <div class="d-flex mb-3 text-muted">
                <div class="me-3">
                    <i class='bx bxs-purchase-tag'></i> <a href="{{url('category/' .$product->category_slug)}}"
                        class="text-muted"> {{$product->category_name}}</a>
                </div>

                <div class="ms-3">
                    <i class='bx bxs-user'></i> {{$product->views}} views
                </div>
            </div>
            <div class="col-md-8">
                <img src="{{asset($product->image_cover)}}" class="img-fluid w-100 rounded-4">

                <div class="row mt-3">
                    <div class="col-6">
                        <div class="d-grid gap-2">
                            <a href="{{ url('add-to-cart/'.$product->id) }}"
                                class="btn btn-success btn-rounded text-center" role="button">
                                <i class='bx bx-server'></i> Live Demo</a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-grid gap-2">


                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#previewModal">
                                Screenshot
                            </button>

                            {{-- <a href="{{ url('add-to-cart/'.$product->uuid) }}"
                                class="btn btn-primary btn-rounded text-center" role="button">
                                <i class='bx bxs-cart'></i> Add to cart</a> --}}
                        </div>
                    </div>

                </div>

                {{-- Nav Tabs Start --}}

                <nav class="mt-5">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active text-muted" id="nav-home-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                            aria-selected="true">Product Detail</button>
                        {{-- <button class="nav-link text-muted" id="nav-profile-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                            aria-selected="false"><i class='bx bx-star'></i> Reviews 4.5 <span
                                class="badge bg-success ms-3">2134</span>
                        </button> --}}
                        <button class="nav-link text-muted" id="nav-gallery-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-gallery" type="button" role="tab" aria-controls="nav-gallery"
                            aria-selected="false"><i class='bx bx-image'></i> Gallery
                        </button>
                        <button class="nav-link text-muted" id="nav-contact-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact"
                            aria-selected="false"><i class='bx bx-comment'></i> Comments <span
                                class="badge bg-success ms-3">2134</span>
                        </button>
                    </div>
                </nav>
                <div class="tab-content p-3 bg-white border-start border-end border-bottom" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                        tabindex="0">
                        {!!$product->description!!}
                    </div>
                    {{-- <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                        tabindex="0">
                        ...
                    </div> --}}
                    <div class="tab-pane fade" id="nav-gallery" role="tabpanel" aria-labelledby="nav-gallery-tab"
                        tabindex="0">


                        <div class="row">
                            @foreach($images as $key => $image)
                            <div class="col-md-6 mb-3">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$image->id}}"> <img
                                        class="img-fluid" src="{{asset($image->image)}}"></a>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$image->id}}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">

                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img class="img-fluid rounded w-100" src="{{asset($image->image)}}">
                                        </div>

                                    </div>
                                </div>
                            </div>


                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"
                        tabindex="0">

                        <div class="alert alert-success">Komentar anda akan di balas paling lambat 1x 24 Jam</div>
                        <form action="" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 my-3">
                                    <input type="text" name="name" placeholder="Nama..." class="form-control">
                                </div>
                                <div class="col-md-6 my-3">
                                    <input type="email" name="email" placeholder="Email" class="form-control">
                                </div>
                                <div class="col-md-12 my-3">
                                    <textarea type="text" name="message" class="form-control"
                                        placeholder="Pesan"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success"><i class='bx bxs-send'></i> Kirim
                                        Komentar</button>
                                </div>
                            </div>

                        </form>

                        <h4 class="my-3"><i class='bx bx-comment'></i> 234 Komentar</h4>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-start">
                                <div><i class='bx bx-user'></i> nama</div>
                                <div>
                                    <i class='bx bx-calendar'></i> 18 jan 2023
                                </div>
                            </div>
                            <div class="card-body">
                                Halloo
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header bg-white">
                        <h3>IDR {{number_format($product->price, 0)}}</h3>
                    </div>
                    <div class="card-body">
                        {!!$product->short_description!!}
                    </div>
                    <div class="card-footer">
                        <div class="d-grid gap-2">
                            <a href="{{ url('add-to-cart/'.$product->uuid) }}"
                                class="btn btn-primary btn-rounded text-center" role="button">
                                <i class='bx bxs-cart'></i> Add to cart</a>
                        </div>
                    </div>
                </div>
                {{-- <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-start bg-white">

                    </div>
                    <div class="card-body">

                        <div class="avatar-img-frame">
                            <img src="http://localhost:8000/uploads/products/1693462204.png">
                        </div>

                    </div>
                </div> --}}
            </div>
            {{-- Nav Tabs End --}}
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">



                <div id="carouselExampleDark" class="carousel carousel-dark slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">

                        @foreach($images as $key => $image)
                        <div class="carousel-item active" data-bs-interval="10000">
                            <img src="{{asset($image->image)}}" class="d-block w-100" alt="...">
                        </div>
                        @endforeach


                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>















            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>


@endsection