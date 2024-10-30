@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="row my-5">

                    @foreach ($categories as $category)
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-header fw-bold d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="icon-bg-circle">
                                            <img src="{{ $category->image_url }}" alt=""
                                                class="avatar bg-light rounded" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">{{ $category->name }}</h6>
                                    </div>
                                </div>
                                <ul class="list-group list-group-flush">

                                    @foreach (App\Models\Subcategory::where('category_id', $category->id)->get() as $sub)
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="fw-bold"><a
                                                    href="{{ url('category/' . $category->slug . '/' . $sub->slug) }}">
                                                    {{ $sub->name }}</a></div>
                                            <span
                                                class="badge text-bg-primary rounded-pill">{{ $sub->advertisements->count() }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection
