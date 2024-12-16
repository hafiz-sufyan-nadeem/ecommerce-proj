@extends('admin.auth.auth_layout')

@section('content')
    <div class="row">
        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
        <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                </div>

                <!-- Login Form -->
                <form class="user" action="{{ url('/login') }}" method="post">
                    @csrf

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <!-- Email Input -->
                    <div class="form-group">
                        <input type="email" name="email" class="form-control form-control-user"
                               id="exampleInputEmail" aria-describedby="emailHelp"
                               placeholder="Enter Email Address..." value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif

                    </div>
                    <!-- Password Input -->
                    <div class="form-group">
                        <input type="password" name="password" class="form-control form-control-user"
                               id="exampleInputPassword" placeholder="Password" required>
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif

                    </div>
                    <!-- Remember Me -->
                    <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                            <input type="checkbox" name="remember" class="custom-control-input" id="customCheck">
                            <label class="custom-control-label" for="customCheck">Remember Me</label>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <a href="{{route('dashboard')}}" class="btn btn-primary btn-user btn-block">
                        Login
                    </a>
                </form>
                <hr>
                <div class="text-center">
                    <a class="small" href="{{ route('forgotpassword') }}">Forgot Password?</a>
                </div>
                <div class="text-center">
                    <a class="small" href="{{ route('register') }}">Create an Account!</a>
                </div>
            </div>
        </div>
    </div>

@endsection
