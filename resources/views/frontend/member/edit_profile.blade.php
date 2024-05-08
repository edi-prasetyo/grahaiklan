@extends('layouts.app')
@section('content')
@include('layouts.inc.frontend.header')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('frontend.member.sidebar')
        </div>

        <div class="col-md-9">
            <div class="card border-0 card-body">
                <form action="{{url('member/update_profile')}}" method="POST">
                    @csrf
                    @method('put')

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nama Depan</label>
                                <input type="text" name="firs_name" class="form-control"
                                    value="{{$userDetail->first_name}}">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nama Belakang</label>
                                <input type="text" name="last_name" class="form-control"
                                    value="{{$userDetail->last_name}}">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nama Merchant</label>
                                <input type="text" name="merchant_name" class="form-control"
                                    value="{{$userDetail->merchant_name}}">
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Alamat Merchant</label>
                                <textarea type="text" name="merchant_address"
                                    class="form-control">{{$userDetail->merchant_address}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nama Bank</label>
                                <input type="text" name="bank_name" class="form-control"
                                    value="{{$userDetail->bank_name}}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nomor Rekening</label>
                                <input type="text" name="bank_number" class="form-control"
                                    value="{{$userDetail->bank_number}}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Atas Nama</label>
                                <input type="text" name="bank_account" class="form-control"
                                    value="{{$userDetail->bank_account}}">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    @endsection