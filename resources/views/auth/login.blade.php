@extends ('layouts.app')

@section('content')
    <div class="hold-transition login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="../../index2.html" class="h1"><b>Login</b></a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Sign in to start your session</p>

                    <x-alert class="p-3 mb-4" />

                    <form action="{{ route('post.login') }}" method="post">
                        @csrf

                        <div class="form-group  mb-3">
                            <div class="input-group">
                                <x-input-text name="email" type="email" placeholder="Email"
                                    value="{{ old('email') }}" />
                                <x-input-icon class="fas fa-envelope" />
                            </div>
                            <!-- Error Message -->
                            <x-input-error :messages="$errors->first('email')" />
                        </div>

                        <div class="form-group  mb-3">
                            <div class="input-group">
                                <x-input-text name="password" type="password" placeholder="Password" />
                                <x-input-icon class="fas fa-lock" />
                            </div>
                            <!-- Error Message -->
                            <x-input-error :messages="$errors->first('password')" />
                        </div>

                        <div class="row">
                            {{-- <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember" />
                                    <label for="remember"> Remember Me </label>
                                </div>
                            </div> --}}
                            <!-- /.col -->
                            <div class="col-4 mx-auto">
                                <x-primary-button type="submit">
                                    Sign In
                                </x-primary-button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    {{-- <div class="social-auth-links text-center mt-2 mb-3">
                        <a href="#" class="btn btn-block btn-primary">
                            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                        </a>
                        <a href="#" class="btn btn-block btn-danger">
                            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                        </a>
                    </div> --}}
                    <!-- /.social-auth-links -->

                    <p class="mb-1 mt-2">
                        <a href="{{ route('get.forgot.password') }}">I forgot my password</a>
                    </p>
                    <p class="mb-0">
                        <a href="{{ route('get.signup') }}" class="text-center">Register a new membership</a>
                    </p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.login-box -->
    </div>
@endsection
