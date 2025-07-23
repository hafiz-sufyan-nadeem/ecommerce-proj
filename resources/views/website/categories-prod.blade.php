@extends('admin.layouts.frontend')

@section('content')
    <h2>Products in {{ $category->name }}</h2>

    @foreach ($products as $product)
        <div class="product-box">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->description }}</p>
            <strong>Price: {{ $product->price }}</strong>


            <figure>
                <a href="{{ route('product.detail', $product->id) }}" style="text-decoration: none;">
                    <img src="{{ asset('admin-images/products/' . $product->image) }}" alt="{{ $product->name }}" style="width: 210px" height="210px">
                    <h5>{{ $product->name }}</h5>
                </a>
            </figure>
        </div>
    @endforeach
@endsection
