@extends ('layouts.app')

@section('content')
    <div class="hold-transition register-page">
        <div class="register-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="{{ route('get.signup') }}" class="h1"><b>Register</b></a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Register a new membership</p>

                    <form action="{{ route('post.signup') }}" method="post">
                        @csrf

                        <x-alert class="p-3 mb-4" />

                        <div class="form-group  mb-3">
                            <div class="input-group">
                                <x-input-text name="name" type="name" placeholder="Full name"
                                    value="{{ old('name') }}" />
                                <x-input-icon class="fas fa-user" />
                            </div>
                            <!-- Error Message -->
                            <x-input-error :messages="$errors->first('name')" />
                        </div>

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

                        <div class="form-group  mb-3">
                            <div class="input-group">
                                <x-input-text name="password_confirmation" type="password" placeholder="Confirm Password" />
                                <x-input-icon class="fas fa-lock" />
                            </div>
                        </div>

                        <div class="row">
                            {{-- <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                    <label for="agreeTerms">
                                        I agree to the <a href="#">terms</a>
                                    </label>
                                </div>
                            </div> --}}
                            <!-- /.col -->
                            <div class="col-4 mx-auto">
                                <x-primary-button type="submit">
                                    Register
                                </x-primary-button>
                            </div>
                        </div>
                    </form>

                    {{-- <div class="social-auth-links text-center">
                        <a href="#" class="btn btn-block btn-primary">
                            <i class="fab fa-facebook mr-2"></i>
                            Sign up using Facebook
                        </a>
                        <a href="#" class="btn btn-block btn-danger">
                            <i class="fab fa-google-plus mr-2"></i>
                            Sign up using Google+
                        </a>
                    </div> --}}

                    <a href="{{ route('get.login') }}" class="text-center mt-3">I already have a membership</a>
                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->
        </div>
        <!-- /.register-box -->
    </div>
@endsection
