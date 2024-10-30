@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="card shadow-sm border-0">
                <div class="card-body row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="ps-3 textmuted fw-bold h6 mb-0">Total Payment</p>
                                <p class="h1 fw-bold d-flex"> <span
                                        class="textmuted pe-1 h6 align-text-top mt-1">Rp.</span>{{ number_format($order->amount) }}
                                </p>
                                @if ($order->payment_status == 0)
                                    <span class="badge bg-danger">Pending</span>
                                @elseif($order->payment_status == 2)
                                    <span class="badge bg-warning">Proses</span>
                                @else
                                    <span class="badge bg-success">Selesai</span>
                                @endif

                                <div class="mt-3">
                                    @if ($order->payment_status == 0)
                                    @elseif($order->payment_status == 2)
                                        <form action="{{ url('admin/orders/confirmation/' . $order->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="payment_status" value="1">
                                            <input type="hidden" name="status" value="1">
                                            <button type="submit" class="btn btn-primary">Konfirmasi</button>
                                        </form>
                                    @else
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-5">
                                @if ($order->payment_status == 0)
                                    <div class="alert alert-danger"> Belum ada Bukti Pembayaran</div>
                                @elseif($order->payment_status == 2)
                                    <img class="img-fluid" src="{{ $order->receipt }}">
                                @else
                                    <img class="img-fluid" src="{{ $order->receipt }}">
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p class="p-blue"> <span class="fas fa-circle pe-2"></span>Nomor Invoice </p>
                        <p class="fw-bold mb-3">#{{ $order->invoice_no }}</p>
                        Tanggal Order : <span class="text-danger">{{ date('d M Y', strtotime($order->created_at)) }}</span>

                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Ads</th>
                                <th scope="col">Expired</th>
                                <th scope="col">Payment</th>
                                <th scope="col">Status</th>
                                <th width="20%" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>{{ $order->package_name }}</th>
                                <td>Rp. {{ number_format($order->amount) }}</td>
                                <td>{{ $order->count }}</td>
                                <td>{{ $order->expired_at }}</td>
                                <td>
                                    @if ($order->payment_status == 0)
                                        <span class="badge bg-light-danger text-danger">Unpaid</span>
                                    @elseif($order->payment_status == 1)
                                        <span class="badge bg-light-success text-success">Paid</span>
                                    @else
                                        <span class="badge bg-light-warning text-warning">Process</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($order->status == 0)
                                        <span class="badge bg-light-danger text-danger">Inactive</span>
                                    @else
                                        <span class="badge bg-light-success text-success">Active</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('payment/' . $order->uuid) }}" class="btn btn-success btn-sm">Bayar</a>
                                    <a href="" class="btn btn-danger btn-sm">Cancel</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
