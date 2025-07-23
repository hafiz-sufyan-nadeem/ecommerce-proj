@extends('admin.layouts.frontend')

@section('content')
    <h1>All Categories</h1>
    <div class="categories-list">
        @foreach ($categories as $category)
            <div class="category-box">
                <h3>{{ $category->name }}</h3>
                <a href="{{ route('category.products', $category->id) }}">View Products</a>
            </div>
        @endforeach
    </div>
@endsection
