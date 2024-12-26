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
                    <div class="col-md-4 d-none d-md-block">
                        <select class="form-select border-0 bg-transparent">
                            <option>All Categories</option>
                            <option>Groceries</option>
                            <option>Drinks</option>
                            <option>Chocolates</option>
                        </select>
                    </div>
                    <div class="col-11 col-md-7">
                        <form id="search-form" class="text-center" action="index.html" method="post">
                            <input type="text" class="form-control border-0 bg-transparent" placeholder="Search for more than 20,000 products">
                        </form>
                    </div>
                    <div class="col-1">
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
                        <a href="#" class="p-2 mx-1">
                            <svg width="24" height="24"><use xlink:href="#user"></use></svg>
{{--                            //styling rhti--}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
                                <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="p-2 mx-1">
                            <svg width="24" height="24"><use xlink:href="#wishlist"></use></svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="p-2 mx-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                            <svg width="24" height="24"><use xlink:href="#shopping-bag"></use></svg>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</header>
