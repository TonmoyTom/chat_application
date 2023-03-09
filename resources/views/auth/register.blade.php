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
                        <h4>Sign up</h4>
                        <p class="text-muted mb-4">Get your {{ env('APP_NAME') }} account now.</p>
                    </div>
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="p-3">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <div class="input-group bg-soft-light rounded-3  mb-3">
                                                <span class="input-group-text text-muted" id="basic-addon5">
                                                    <i class="ri-mail-line"></i>
                                                </span>
                                            <input type="email" name="email"
                                                   class="form-control form-control-lg bg-soft-light border-light @error('email') is-invalid @enderror"
                                                   placeholder="Enter Email" aria-label="Enter Email"
                                                   aria-describedby="basic-addon5">
                                        </div>
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <div class="input-group bg-soft-light mb-3 rounded-3">
                                                <span class="input-group-text border-light text-muted"
                                                      id="basic-addon6">
                                                    <i class="ri-user-2-line"></i>
                                                </span>
                                            <input type="text" name="name"
                                                   class="form-control form-control-lg bg-soft-light border-light @error('name') is-invalid @enderror"
                                                   placeholder="Enter Username" aria-label="Enter Username"
                                                   aria-describedby="basic-addon6">
                                        </div>
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Password</label>
                                        <div class="input-group bg-soft-light mb-3 rounded-3">
                                                <span class="input-group-text border-light text-muted"
                                                      id="basic-addon7">
                                                    <i class="ri-lock-2-line"></i>
                                                </span>
                                            <input type="password" name="password"
                                                   class="form-control form-control-lg bg-soft-light border-light @error('password') is-invalid @enderror"
                                                   placeholder="Enter Password" aria-label="Enter Password"
                                                   aria-describedby="basic-addon7">
                                        </div>
                                        @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Confirm Password</label>
                                        <div class="input-group bg-soft-light mb-3 rounded-3">
                                                <span class="input-group-text border-light text-muted  "
                                                      id="basic-addon7">
                                                    <i class="ri-lock-2-line"></i>
                                                </span>
                                            <input type="password" name="password_confirmation"
                                                   class="form-control form-control-lg bg-soft-light border-light @error('password_confirmation') is-invalid @enderror"
                                                   placeholder="Enter Confirm Password"
                                                   aria-label="Enter Confirm Password"
                                                   aria-describedby="basic-addon7">
                                            @error('password_confirmation')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>


                                    <div class="d-grid">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">Sign up
                                        </button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <p class="text-muted mb-0">By registering you agree to the Chatvia <a href="#"
                                                                                                              class="text-primary">Terms
                                                of Use</a></p>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 text-center">
                        <p>Already have an account ? <a href="{{ route('login') }}" class="fw-medium text-primary">
                                Signin </a></p>
                        <p>©
                            <script>document.write(new Date().getFullYear())</script>
                            Chatvia. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
