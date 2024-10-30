@extends('layouts.app')
@section('content')
    @include('layouts.inc.frontend.header')
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body px-5">
                        <h4 class="my-3">
                            {{ __('Login') }}
                        </h4>
                        <p class="mb-4">Silahkan Login untuk masuk ke member</p>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf





                            <div class="form-group mb-3">
                                <label for="email" class="col-form-label text-md-end">{{ __('Email') }}</label>
                                {{-- <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" placeholder="Masukan email"
                                    autofocus> --}}



                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="ti ti-mail"></i></span>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email" 
                                        autocomplete="email" placeholder="Email" aria-label="Email"
                                        value="{{ old('email') }}" aria-describedby="basic-addon1" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>



                            </div>


                            <div class="d-flex justify-content-between">
                                <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link text-decoration-none" href="{{ route('password.request') }}">
                                        <small> {{ __('Lupa Password?') }}</small>
                                    </a>
                                @endif
                            </div>


                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="ti ti-lock"></i></span>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    autocomplete="current-password" placeholder="Password" aria-label="Password"
                                    aria-describedby="basic-addon1">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <div class="">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group my-2">
                                        <strong> </strong>
                                        {!! htmlFormSnippet() !!}
                                    
                                    </div> 

                            <div class="row mb-0">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        {{ __('Login') }}
                                    </button>


                                </div>
                            </div>
                            <p class="text-center mt-5">
                                <span>Belum Punya Akun?</span>
                                <a href="{{ url('register') }}">
                                    <span>Daftar Akun Baru</span>
                                </a>
                            </p>
                        </form>

                        {{-- <div class="divider my-4">
                        <div class="divider-text">or</div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <a type="button" class="btn rounded-pill btn-label-pinterest"> <i class='bx bxl-google'></i>
                            Register With Google </a>

                    </div> --}}
                    </div>



                </div>
            </div>
        </div>


    </div>
@endsection
