@extends('layouts.admin')

@section('content')
    @if (session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-white">
                <h4>Create Variant</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form action="{{ url('admin/variants/' . $variant->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $variant->name }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ganti Gambar</label>
                            <input type="file" name="image" class="form-control" required>
                            <img class="mt-3 img-fluid" src="{{ $variant->image_url }}">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
