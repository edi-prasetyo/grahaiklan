@extends('layouts.app')

@section('content')
    @include('layouts.inc.frontend.header')

    <div class="container">

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        <div class="row">

            <div class="col-md-8">
                <div class="d-grid gap-2 my-3">
                    <a href="{{ url('seller/create') }}" class="btn btn-primary btn-lg"> <i class='bx bx-plus-circle'></i>
                        Pasang Iklan</a>
                </div>

                <div class="row">

                    <div class="col-md-8 col-6">
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Iklan Aktif</h5>
                                        <span class="h2 font-weight-bold mb-0">234</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                            <i class="bx bx-baguette"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-4 col-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">New users</h5>
                                        <span class="h2 font-weight-bold mb-0">2,356</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                            <i class="fas fa-chart-pie"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span>
                                    <span class="text-nowrap">Since last week</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Judul Iklan</th>
                                <th scope="col">Berakhir Pada</th>
                                <th scope="col">Dilihat</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ads as $data)
                                <tr>
                                    <td>{{ $data->title }}</td>
                                    <td>{{ $data->price }}</td>
                                    <td>{{ $data->views }}</td>
                                    <td>
                                        <a href="" class="btn btn-primary">Edit</a>
                                        <a href="" class="btn btn-danger">Terjual</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="col-md-4">
                <div class="card">Sidebar</div>
            </div>
        </div>
    </div>
@endsection
