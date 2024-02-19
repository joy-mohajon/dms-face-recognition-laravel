@extends ('layouts.app')

@section('content')
    <div class="hold-transition login-page">
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="{{ route('get.forgot.password') }}" class="h1"><b>Reset password</b></a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
                    <form action="{{ route('post.forgot.password') }}" method="post">
                        @csrf

                        <x-alert class="p-3 mb-4" />
                        <div class="form-group  mb-3">
                            <div class="input-group">
                                <x-input-text name="email" type="email" placeholder="Email"
                                    value="{{ old('email') }}" />
                                <x-input-icon class="fas fa-envelope" />
                            </div>
                            <!-- Error Message -->
                            <x-input-error :messages="$errors->first('email')" />
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <x-primary-button type="submit">
                                    Request new password
                                </x-primary-button>
                            </div>
                            <!-- /.col -->
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
