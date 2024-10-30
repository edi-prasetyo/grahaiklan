@extends('layouts.app')
@section('content')
    <div class="container my-3 mb-5">
        <div class="row">
            <div class="col-md-12">

                <!-- /User Card -->
                <div class="col-md-10 mx-auto">

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

                    <div class="card my-3">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-9 d-flex align-items-start">
                                    <div class="text-center me-3">
                                        @if ($user_detail->photo_url == null)
                                            <img src="{{ asset('uploads/logo/avatar.jpg') }}"
                                                class="img-fluid avatar-xl rounded-circle" alt="">
                                        @else
                                            <img src="{{ $user_detail->photo_url }}"
                                                class="img-fluid avatar-xl rounded-circle" alt="">
                                        @endif
                                    </div>
                                    <div>

                                        <h4 class="text-muted font-size-20 mt-3 mb-2">{{ $user_detail->fullname }}</h4>

                                        <p class="text-muted mb-2 fw-medium"><i class="ti ti-mail"></i>
                                            {{ $user->email }}
                                        </p>
                                    </div>



                                </div><!-- end col -->

                                <div class="col-md-3">
                                    <div class="text-center text-sm-right">
                                        <img style="width:60%" src="{{ $user_detail->logo_url }}" class=""
                                            alt="">
                                        <div class="text-muted"><small>Joined
                                                {{ date('d M Y', strtotime($user->created_at)) }}</small>
                                        </div>
                                        <a class="btn btn-primary" href="{{ url('profile') }}">
                                            <i class="ti ti-edit"></i>
                                            <span>Edit Profile</span>
                                        </a>
                                    </div>
                                </div>
                            </div><!-- end row -->
                        </div><!-- end card body -->
                    </div><!-- end card -->


                    {{-- <div class="alert alert-success my-3">
                        <h3> Selamat Datang <b>{{ Auth::user()->name }}</b></h3>
                        <p>ini Adalah halaman akun anda, anda dapat mengatur profile serta foto anda di sini</p>
                    </div> --}}

                    <div class="row mb-3">

                        <div class="col-sm-6 col-lg-4">
                            <a class="text-decoration-none" href="{{ url('my-ads') }}">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="bg-primary text-white avatar rounded p-3"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                                    <i class="ti ti-bolt fs-3"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{ count($ads) }} Iklan
                                                </div>
                                                <div class="text-secondary">
                                                    <small> Pasang Iklan</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <a class="text-decoration-none" href="{{ url('packages') }}">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="bg-success text-white avatar rounded p-3"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                                    <i class="ti ti-crown fs-3"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{ $premium_ads }} Paket Iklan
                                                </div>
                                                <div class="text-secondary">
                                                    <small> Paket Iklan Premium</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>





                    {{-- <div class="card">
                        <div class="card-header">
                            Iklan Saya
                        </div>

                        <table class="table">
                            <thead>
                                <tr>

                                    <th scope="col">Judul</th>
                                    <th scope="col">Dilihat</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ads as $item)
                                    <tr>

                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->views }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></a>
                                            <a href="{{ url('detail/' . $item->slug) }}" target="blank"
                                                class="btn btn-sm btn-primary"><i class="ti ti-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div> --}}



                </div>
            </div>


            {{-- <div class="col-md-4 col-12">
                <div class="card">
                    <div class="card-header">
                        Ubah Password
                    </div>
                    <div class="card-body">
                        <form action="{{ url('member/update_password') }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group mb-2">
                                <label for="password" class="col-form-label text-md-end">{{ __('Ubah Password') }}</label>

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
            </div> --}}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Dependence Dropdown for Applicant
        $('#country-dropdown').on('change', function() {
            var idProvince = this.value;
            $("#state-dropdown").html('');
            $.ajax({
                url: "{{ url('member/fetch-city') }}",
                type: "POST",
                data: {
                    province_id: idProvince,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#state-dropdown').html('<option value="">-- Pilih Kota --</option>');
                    $.each(result.cities, function(key, value) {
                        $("#state-dropdown").append('<option value="' + value.id + '">' + value
                            .name + '</option>');
                    });
                }
            });
        });




        // Select2
        $('.single-select-field').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });

        // Datepicker
        $(function() {
            $('#datepicker').datepicker({
                format: 'yyyy-dd-mm',
            });
        });
    </script>
@endsection
