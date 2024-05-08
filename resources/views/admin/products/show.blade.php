@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    @if(session('message'))
    <div class="alert alert-danger">{{session('message')}}</div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <form action="{{url('admin/products/add_website')}}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->id}}">

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="text" class="form-control" name="price">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-white">
                    Website
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($websites as $key => $web)
                        <tr>
                            <td>{{$web->name}}</td>
                            <td>{{number_format($web->price)}}</td>
                            <td>
                                <a href="#" class="text-success"><i class="feather-edit mr-3  fa-fw"></i></a>
                                <a href="{{url('admin/products/delete_website/' .$web->id)}}" class="text-danger"><i
                                        class="feather-trash mr-3  fa-fw"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection