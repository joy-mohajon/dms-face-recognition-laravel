@extends ('layouts.app')

@section('content')
    <div class="hold-transition login-page">
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="#" class="h1"><b>Reset password</b></a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">You are only one step a way from your new password, recover your password now.
                    </p>
                    <form action="{{ route('post.reset.password') }}" method="post">
                        @csrf

                        <x-alert class="p-3 mb-4" />
                        <input name="token" type="hidden" value="{{ $token }}">

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
                            <div class="col-12">
                                <x-primary-button type="submit">
                                    Change password
                                </x-primary-button>
                            </div>
                        </div>
                    </form>

                    <p class="mt-3 mb-1">
                        <a href="{{ route('get.login') }}">Login</a>
                    </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>
@endsection
