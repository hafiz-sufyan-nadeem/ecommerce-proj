@extends('admin.layouts.frontend')

@section('content')
    <div class="container py-4">
        <h4 class="mb-4">Search Results for: "{{ $search }}"</h4>

        @if($products->count())
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="product-item border-0 shadow-sm p-2 h-100 d-flex flex-column">
                            <a href="{{ route('product.detail', $product->id) }}" class="text-decoration-none">
                                <img src="{{ asset('admin-images/products/' . $product->image) }}"
                                     class="w-100" style="height:210px; object-fit:cover;">
                            </a>
                            <div class="text-center mt-2 flex-grow-1 d-flex flex-column">
                                <h5 class="mb-1">{{ $product->name }}</h5>

                                 Rating
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

                                 Price
                                <span class="fw-semibold mb-2">Rs {{ number_format($product->price) }}</span>

                                 Cart + Wishlist
                                <div class="button-area mt-auto">
                                    <div class="row g-1 align-items-center">
                                        <div class="col-4">
                                            <input type="number" name="quantity" min="1" value="1" class="form-control form-control-sm text-center">
                                        </div>
                                        <div class="col-8 d-flex justify-content-between gap-1">
                                             Cart
                                            @auth
                                                <form method="POST" action="{{ route('add.to.cart') }}">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center justify-content-center gap-1">
                                                        <svg width="16" height="16"><use xlink:href="#cart"></use></svg>
                                                        Add to Cart
                                                    </button>
                                                </form>
                                            @else
                                                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
                                            @endauth

                                             Wishlist
                                            @auth
                                                <form method="POST" action="{{ route('wishlist.store') }}">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <button type="submit" class="btn btn-outline-dark btn-sm d-flex align-items-center justify-content-center">
                                                        <svg width="16" height="16"><use xlink:href="#heart"></use></svg>
                                                    </button>
                                                </form>
                                            @else
                                                <a href="{{ route('login') }}" class="btn btn-outline-dark btn-sm d-flex align-items-center justify-content-center">
                                                    <svg width="16" height="16"><use xlink:href="#heart"></use></svg>
                                                </a>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $products->links() }}
            </div>
        @else
            <div class="alert alert-warning">No products found matching your search.</div>
        @endif
    </div>
@endsection
