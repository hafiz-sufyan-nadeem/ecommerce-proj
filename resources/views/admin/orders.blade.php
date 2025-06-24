@extends('admin.layouts.main')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Orders List</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Payment Method</th>
                            <th>Total Price</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->name }} {{ $order->last_name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->payment_method }}</td>
                                <td>PKR {{ number_format($order->total_price) }}</td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No orders found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
