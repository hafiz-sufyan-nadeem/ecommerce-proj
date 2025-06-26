{{-- resources/views/website/myorders.blade.php --}}

@extends('admin.layouts.frontend')

@section('content')
    <div class="container">
        <h2 class="mb-4">My Orders</h2>

        @forelse($orders as $order)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Order ID: {{ $order->id }}</h5>
                    <p class="card-text">
                        <strong>Total:</strong> PKR {{ number_format($order->total_price) }} <br>
                        <strong>Status:</strong> {{ ucfirst($order->status) }}
                    </p>

                    @php
                        $cartItems = json_decode($order->cart_items ?? '[]', true);
                    @endphp

                    <h6>Items:</h6>
                    <ul class="list-group mb-2">
                        @forelse($cartItems as $item)
                            <li class="list-group-item">
                                {{ $item['product_name'] ?? 'N/A' }} |
                                Qty: {{ $item['quantity'] }} |
                                Price: PKR {{ number_format($item['price']) }}
                            </li>
                        @empty
                            <li class="list-group-item text-danger">No items found in this order.</li>
                        @endforelse
                    </ul>

                    <small class="text-muted">Ordered On: {{ $order->created_at->format('d M Y h:i A') }}</small>
                </div>
            </div>
        @empty
            <p class="text-muted">No orders found.</p>
        @endforelse
    </div>
@endsection
