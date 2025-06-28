@extends('admin.layouts.frontend')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif



    <h2>{{ $product->name }}</h2>
    <p>Price: PKR {{ number_format($product->price) }}</p>
    <p>Category: {{ $product->category->name ?? 'N/A' }}</p>

    <img src="{{ asset('admin-images/products/' . $product->image) }}" alt="{{ $product->name }}" width="200">

    <hr>

    <h4>Customer Reviews:</h4>

    @forelse ($product->reviews as $review)
        <div style="border: 1px solid #ddd; padding: 10px; margin-bottom: 10px;">
            <strong>{{ $review->user->name ?? 'Unknown User' }}</strong>
            <span>rated {{ $review->rating }}/5</span>
            <p>{{ $review->review }}</p>
        </div>
    @empty
        <p>No reviews yet.</p>
    @endforelse

    @if(auth()->check())
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal">
            Submit a Review
        </button>

        <!-- Review Modal -->
        <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
            <div class="modal-dialog">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('reviews.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="reviewModalLabel">Submit Your Review</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="review" class="form-label">Your Review</label>
                                <textarea class="form-control" name="review" id="review" rows="3" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label d-block">Rating</label>
                                @for ($i = 1; $i <= 5; $i++)
                                    <input type="radio" class="btn-check" name="rating" id="star{{ $i }}" value="{{ $i }}" autocomplete="off" required>
                                    <label class="btn btn-outline-warning" for="star{{ $i }}">
                                        ★
                                    </label>
                                @endfor
                            </div>

                            @if (auth()->check() && auth()->id() === $review->user_id)
                                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="margin-top: 5px;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            @endif

                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Submit Review</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    @else
        <p class="text-danger mt-3">Please <a href="{{ route('login') }}">login</a> to leave a review.</p>
    @endif

@endsection
