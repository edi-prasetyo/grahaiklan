@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header bg-white">
                    <h4>Create Field {{ $subcategory->name }}</h4>
                </div>
                <div class="card-body">

                    <form action="{{ url('admin/category/subcategory/field') }}" method="POST">
                        @csrf
                        <input type="hidden" name="category_id" value="{{ $subcategory->category_id }}">
                        <input type="hidden" name="subcategory_id" value="{{ $subcategory->id }}">


                        <div class="mb-3">
                            <input type="text" name="field_name" placeholder="name"
                                class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="mb-3">

                            <input type="text" name="field_value" placeholder="value"
                                class="form-control @error('value') is-invalid @enderror">
                            @error('value')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">

                            <input type="text" name="field_icon" placeholder="Icon"
                                class="form-control @error('icon') is-invalid @enderror">
                            @error('icon')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>

                    </form>
                </div>
            </div>
        </div>



        <div class="col-md-8">
            <div class="card">
                <table class="table">
                    <thead>
                        <tr>

                            <th scope="col">name</th>
                            <th scope="col">value</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fields as $data)
                            <tr>
                                <td>{{ $data->field_name }}</td>
                                <td>{{ $data->field_value }}</td>
                                <td>{{ $data->field_icon }}</td>
                                <td>
                                    <a href="{{ url('admin/category/edit-subcategory/' . $data->id) }}"
                                        class="btn btn-primary btn-sm text-white"><i class="fa fa-edit"></i> </a>
                                    <a href="{{ url('admin/category/delete-subcategory/' . $data->id) }}"
                                        class="btn btn-danger btn-sm text-white"><i class="fa fa-trash"></i> </a>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
