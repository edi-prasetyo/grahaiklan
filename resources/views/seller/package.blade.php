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

        <div class="mx-auto">
            <div class="row">

                <div class="col-sm-6 col-xl-3 mb-3">
                    <div class="card border">
                        <div class="card-header border-bottom flex-column align-items-start p-3">
                            <i class="bx bx-package text-success h3"></i>
                            <h4 class="text-success font-weight-light mb-2">1 Iklan</h4>
                            <p class="font-size-sm mb-0">Masa berlaku paket hingga 1 tahun</p>
                        </div>
                        <div class="card-header border-bottom justify-content-center py-4">
                            <h2 class="pricing-price">
                                <small class="align-self-start">Rp</small>
                                50.000
                                <small class="align-self-end"></small>
                            </h2>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled font-size-sm mb-0">
                                <li>
                                    <div><i class="bx bx-check text-success h3"></i> <strong>1 </strong><span
                                            class="text-secondary ml-1">Iklan</span></div>

                                    <small>masa tayang iklan hingga 3 bulan</small>
                                </li>


                            </ul>
                        </div>
                        <div class="card-footer justify-content-center p-3">
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-success">BELI PAKET</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 mb-3">
                    <div class="card bg-success border-success">
                        <div class="card-header flex-column align-items-start p-3">
                            <i class='bx bx-layer text-white h3'></i>
                            <h4 class="text-white font-weight-light mb-2">10 Iklan</h4>
                            <p class="text-white font-size-sm mb-0">Masa berlaku paket hingga 1 tahun</p>
                        </div>
                        <div class="card-header justify-content-center py-4">
                            <h2 class="pricing-price text-white">
                                <small class="align-self-start text-white ">Rp</small>
                                <strong> 300.000</strong>
                                <small class="align-self-end"></small>
                            </h2>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled text-white font-size-sm mb-0">
                                <li>
                                    <div> <i class="bx bx-check text-white h3"></i> <strong>10</strong><span
                                            class="text-white ml-1">
                                            Iklan</span></div>
                                    <small>masa tayang iklan hingga 3 bulan</small>
                                </li>


                            </ul>
                        </div>
                        <div class="card-footer justify-content-center p-3">
                            <div class="d-grid gap-2">
                                <button class="btn btn-warning">BELI PAKET</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-6 col-xl-3 mb-3">
                    <div class="card">
                        <div class="card-header border-bottom flex-column align-items-start p-3">
                            <i class='bx bx-gift text-success h3'></i>
                            <h4 class="text-success font-weight-light mb-2">Unlimited</h4>
                            <p class="font-size-sm mb-0">Masa berlaku paket hingga 1 tahun
                            </p>
                        </div>
                        <div class="card-header border-bottom justify-content-center py-4">
                            <h2 class="pricing-price">
                                <small class="align-self-start">Rp. 500.000</small>
                                <small class="align-self-end"></small>
                            </h2>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled font-size-sm mb-0">
                                <li>
                                    <div>
                                        <i class="bx bx-check"></i> <strong>Unlimited</strong><span
                                            class="text-secondary ml-1"> Iklan</span>
                                    </div>
                                    <small>masa tayang iklan hingga 3 bulan</small>
                                </li>

                            </ul>
                        </div>
                        <div class="card-footer justify-content-center p-3">
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-success">BELI PAKET</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
