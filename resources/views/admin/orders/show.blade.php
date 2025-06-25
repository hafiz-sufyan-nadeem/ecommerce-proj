@extends('admin.layouts.main')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Order Details (ID: {{ $order->id }})</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <p><strong>Customer:</strong> {{ $order->name }} {{ $order->last_name }}</p>
                <p><strong>Email:</strong> {{ $order->email }}</p>
                <p><strong>Address:</strong> {{ $order->address }}</p>
                <p><strong>Country:</strong> {{ $order->country }}</p>
                <p><strong>Payment:</strong> {{ $order->payment_method }}</p>
                <p><strong>Total Price:</strong> PKR {{ number_format($order->total_price) }}</p>
                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                <p><strong>Placed On:</strong> {{ $order->created_at->format('d M Y h:i A') }}</p>
            </div>
        </div>

        <a href="{{ route('admin.orders') }}" class="btn btn-secondary">← Back to Orders</a>
    </div>
@endsection
