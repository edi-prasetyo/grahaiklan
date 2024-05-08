@extends('layouts.app')

@section('content')
@include('layouts.inc.frontend.header')
<div class="col-md-12">
    @if (session('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>
    @endif
    <div class="container">

        <div class="row">
            <div class="col-md-3">
                @include('frontend.member.sidebar')
            </div>
            <div class="col-md-9">


                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-start">
                        <h6 class="my-auto">My Products</h6>
                        <a href="{{ url('member/products/create') }}" class="btn btn-success text-white">Add Product</a>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">status</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @php $i=1 @endphp
                                @forelse ($products as $product)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>
                                        @if($product->category)
                                        {{$product->category->name}}
                                        @else
                                        Uncategory
                                        @endif
                                    </td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>
                                        @if($product->status == 1)
                                        <span class="badge bg-light-success text-success">Active</span>
                                        @else
                                        <span class="badge bg-light-danger text-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{url('member/products/edit/' .$product->uuid)}}"
                                            class="btn btn-sm btn-primary text-white">Edit</a>
                                        <a href="{{url('admin/products/delete/' .$product->id)}}"
                                            class="btn btn-sm btn-danger text-white">Delete</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No Product Available </td>
                                </tr>
                                @endforelse


                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-12 my-3">
            {{$products->links()}}
        </div>
    </div>
</div>
@endsection