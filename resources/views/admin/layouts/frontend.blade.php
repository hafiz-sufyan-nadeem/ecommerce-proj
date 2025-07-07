<!-- resources/views/layouts/frontend.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <svg style="display: none;">
        <symbol id="heart" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5
                 2 5.42 4.42 3 7.5 3c1.74 0 3.41 0.81 4.5 2.09
                 C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42
                 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
        </symbol>
    </svg>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">MyShop</a>
    </div>

{{--    <a href="{{ route('home') }}" class="btn btn-secondary mb-0" style="background: rgba(0,0,0,0.8)">--}}
{{--        ← Back to Home--}}
{{--    </a>--}}
    <button {{route('home')}} style="background:  rgba(0,0,0,0.8)" class="btn btn-secondary">🏠︎Back</button>
</nav>

<div class="container">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
