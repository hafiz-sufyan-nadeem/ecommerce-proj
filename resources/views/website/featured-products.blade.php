@extends('admin.layouts.frontend')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">All Featured Products</h2>

        <div class="row">
            @forelse ($products as $product)
                <div class="card border-0 shadow-sm h-100 d-flex flex-column">
                    {{-- product image --}}
                    <a href="{{ route('product.detail', $product->id) }}" class="text-decoration-none">
                        <img src="{{ asset('admin-images/products/' . $product->image) }}"
                             class="card-img-top" alt="{{ $product->name }}"
                             style="height: 210px; object-fit: cover;">
                    </a>

                    <div class="card-body d-flex flex-column text-center">
                        {{-- product name --}}
                        <h5 class="card-title mb-2">{{ $product->name }}</h5>

                        {{-- rating stars --}}
                        <div class="mb-1">
                            @if($product->reviews_count > 0)
                                @php $avg = round($product->reviews_avg_rating); @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    <span style="color: {{ $i <= $avg ? 'gold' : 'lightgray' }}">★</span>
                                @endfor
                                <small>({{ $product->reviews_count }})</small>
                            @else
                                <small>No reviews yet</small>
                            @endif
                        </div>

                        {{-- price --}}
                        <span class="fw-semibold mb-2">Rs {{ number_format($product->price) }}</span>

                        {{-- qty + buttons --}}
                        <div class="mt-auto">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <input type="number" class="form-control form-control-sm w-50"
                                       name="quantity" min="1" value="1">
                            </div>

                            <div class="d-flex justify-content-between gap-2">
                                {{-- add to cart --}}
                                @auth
                                    <a  data-productId="{{ $product->id }}"
                                        class="btn btn-primary flex-grow-1 add_cart">
                                        <svg width="18" height="18"><use xlink:href="#cart"></use></svg>
                                        Add to Cart
                                    </a>
                                @else
                                    <a href="{{ route('login') }}"
                                       class="btn btn-primary flex-grow-1">Login</a>
                                @endauth

                                {{-- heart / wishlist --}}
                                @auth
                                    <form method="POST" action="{{ route('wishlist.store') }}">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="btn btn-outline-dark">
                                            <svg width="18" height="18"><use xlink:href="#heart"></use></svg>
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-outline-dark">
                                        <svg width="18" height="18"><use xlink:href="#heart"></use></svg>
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>

            @empty
                <p>No featured products found.</p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $products->links() }} {{-- pagination --}}
        </div>
    </div>
@endsection
