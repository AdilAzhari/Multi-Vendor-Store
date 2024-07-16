<x-front-layout>
    <x-slot name="title">
        Login
    </x-slot>
    <x-slot name="style">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    </x-slot>
    <x-slot name="content">
        <div class="login-box">
            <div class="login-logo">
                <a href="{{ route('home') }}"><b>{{ config('app.name') }}</b></a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body">
                    <div class="title">
                        <h1 class="text-center">Login Now</h1>
                        <p>You can login using your social media account or email address</p>
                    </div>
                    <div class="social-auth-links text-center mt-2 mb-3">
                        <a href="#" class="btn btn-block btn-primary">
                            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                        </a>
                        <a href="#" class="btn btn-block btn-danger">
                            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                        </a>
                    </div> <!-- /.social-auth-links -->

                </div>
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to start your session</p>

                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                name="{{ config('fortify.username') }}" value="{{ old('email') }}" placeholder="Email"
                                required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember" name="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    {{-- @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">I forgot my password</a><br>
                    @endif --}}
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
                    @endif

                </div>
                <!-- /.login
                -card-body -->
            </div>
        </div>
        <!-- /.login-box -->
    </x-slot>
</x-front-layout>
