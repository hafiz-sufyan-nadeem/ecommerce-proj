@extends('admin.layouts.main')

@section('content')
    <div class="container py-4">
        <h3>My Orders</h3>

        @forelse($orders as $order)
            <div class="card mb-4">
                <div class="card-body">
                    <h5>Order #{{ $order->id }}</h5>
                    <p><strong>Total:</strong> PKR {{ number_format($order->total_price) }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($order->status ?? 'pending') }}</p>
                    <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>

                    <h6>Items:</h6>
                    @php $items = json_decode($order->cart_items, true); @endphp
                    <ul>
                        @foreach($items as $item)
                            <li>{{ $item['product_name'] }} (x{{ $item['quantity'] }}) — PKR {{ number_format($item['total']) }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @empty
            <p>You have no orders yet.</p>
        @endforelse
    </div>
@endsection
