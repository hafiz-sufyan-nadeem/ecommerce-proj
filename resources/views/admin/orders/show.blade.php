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

                <h5 class="mt-4">Ordered Items:</h5>

                @php
                    $cartItems = json_decode($order->cart_items ?? '[]', true);
                @endphp

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($cartItems as $item)
                        <tr>
                            <td>{{ $item['product_name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>PKR {{ number_format($item['price']) }}</td>
                            <td>PKR {{ number_format($item['total']) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No items found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                <p><strong>Placed On:</strong> {{ $order->created_at->format('d M Y h:i A') }}</p>
            </div>
        </div>

        <a href="{{ route('admin.orders') }}" class="btn btn-secondary">← Back to Orders</a>
    </div>

    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <label>Rating (1-5):</label>
        <input type="number" name="rating" min="1" max="5" required>

        <label>Your Review:</label>
        <textarea name="review" required></textarea>

        <button type="submit">Submit Review</button>
    </form>

@endsection
