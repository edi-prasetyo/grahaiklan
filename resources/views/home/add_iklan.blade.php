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

                    <div class="card">
                        <div class="card-header">
                            Pilih Kategori
                        </div>
                        <div class="card-body">
                            @foreach ($subcategories as $data)
                                <a href="{{ url('add-iklan/sub/' . $data->slug) }}" class="btn btn-outline-secondary mb-2">
                                    {{ $data->name }}</a>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
