@extends('admin.layouts.frontend')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">All Featured Products</h2>

        <div class="row">
            @forelse ($products as $product)
                <div class="col">
                    <div class="product-item">
                        <figure>
                            <a href="{{ route('product.detail', $product->id) }}" style="text-decoration: none;">
                                <img src="{{ asset('admin-images/products/' . $product->image) }}" alt="{{ $product->name }}" style="width: 210px" height="210px">
                                <h5>{{ $product->name }}</h5>
                            </a>
                        </figure>
                        <div class="d-flex flex-column text-center">
                            <h3 class="fs-6 fw-normal">{{$product->name}}</h3>
                            <div>
                                          <span class="rating">
                                            @if($product->reviews_count > 0)
                                                  @php $avg = round($product->reviews_avg_rating); @endphp
                                                  @for($i = 1; $i <= 5; $i++)
                                                      @if($i <= $avg)
                                                          <span style="color: gold;">★</span>
                                                      @else
                                                          <span style="color: lightgray;">★</span>
                                                      @endif
                                                  @endfor
                                                  <small>({{ $product->reviews_count }} reviews)</small>
                                              @else
                                                  <small>No reviews yet</small>
                                              @endif

                                          </span>
                            </div>
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <span class="text-dark fw-semibold">Rs {{$product->price}}</span>
                            </div>
                            <div class="button-area p-3 pt-0">
                                <div class="row g-1 mt-2 products_meta align-items-center">
                                    {{-- quantity input --}}
                                    <div class="col-3">
                                        <input  type="number"
                                                name="quantity"
                                                class="form-control border-dark-subtle input-number quantity selected_quantity"
                                                value="1"
                                                min="1">
                                    </div>

                                    {{-- add‑to‑cart & heart in ONE flex box --}}
                                    <div class="col-9 d-flex justify-content-between gap-2">
                                        {{-- ADD TO CART --}}
                                        @auth
                                            <a  data-productId="{{ $product->id }}"
                                                class="btn btn-primary rounded-1 p-2 fs-7 add_cart">
                                                <svg width="18" height="18"><use xlink:href="#cart"></use></svg>
                                                Add to Cart
                                            </a>
                                        @else
                                            <a href="{{ route('login') }}"
                                               class="btn btn-primary rounded-1 p-2 fs-7">
                                                Login
                                            </a>
                                        @endauth

                                        {{-- HEART / WISHLIST --}}
                                        @auth
                                            <form method="POST" action="{{ route('wishlist.store') }}">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit"
                                                        class="btn btn-outline-dark rounded-1 p-2 fs-6 d-flex align-items-center">
                                                    <svg width="18" height="18"><use xlink:href="#heart"></use></svg>
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}"
                                               class="btn btn-outline-dark rounded-1 p-2 fs-6 d-flex align-items-center">
                                                <svg width="18" height="18"><use xlink:href="#heart"></use></svg>
                                            </a>
                                        @endauth
                                    </div>

        <div class="mt-4">
            {{ $products->links() }} {{-- pagination --}}
        </div>
    </div>
@endsection
