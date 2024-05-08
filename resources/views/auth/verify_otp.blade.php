@extends('layouts.app')
{{-- @include('layouts.inc.frontend.header') --}}
@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body px-5">
                        @if (session('incorrect'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('incorrect') }}
                            </div>
                        @endif

                        @if (session('sending'))
                            <div class="alert alert-success" role="alert">
                                {{ session('sending') }}
                            </div>
                        @endif
                        <h4 class="my-3">
                            {{ __('Verifikasi OTP') }}
                        </h4>
                        {{-- <p class="mb-4">Masukan Kode OTP yang di kirim, ke whatsapp atau email anda</p> --}}
                        <form method="POST" action="{{ route('send_otp') }}">
                            @csrf

                            <div class="form-group mb-3">
                                {{-- <label for="email" class="col-form-label text-md-end">{{ __('OTP')
                                }}</label> --}}

                                <input type="number" class="form-control @error('otp') is-invalid @enderror" name="otp"
                                    value="{{ old('email') }}" required autocomplete="otp" placeholder="Masukan OTP"
                                    autofocus>

                                @error('otp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="row mb-0">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary d-grid w-100">
                                        {{ __('Verifikasi') }}
                                    </button>


                                </div>
                            </div>

                        </form>
                        <p class="text-center mt-5">

                        <form method="POST" action="{{ route('resend_otp') }}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"> Belum Dapat Kode OTP?
                            <button type="submit" class="btn btn-link text-dark text-center">Kirim Ulang</button>
                        </form>

                        </p>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
