@extends('layouts.app')
@section('content')
    @include('layouts.inc.frontend.header')

    <div class="container">

        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    @foreach ($ads as $data)
                        <div class="col-md-4">

                            <div class="card mb-3 shadow-sm">
                                <div class="card-img-cover">
                                    <div class="card-img-frame">
                                        <img src="{{ $data->images[0]->image_url }}" class="card-img-top img-fluid"
                                            alt="{{ $data->title }}">
                                        <div class="tag badge text-bg-success"><i class="ti ti-tag"></i>
                                            {{ $data->category_name }}</div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <h5 class="card-title archive-title"><a class="text-muted text-decoration-none"
                                            href="{{ url('detail/' . $data->slug) }}">
                                            {{ $data->title }} </a></h5>

                                    <h4 class="text-success">




                                        @php
                                            $n = $data->price;
                                            $presisi = 1;
                                            if ($n < 900) {
                                                $format_angka = number_format($n, $presisi);
                                                $simbol = '';
                                            } elseif ($n < 900000) {
                                                $format_angka = number_format($n / 1000, $presisi);
                                                $simbol = 'rb';
                                            } elseif ($n < 900000000) {
                                                $format_angka = number_format($n / 1000000, $presisi);
                                                $simbol = 'jt';
                                            } elseif ($n < 900000000000) {
                                                $format_angka = number_format($n / 1000000000, $presisi);
                                                $simbol = 'M';
                                            } else {
                                                $format_angka = number_format($n / 1000000000000, $presisi);
                                                $simbol = 'T';
                                            }

                                            if ($presisi > 0) {
                                                $pisah = '.' . str_repeat('0', $presisi);
                                                $format_angka = str_replace($pisah, '', $format_angka);
                                            }
                                        @endphp








                                        Rp. {{ $format_angka . ' ' . $simbol }}</h4>


                                    <div class="row">
                                        @foreach (App\Models\AdditionalField::where('advertisement_id', $data->id)->take(2)->get() as $field)
                                            <div class="col-md-6">
                                                {!! $field->field_icon !!} {!! $field->field_value !!}
                                            </div>
                                        @endforeach
                                    </div>


                                </div>
                                <div class="card-footer">
                                    <span class="me-3"><i class="ti ti-map-pin"></i> {{ $data->city_name }} -
                                        {{ $data->province_name }}
                                    </span>
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
