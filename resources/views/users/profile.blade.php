@extends('admin.layouts.frontend')
@section('content')
    <div class="container">
        <h2>Welcome, {{ $user->name }}</h2>
        <p>Email: {{ $user->email }}</p>
        <p>Country: {{ $user->country ?? 'Not set' }}</p>

        <a href="{{ route('user.orders') }}" class="btn btn-primary">My Orders</a>
    </div>
@endsection
