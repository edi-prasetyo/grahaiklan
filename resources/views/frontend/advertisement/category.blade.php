@extends('layouts.app')
@section('content')
    @include('layouts.inc.frontend.header')

    <div class="container">

        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    @foreach ($ads as $data)
                        <div class="col-md-4">

                            <div class="card mb-3">
                                <img src="{{ $data->image_url }}" class="card-img-top img-fluid" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="{{ url('item/' . $data->slug) }}">
                                            {{ $data->title }} </a></h5>
                                    <p class="card-text"><i class="ti ti-tag"></i> {{ $data->category_name }}</p>
                                    <span class="ms-4"> <i class="ti ti-chart-bar"></i> {{ $data->views }}
                                        dilihat</span>
                                    <span class="me-3"><i class="ti ti-map-pin"></i> {{ $data->province_name }} -
                                        {{ $data->city_name }} </span>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        @foreach (App\Models\AdditionalField::where('advertisement_id', $data->id)->take(2)->get() as $field)
                                            <div class="col-md-6">
                                                {!! $field->field_icon !!} : {!! $field->field_value !!}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

                <div class="col-md-12 mt-5">
                    {{ $ads->links() }}
                </div>

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Sidebar
                    </div>
                    <div class="card-body">
                        konten Sidebar
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
