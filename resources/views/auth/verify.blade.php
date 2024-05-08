@extends('layouts.app')
@include('layouts.inc.frontend.header')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">
                    <h5>{{ __('Verifikasi Alamat Email') }}</h5>
                </div>
                <div class="card-body">


                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('Link verifikasi baru telah dikirim ke email Anda.') }}
                    </div>
                    @endif

                    {{ __('Sebelum melanjutkan, periksa email Anda untuk tautan verifikasi.') }}
                    {{ __('Jika Anda tidak menerima email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">{{ __('Kirim Ulang') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection