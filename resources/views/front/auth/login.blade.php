{{-- @extends('layouts.front')
@section('title', 'Login')
@section('content')
    <!--====== Login Part Start ======-->
    <section class="login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="login-form
                        @if (session('status'))
                            success
                        @endif">
                        <h2>Login</h2>
                        <p>Welcome back! Please login to your account.</p>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group
                                @error('email')
                                    error
                                @enderror">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}">
                                @error('email')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @error('password') error @enderror">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password">
                                @error('password')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">Remember me</label>
                            </div>
                            <div class="form-group button">
                                <button type="submit" class="btn">Login</button>
                            </div>
                        </form>
                        <div class="form-link">
                            <a href="{{ route('password.request') }}">Forgot your password?</a>
                            <a href="{{ route('register') }}">Don't have an account? Register</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="login-image">
                        <img src="{{ asset('front/images/login.png') }}" alt="#">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== Login Part End ======-->
@endsection --}}
