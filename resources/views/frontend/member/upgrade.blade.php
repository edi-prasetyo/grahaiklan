@extends('layouts.app')
@section('content')
@include('layouts.inc.frontend.header')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('frontend.member.sidebar')
        </div>

        <div class="col-md-9">
            @if ($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif
            <div class="card mb-5">
                <div class="card-body">
                    <form action="{{url('member/upgrade-store')}}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-3">
                                <div id="avatarPreview" src=""
                                    class="border text-center mb-3 fs-3 rounded-circle d-flex aligns-items-center justify-content-center"
                                    alt="placeholder image goes here">

                                    <i class='bx bx-image py-auto'></i>

                                </div><br>
                                <label class="form-label">Upload Foto</label>
                                <input style="display: none" id="uploadFile" type="file" name="avatar"
                                    class="form-control">
                            </div>
                            <div class="col-md-8 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nama Merchant</label>
                                    <input type="text" name="merchant_name"
                                        class="form-control @error('merchant_name') is-invalid @enderror">
                                    @error('merchant_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alamat Merchant</label>
                                    <textarea type="text" name="merchant_address"
                                        class="form-control @error('merchant_address') is-invalid @enderror"></textarea>
                                    @error('merchant_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="divider text-start my-2">
                                <div class="divider-text fs-5 my-3">Info Pembayaran</div>
                            </div>
                            <small class="mb-3">Info pembayaran digunakan untuk pembayaran kepada pihak penjual setelah
                                mencapai
                                ambang batas pembayaran</small>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nama Bank</label>
                                    <input type="text" name="bank_name"
                                        class="form-control @error('bank_name') is-invalid @enderror">
                                    @error('bank_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nomor Rekening</label>
                                    <input type="text" name="bank_number"
                                        class="form-control @error('bank_number') is-invalid @enderror">
                                    @error('bank_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Atas Nama</label>
                                    <input type="text" name="bank_account"
                                        class="form-control @error('bank_account') is-invalid @enderror">
                                    @error('bank_account')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection

    @section('scripts')
    <script>
        // Upload File
    
    $(function() {
        $("#uploadFile").on("change", function()
        {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
    
            if (/^image/.test( files[0].type)){ // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file
    
                reader.onloadend = function(){ // set image data as background of div
                    $("#avatarPreview").css("background-image", "url("+this.result+")");
                }
            }
        });
    });
    
    $('#avatarPreview').click(function(){
      $('#uploadFile').click();
    });
    
    // End Upload File
    </script>
    @endsection