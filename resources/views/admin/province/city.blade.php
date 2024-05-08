@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-white">
                    <h4>Create City In {{ $province->name }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form action="{{ url('admin/provinces/city') }}" method="POST">
                            @csrf
                            <input type="hidden" name="province_id" value="{{ $province->id }}">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" required>

                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <label class="form-check-label">Status</label>
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckDefault" name="status">
                                </div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            @if (session('message'))
                <div class="col-md-12">
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                </div>
            @endif
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-start">
                    <h4 class="my-auto">City</h4>

                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th width="20%">Slug</th>
                                <th width="20%">Status</th>

                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cities as $city)
                                <tr>
                                    <td>{{ $city->name }}</td>
                                    <td>{{ $city->slug }}</td>
                                    <td>
                                        @if ($city->status == 1)
                                            <span class="badge bg-light-success text-success">Active</span>
                                        @else
                                            <span class="badge bg-light-danger text-danger">Inactive</span>
                                        @endif

                                    </td>

                                    <td>
                                        <a href="{{ url('admin/provinces/city/delete/' . $city->id) }}"
                                            class="btn btn-sm btn-danger text-white">Delete</a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="col-md-12 mt-5">
                {{ $cities->links() }}
            </div>
        </div>
    </div>
@endsection
