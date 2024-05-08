@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="col-md-12">
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            </div>
        @endif
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-start">
                <h4 class="my-auto">Category</h4>
                <a href="{{ url('admin/category/create') }}" class="btn btn-success text-white">Add Category</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="5%">Icon</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Filter</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>
                                    @if ($category->image == null)
                                    @else
                                        <img class="img-fluid" src="{{ asset($category->image) }}">
                                    @endif

                                    {!! $category->icon !!}

                                </td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    @if ($category->status == 1)
                                        <span class="badge bg-light-success text-success">Active</span>
                                    @else
                                        <span class="badge bg-light-danger text-danger">Inactive</span>
                                    @endif
                                    {{-- {{$category->status == '1' ? 'active':'inactive'}} --}}
                                </td>
                                <td>
                                    <a href="{{ url('admin/category/subcategory/' . $category->id) }}"
                                        class="btn btn-primary btn-sm text-white">Add Subcategory</a>
                                </td>
                                <td>
                                    <a href="{{ url('admin/category/edit/' . $category->id) }}"
                                        class="btn btn-sm btn-primary text-white">Edit</a>
                                    @include('admin.category.delete')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="col-md-12 mt-5">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
