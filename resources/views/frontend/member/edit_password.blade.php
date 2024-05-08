@extends('layouts.app')
@section('content')
@include('layouts.inc.frontend.header')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('frontend.member.sidebar')
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">

                    <form action="{{url('member/update_password')}}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group mb-2">
                            <label for="password" class="col-form-label text-md-end">{{ __('Ubah Password')
                                }}</label>

                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="row mb-0">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class='bx bx-lock'></i> Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection