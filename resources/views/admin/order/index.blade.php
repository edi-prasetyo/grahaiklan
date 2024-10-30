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
                <h4 class="my-auto">Data Orders</h4>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">date</th>
                            <th scope="col">Invoice</th>
                            <th scope="col">Customer</th>
                            {{-- <th scope="col">Phone</th> --}}
                            <th scope="col">Expired </th>
                            <th scope="col">Payment</th>
                            <th scope="col">Amount</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $data)
                            <tr>
                                <td>{{ date('d M Y', strtotime($data->created_at)) }}</td>
                                <td>{{ $data->invoice_no }}</td>
                                <td>{{ $data->customer_name }}</td>
                                {{-- <td>{{ $data->customer_phone }}</td> --}}
                                <td>{{ date('d M Y', strtotime($data->expired_at)) }}</td>
                                <td>
                                    @if ($data->payment_status == 1)
                                        <i class="fa-solid fa-circle text-success" style="font-size: 7px;"></i> <span
                                            class="text-success">Paid</span>
                                    @elseif($data->payment_status == 2)
                                        <i class="fa-solid fa-circle text-danger my-auto" style="font-size: 7px;"></i> <span
                                            class="text-warning">Process</span>
                                    @else
                                        <i class="fa-solid fa-circle text-danger my-auto" style="font-size: 7px;"></i> <span
                                            class="text-danger">Unpaid</span>
                                    @endif
                                </td>

                                <td>{{ number_format($data->amount) }}</td>
                                <td>
                                    <a class="btn btn-success" href="{{ url('admin/orders/' . $data->id) }}"> View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="col-md-12 mt-5">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
