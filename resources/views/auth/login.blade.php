@extends('chat-user.layouts.app')
@section('content')
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="text-center mb-4" style="margin: auto; width: 100px">
                        <a href="{{ route('home') }}">
                            <x-application-logo class="block w-auto h-10 text-gray-600 fill-current"/>
                        </a>
                    </div>
                    <div class="text-center mb-4">
                        <h4>Sign in</h4>
                        <p class="text-muted mb-4">Sign in to continue to {{ env('APP_NAME') }}.</p>
                    </div>

                    <div class="card">
                        <div class="card-body p-4">
                            <div class="p-3">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <div class="input-group mb-3 bg-soft-light rounded-3">
                                                <span class="input-group-text text-muted" id="basic-addon3">
                                                    <i class="ri-user-2-line"></i>
                                                </span>
                                            <input type="email" name="email"
                                                   class="form-control form-control-lg border-light bg-soft-light
@error('email') is-invalid @enderror"
                                                   placeholder="Enter Email" aria-label="Enter Email"
                                                   aria-describedby="basic-addon3">
                                        </div>
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <div class="float-end">
                                            <a href="{{ route('password.request') }}" class="text-muted font-size-13">Forgot
                                                password?</a>
                                        </div>
                                        <label class="form-label">Password</label>
                                        <div class="input-group mb-3 bg-soft-light rounded-3">
                                                <span class="input-group-text text-muted" id="basic-addon4">
                                                    <i class="ri-lock-2-line"></i>
                                                </span>
                                            <input type="password" name="password"
                                                   class="form-control form-control-lg border-light bg-soft-light  @error('password') is-invalid @enderror"
                                                   placeholder="Enter Password" aria-label="Enter Password"
                                                   aria-describedby="basic-addon4">
                                        </div>
                                        @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-check mb-4">
                                        <input type="checkbox" class="form-check-input" id="remember-check">
                                        <label class="form-check-label" for="remember-check">Remember me</label>
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">Sign in
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 text-center">
                        <p>Don't have an account ? <a href="{{ route('register') }}" class="fw-medium text-primary">
                                Signup
                                now </a></p>
                        <p>©
                            <script>document.write(new Date().getFullYear())</script>
                            {{ env('APP_NAME') }}. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
