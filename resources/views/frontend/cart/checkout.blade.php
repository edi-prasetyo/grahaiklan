@extends('layouts.app')
@section('title', 'Cart')
@include('layouts.inc.frontend.header')
@section('content')

<div class="container">


    <div class="row">
        <div class="col-md-8">
            <!-- Offer alert -->

            <ul class="list-group mb-3">
                @php $total = 0 @endphp
                @if(session('cart'))
                @foreach(session('cart') as $id => $details)
                @php $total += $details['price'] @endphp
                <li class="list-group-item p-4">
                    <div class="d-flex gap-3">
                        <div class="flex-shrink-0">
                            <img src="{{$details['photo']}}" alt="google home" class="img-fluid" width="90px"
                                style="width: 90px">
                        </div>
                        <div class="flex-grow-1">
                            <div class="row">
                                <div class="col-md-8">
                                    <h3 class="me-3">{{
                                        $details['name']
                                        }}</h3>
                                    <div class="text-muted mb-1 d-flex flex-wrap">

                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="text-md-end">
                                        {{-- <button type="button" class="btn-close btn-pinned"
                                            aria-label="Close"></button> --}}
                                        <div class="my-2 my-md-4"><span class="text-primary">
                                                IDR {{ number_format($details['price']) }}


                                            </span>
                                            {{-- <s class="text-muted">$359</s> --}}
                                        </div>
                                        {{-- <button type="button" class="btn btn-sm btn-label-secondary">Move
                                            to
                                            wishlist</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
                @endif

            </ul>
        </div>
        <div class="col-md-4">



            <div class="border rounded p-3 mb-3 bg-white">
                <!-- Offer -->
                <h6>Detail Pembayaran</h6>
                <hr class="mx-n3">

                <!-- Price Details -->
                <dl class="row mb-0">

                    <dt class="col-6 fw-normal">Order Total</dt>
                    <dd class="col-6 text-end">Rp. {{ number_format($total) }}</dd>

                    <hr>

                    <dt class="col-6">Tagihan</dt>
                    <dd class="col-6 fw-semibold text-end mb-0">Rp. {{ number_format($total) }}</dd>
                </dl>
            </div>



            <form action="{{url('orders')}}" method="POST">
                @csrf
                <input type="hidden" name="customer_name" value="{{ Auth::user()->name }}">
                <input type="hidden" name="customer_email" value="{{ Auth::user()->email }}">
                <input type="hidden" name="customer_whatsapp" value="{{ Auth::user()->whatsapp }}">
                <input type="hidden" name="discount" value="0">
                <input type="hidden" name="amount" value="{{$total}}">
                <input type="hidden" name="payment_type" value="transfer">
                <input type="hidden" name="payment_status" value="0">
                <input type="hidden" name="status" value="0">

                <div class="d-grid gap-2 mx-auto">
                    <button type="submit" class="btn btn-primary">Proses Order</button>
                </div>

            </form>



        </div>

    </div>
</div>


@endsection