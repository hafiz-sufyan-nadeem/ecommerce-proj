@extends('admin.layouts.frontend')

@section('content')
    <h1>All Categories</h1>
    <div class="categories-list" class="row" style="display: flex; flex-wrap: wrap; gap: 25px;">
        @foreach ($categories as $category)
            <div class="category-box">
                <h3 style="color: #e74a3b">{{ $category->name }}</h3>

                <div class="col-md-6 text-center mb-2">
                <img src="{{asset('/admin-images/category/'. $category->image)}}" class="rounded-circle" alt="Category Thumbnail" style="width: 160px"; height="160px";u>
                 </div>

                <a href="{{ route('category.products', $category->id) }}" class="btn btn-primary">View Products</a>
            </div>
        @endforeach
    </div>
@endsection
