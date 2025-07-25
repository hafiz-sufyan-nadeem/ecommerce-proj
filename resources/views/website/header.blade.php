<header>
    <div class="container-fluid">
        <!-- Add flex-nowrap to prevent wrapping -->
        <div class="row py-3 border-bottom d-flex flex-nowrap justify-content-between align-items-center">

            <!-- Logo & Toggler -->
            <div class="col-auto text-center text-sm-start d-flex gap-3 justify-content-center justify-content-md-start">
                <div class="d-flex align-items-center my-3 my-sm-0">
                    <a href="{{route('home')}}">
                        <img src="{{asset('assets/images/logo.svg')}}" alt="logo" class="img-fluid">
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                        aria-controls="offcanvasNavbar">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#menu"></use>
                    </svg>
                </button>
            </div>

            <!-- Search Bar -->
            <div class="col">
                <div class="search-bar row bg-light p-2 rounded-4">
                    <div class="col-md-4 d-none d-md-block">
                        <select class="form-select border-0 bg-transparent">
                            <option>All Categories</option>
                            <option>Groceries</option>
                            <option>Drinks</option>
                            <option>Chocolates</option>
                        </select>
                    </div>
                    <div class="col-11 col-md-7">
                        <form action="{{ route('search') }}" method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control me-2" placeholder="Search products..." required>
                            <button type="submit" class="btn btn-outline-primary">Search</button>
                        </form>
                    </div>
                    <div class="col-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Navbar Links -->
            <div class="col-auto">
                <ul class="navbar-nav list-unstyled d-flex flex-row gap-3 justify-content-end align-items-center mb-0 fw-bold text-uppercase text-dark">
                    <li class="nav-item active">
                        <a href="{{ route('user.orders') }}" class="nav-link">My Orders</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle pe-3" role="button" id="pages" data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
                        <ul class="dropdown-menu border-0 p-3 rounded-0 shadow" aria-labelledby="pages">
                            <li><a href="index.html" class="dropdown-item">About Us</a></li>
                            <li><a href="index.html" class="dropdown-item">Shop</a></li>
                            <li><a href="index.html" class="dropdown-item">Single Product</a></li>
                            <li><a href="index.html" class="dropdown-item">Cart</a></li>
                            <li><a href="index.html" class="dropdown-item">Checkout</a></li>
                            <li><a href="index.html" class="dropdown-item">Blog</a></li>
                            <li><a href="index.html" class="dropdown-item">Single Post</a></li>
                            <li><a href="index.html" class="dropdown-item">Styles</a></li>
                            <li><a href="index.html" class="dropdown-item">Contact</a></li>
                            <li><a href="index.html" class="dropdown-item">Thank You</a></li>
                            <li><a href="index.html" class="dropdown-item">My Account</a></li>
                            <li><a href="index.html" class="dropdown-item">404 Error</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <!-- User and Cart -->
            <div class="col-auto d-flex gap-3 align-items-center justify-content-end">
                <ul class="d-flex align-items-center list-unstyled m-0">
                    <li>
                        @auth
                            <div class="d-flex align-items-center">
                                <a href="{{ route('users.profile') }}" class="p-2 mx-1">
                                    <svg width="24" height="24"><use xlink:href="#user"></use></svg>
                                </a>
                                <a class="btn btn-primary ms-2" style="background: #e74a3b" href="{{route('logout')}}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        @else
                            <a href="{{url('login')}}">
                                <button type="button" class="btn btn-dark">Login</button>
                            </a>
                        @endauth
                    </li>

                    @auth
                        <li class="nav-item">
                            <a href="{{ route('wishlist.index') }}" class="p-2 mx-1 position-relative">
                                <svg width="24" height="24" fill="currentColor" class="bi bi-bookmark-heart">
                                    <use xlink:href="#heart"></use>
                                </svg>
                                {{-- count badge (optional) --}}
                                @php $count = \App\Models\Wishlist::where('user_id', auth()->id())->count(); @endphp
                                @if($count)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $count }}
                                    </span>
                                @endif
                            </a>
                        </li>
                    @endauth


                    @php
                        $cartCount = auth()->check()
                            ? \App\Models\CartItem::where('user_id', auth()->id())->sum('quantity')
                            : 0;
                    @endphp
                    <li>
                        <a href="#" class="p-2 mx-1 position-relative"
                           data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart"
                           aria-controls="offcanvasCart">
                            <svg width="24" height="24" class="text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 25 25">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                            </svg>
                            @if($cartCount)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</header>
