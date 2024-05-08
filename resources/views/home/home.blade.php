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

                    <div class="alert alert-success my-3">
                        <h3> Selamat Datang <b>{{ Auth::user()->name }}</b></h3>
                        <p>ini Adalah halaman akun anda, anda dapat mengatur profile serta foto anda di sini</p>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            Iklan Premium
                        </div>
                        <div class="card-body">
                            @foreach ($categories as $category)
                                <a href="{{ url('add-iklan/' . $category->slug) }}" class="btn btn-outline-secondary mb-2">
                                    {{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>

                    <a href="{{ url('create') }}" class="btn btn-lg btn-success my-3">Pasang Iklan Gratis</a>

                    <div class="card">
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

                    </div>



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
