<header>
    <div class="container-fluid">
        <div class="row py-3 border-bottom">

            <div class="col-sm-4 col-lg-2 text-center text-sm-start d-flex gap-3 justify-content-center justify-content-md-start">
                <div class="d-flex align-items-center my-3 my-sm-0">
                    <a href="index.html">
                        <img src="{{asset('assets/images/logo.svg')}}" alt="logo" class="img-fluid">
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                        aria-controls="offcanvasNavbar">
                    <svg width="24" height="24" viewBox="0 0 24 24"><use xlink:href="#menu"></use></svg>
                </button>
            </div>

            <div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-4">
                <div class="search-bar row bg-light p-2 rounded-4">
                    <div class="col-md-4 d-none d-md-block" style="flex:0.9">
                        <select class="form-select border- bg-transparent">
                            <option>All Categories</option>
                            <option>Groceries</option>
                            <option>Drinks</option>
                            <option>Chocolates</option>
                        </select>
                    </div>
                    <div class="col-11 col-md-7" style="flex: 3">
                        <form id="search-form" class="text-center" action="index.html" method="post">
                            <input type="text" class="form-control border-0 bg-transparent" placeholder="Search for more than 20,000 products">
                        </form>
                    </div>
                    <div class="col-1" style="flex: 0.3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z"/></svg>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <ul class="navbar-nav list-unstyled d-flex flex-row gap-3 gap-lg-5 justify-content-center flex-wrap align-items-center mb-0 fw-bold text-uppercase text-dark">
                    <li class="nav-item active">
                        <a href="index.html" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle pe-3" role="button" id="pages" data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
                        <ul class="dropdown-menu border-0 p-3 rounded-0 shadow" aria-labelledby="pages">
                            <li><a href="index.html" class="dropdown-item">About Us </a></li>
                            <li><a href="index.html" class="dropdown-item">Shop </a></li>
                            <li><a href="index.html" class="dropdown-item">Single Product </a></li>
                            <li><a href="index.html" class="dropdown-item">Cart </a></li>
                            <li><a href="index.html" class="dropdown-item">Checkout </a></li>
                            <li><a href="index.html" class="dropdown-item">Blog </a></li>
                            <li><a href="index.html" class="dropdown-item">Single Post </a></li>
                            <li><a href="index.html" class="dropdown-item">Styles </a></li>
                            <li><a href="index.html" class="dropdown-item">Contact </a></li>
                            <li><a href="index.html" class="dropdown-item">Thank You </a></li>
                            <li><a href="index.html" class="dropdown-item">My Account </a></li>
                            <li><a href="index.html" class="dropdown-item">404 Error </a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="col-sm-8 col-lg-2 d-flex gap-5 align-items-center justify-content-center justify-content-sm-end">
                <ul class="d-flex justify-content-end list-unstyled m-0">
                    <li>
                            @auth
                            <div class="d-flex align-items-center">
                            <a href="#" class="p-2 mx-1">
                                <svg width="24" height="24"><use xlink:href="#user"></use></svg>

                                <a class="btn btn-primary ms-2" style="background: #e74a3b" href="{{route('logout')}}" >
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400" ></i>
                                    Logout
                                </a>
                                @else
                                    <a href="{{url('login')}}">  <button type="button" class="btn btn-dark">Login</button> </a>
                            </a>
                           </div>
                        @endauth
                    </li>

                    <li>
                        <a href="#" class="p-2 mx-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bookmark-heart" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8 4.41c1.387-1.425 4.854 1.07 0 4.277C3.146 5.48 6.613 2.986 8 4.412z"/>
                                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="p-2 mx-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                            <svg class="w-[48px] h-[48px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" viewBox="0 0 25 25">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</header>
