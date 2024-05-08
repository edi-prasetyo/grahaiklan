@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-white">
                    <h4>Create Variant</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form action="{{ url('admin/variants') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Logo</label>
                                <input type="file" name="image" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            @if (session('message'))
                <div class="col-md-12">
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                </div>
            @endif
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-start">
                    <h4 class="my-auto">Variant</h4>

                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th width="5%">image</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($variants as $data)
                                <tr>
                                    <td>{{ $data->name }}</td>
                                    <td><img class="img-fluid" src="{{ asset('uploads/logo/' . $data->image) }}"> </td>


                                    <td>
                                        <a href="{{ url('admin/variants/edit/' . $data->id) }}"
                                            class="btn btn-sm btn-primary text-white">Edit</a>
                                        <a href="{{ url('admin/variants/delete/' . $data->id) }}"
                                            class="btn btn-sm btn-danger text-white">Delete</a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="col-md-12 mt-5">
                {{ $variants->links() }}
            </div>
        </div>

    </div>
@endsection
