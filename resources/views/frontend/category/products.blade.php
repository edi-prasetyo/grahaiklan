@extends('layouts.app')

@section('title')
{{$category->meta_title}}
@endsection
@section('meta_keyword')
{{$category->meta_keyword}}
@endsection
@section('meta_description')
{{$category->meta_description}}
@endsection
@section('image')
{{asset($category->image)}}
@endsection
@include('layouts.inc.frontend.header')
@section('content')

<div class="container mb-5">
    @if(session('success'))
    <div class="col-md-12">
        <div class="alert alert-success d-flex justify-content-between align-items-start">
            {{session('success')}}
            <a href="{{url('cart')}}" class="btn btn-success">View Cart</a>
        </div>
    </div>
    @endif
    <h4 class="mb-3">Category {{$category->name}}</h4>
    <div class="row">
        @forelse($products as $item)
        <div class="col-md-3">
            <div class="card text-muted">
                <div class="card-img-cover">
                    <div class="card-img-frame">
                        <img src="{{asset($item->image_cover)}}" class="card-img-top" alt="{{$item->name}}">
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$item->name}}</h5>
                    <h5>IDR {{number_format($item->price,0)}}</h5>
                </div>
                <div class="card-footer bg-transparent d-flex justify-content-between align-items-center">
                    <a href="{{url('item/'.$item->slug)}}" class="btn btn-outline-primary">detail</a>
                    <a href="{{ url('add-to-cart/'.$item->id) }}" class="btn btn-outline-success text-center"
                        role="button"> <i class='bx bx-shopping-bag'></i> Add to cart</a>
                </div>
            </div>
        </div>
        @empty
        <div class="h-100">
            <div class="col-md-8 mx-auto my-auto">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="my-auto">No Products Available</div>
                    </div>
                </div>
            </div>
        </div>
        @endforelse
    </div>
</div>

@endsection