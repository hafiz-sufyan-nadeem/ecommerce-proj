@extends('admin.layouts.frontend')

@section('content')

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="container py-4">
        <h2 class="mb-4">All Featured Products</h2>

        <div class="row">
            @forelse ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="product-item h-100 border-0 shadow-sm p-2 d-flex flex-column">
                        {{-- Image + link --}}
                        <a href="{{ route('product.detail', $product->id) }}" class="text-decoration-none">
                            <img src="{{ asset('admin-images/products/' . $product->image) }}"
                                 alt="{{ $product->name }}" class="w-100" style="height:210px;object-fit:cover;">
                        </a>

                        {{-- Content --}}
                        <div class="mt-2 text-center flex-grow-1 d-flex flex-column">
                            {{-- Name --}}
                            <h5 class="mb-1">{{ $product->name }}</h5>

                            {{-- Rating --}}
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

                            {{-- Price --}}
                            <span class="fw-semibold mb-2">Rs {{ number_format($product->price) }}</span>

                            {{-- Quantity + Buttons row (NO extra JS) --}}
                            <div class="button-area mt-auto">
                                <div class="row g-1 align-items-center">
                                    {{-- quantity field --}}
                                    <div class="col-4">
                                        <input type="number" min="1" value="1"
                                               class="form-control form-control-sm text-center">
                                    </div>

                                    {{-- cart + heart --}}
                                    <div class="col-8 d-flex justify-content-between gap-1">
                                        {{-- Add to Cart --}}
                                        @auth
                                            <a data-productId="{{ $product->id }}"
                                               class="btn btn-primary btn-sm flex-grow-1 add_cart d-flex align-items-center justify-content-center gap-1">
                                                <svg width="16" height="16"><use xlink:href="#cart"></use></svg>
                                                <span>Add to Cart</span>
                                            </a>
                                        @else
                                            <a href="{{ route('login') }}"
                                               class="btn btn-primary btn-sm flex-grow-1">Login</a>
                                        @endauth

                                        {{-- Wishlist --}}
                                        @auth
                                            <form method="POST" action="{{ route('wishlist.store') }}">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit"
                                                        class="btn btn-outline-dark btn-sm d-flex align-items-center justify-content-center">
                                                    <svg width="16" height="16"><use xlink:href="#heart"></use></svg>
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}"
                                               class="btn btn-outline-dark btn-sm d-flex align-items-center justify-content-center">
                                                <svg width="16" height="16"><use xlink:href="#heart"></use></svg>
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>No featured products found.</p>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
@endsection
