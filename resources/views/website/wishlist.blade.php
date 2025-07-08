@extends('admin.layouts.frontend')

@section('content')
    <div class="container">
        <h2 class="mb-4">My Wishlist</h2>

        @if(session('success'))  <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if(session('error'))    <div class="alert alert-danger">{{ session('error') }}</div>  @endif

        @forelse($wishlists as $wish)
            <div class="card mb-3 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        {{-- product thumbnail + name --}}
                        <strong>{{ $wish->product->name ?? 'Deleted Product' }}</strong>
                        <span class="text-muted"> – PKR {{ number_format($wish->product->price ?? 0) }}</span>
                    </div>

                    <form action="{{ route('wishlist.destroy', $wish->id) }}" method="POST" style="margin:0">
                        @csrf  @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-muted">No items in wishlist.</p>
        @endforelse
    </div>


@endsection
