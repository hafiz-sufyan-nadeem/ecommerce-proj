@extends('admin.layouts.frontend')

@section('content')
    <h1>All Categories</h1>
    <div class="categories-list" class="row" style="display: flex; flex-wrap: wrap; gap: 25px;">
        @foreach ($categories as $category)
            <div class="category-box">
                <h3 style="color: #e74a3b">{{ $category->name }}</h3>
                <a href="{{ route('category.products', $category->id) }}" class="btn btn-primary">View Products</a>
            </div>
        @endforeach
    </div>
@endsection
