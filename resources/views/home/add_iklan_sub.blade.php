@extends('layouts.app')
@section('content')
    @include('layouts.inc.frontend.header')
    <div class="container my-3 mb-5">
        <div class="row">
            <div class="col-md-12">

                <!-- /User Card -->
                <div class="col-md-8 mx-auto">

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

                    <div class="col-md-8 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <a class="text-decoration-none text-dark" href="{{ url('add-iklan') }}"> <i
                                        class="ti ti-arrow-left"></i> Semua Kategori</a>
                            </div>
                            <div class="card-body">


                                {{-- <ul class="list-group list-group-flush">
                                    @foreach ($categories as $data)
                                        <div class="">
                                            <a class="btn btn-labeled btn-success mb-2 w-100 text-start"
                                                href="{{ url('add-iklan/sub/' . $data->slug) }}" class="mb-2"><span
                                                    class="btn-label">
                                                    <img src="{{ $data->image_url }}"
                                                        class="avatar bg-white rounded-circle">
                                                </span>
                                                {{ $data->name }}</a>
                                        </div>
                                    @endforeach
                                </ul> --}}


                                <ul class="list-group list-group-flush">
                                    @foreach ($subcategories as $data)
                                        <li class="list-group-item pt-2">
                                            <a class="text-decoration-none text-muted"
                                                href="{{ url('add-iklan/' . $category->slug . '/' . $data->slug) }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        {{-- <div class="icon-bg-circle">
                                                            <img src="{{ $data->image_url }}" alt=""
                                                                class="avatar bg-white rounded" />
                                                        </div> --}}
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-0"><i class="ti ti-caret-right-filled"></i>
                                                            {{ $data->name }}</h6>
                                                    </div>
                                                    <div class="flex-shrink-0 text-end">
                                                        @if ($data->premium == 1)
                                                            <span
                                                                class="badge rounded-pill text-bg-primary bg-danger-subtle text-danger">
                                                                Premium
                                                            </span>
                                                        @else
                                                            <span
                                                                class="badge rounded-pill text-bg-primary bg-success-subtle text-success">
                                                                Gratis
                                                            </span>
                                                        @endif
                                                        <i class="ti ti-chevron-right"></i>

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
    </div>
@endsection
