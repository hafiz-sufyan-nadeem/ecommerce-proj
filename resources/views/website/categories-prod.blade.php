@extends('admin.layouts.frontend')

@section('content')
    <h1>Products in {{ $category->name }}</h1>

    <div class="row" style="display: flex; flex-wrap: wrap; gap: 20px;">
        @forelse ($products as $product)
            <div class="card" style="width: 250px; border: 1px solid #ddd; padding: 15px; border-radius: 8px;">
                <h4>{{ $product->name }}</h4>

                <figure>
                    <a href="{{ route('product.detail', $product->id) }}" style="text-decoration: none;">
                        <img src="{{ asset('admin-images/products/' . $product->image) }}" alt="{{ $product->name }}" style="width: 210px" height="210px">
                        <h5>{{ $product->name }}</h5>
                    </a>
                </figure>
                <p>{{ $product->description }}</p>
                <p><strong>Price:</strong> Rs. {{ $product->price }}</p>
            </div>
        @empty
            <p>No products found in this category.</p>
        @endforelse
    </div>
@endsection
