@extends('layouts.app')
@section('content')
@include('layouts.inc.frontend.header')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('frontend.member.sidebar')
        </div>
        <div class="col-md-9">
            @if(Auth::user()->role == 3 || Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role ==
            4)
            <div class="card mb-3">
                <div class="card-body d-flex justify-content-between align-items-start">
                    <div>
                        <h3> {{$user->name}}</h3>
                        <small> <i class='bx bx-envelope'></i> {{$user->email}} </small><br>
                        <small><i class='bx bx-calendar'></i> {{$user->email_verified_at}} </small>
                    </div>
                    <div>
                        <a href="{{url('member/update-password')}}" class="btn btn-success"><i class='bx bx-lock'></i>
                            Ubah
                            Password</a>
                        @if(Auth::user()->role == 3)
                        @else
                        {{-- <a href="{{url('member/upgrade')}}" class="btn btn-primary"><i class='bx bx-cart'></i>
                            Jadi Penjual</a> --}}
                        @endif
                    </div>
                </div>
            </div>

            @else


            @endif

            @if(Auth::user()->role == 3 )
            <div class="card mb-5">
                <div class="card-header bg-white d-flex justify-content-between align-items-start border-0">
                    Profile Seller <a href="{{url('member/edit-profile')}}" class="btn btn-success"><i
                            class='bx bx-lock'></i> Ubah Data</a>
                </div>
                <div class="card-body">
                    <div class="row lh-lg">
                        <div class="col-3"> Merchant ID</div>
                        <div class="col-9"> : {{$userDetail->merchant_id}} </div>
                        <div class="col-3"> Nama toko </div>
                        <div class="col-9"> : {{$userDetail->merchant_name}} </div>
                        <div class="col-3"> Alamat </div>
                        <div class="col-9"> : {{$userDetail->merchant_address}} </div>
                        <div class="col-3"> Bank </div>
                        <div class="col-9"> : {{$userDetail->bank_name}} </div>
                        <div class="col-3"> No Rekening </div>
                        <div class="col-9"> : {{$userDetail->bank_number}} </div>
                        <div class="col-3"> Atas Nama </div>
                        <div class="col-9"> : {{$userDetail->bank_account}} </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection