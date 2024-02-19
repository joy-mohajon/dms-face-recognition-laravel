@extends('layouts.master')

@section('body')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-primary">
                            <div class="card-body box-profile">
                                <div class="mb-3 text-center">
                                    <img class="profile-user-img img-fluid img-circle" alt="User profile picture"
                                        @if (auth()->user()->profile_image) {{-- src="/profile_images/{{ auth()->user()->profile_image }}" --}}
                                        src="{{ asset(auth()->user()->profile_image) }}"
                                        @else
                                        src="{{ asset('plugin/adminLte/img/avatar.png') }}" @endif />
                                </div>

                                <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>

                                <p class="text-muted text-center">{{ auth()->user()->email }}</p>
                                <form class="form" action="{{ route('profile.image') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input class="custom-file-input" id="InputFile" name="profile_image"
                                                type="file" accept=".jpg, .jpeg, .png, .gif, .webp"
                                                placeholder="upload file" required>
                                            <label class="custom-file-label" for="InputFile">Choose image</label>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary btn-block" type="submit"><b>Update</b></button>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card pt-2">
                            <div class="card-body">
                                <x-alert class="mb-4 p-3" />
                                <form class="form-horizontal" action="{{ route('post.profile') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    {{-- <div class="form-group row">
                                        <div class="col-sm-2 mx-auto">
                                            <img class="profile-user-img img-fluid img-circle"
                                                src="{{ asset('plugin/adminLte/img/avatar.png') }}"
                                                alt="User profile picture" />
                                        </div>

                                        <div class="col-sm-10">
                                            <label class="required @error('file') text-danger @enderror"
                                                for="InputFile">Upload image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input
                                                        class="custom-file-input @error('profile_image') is-invalid @enderror"
                                                        id="InputFile" name="profile_image" type="file"
                                                        accept=".jpg, .jpeg, .png, .gif, .webp"
                                                        @if (old('profile_image')) value="{{ old('profile_image') }}"
                                                            @else value="" @endif
                                                        placeholder="upload file" required>
                                                    <label class="custom-file-label" for="InputFile">Choose file</label>
                                                </div>
                                            </div>
                                            @error('file')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div> --}}

                                    <div class="form-group row">
                                        <x-input-label class="col-sm-3" for="inputName">Name</x-input-label>
                                        <div class="col-sm-9">
                                            <x-input-text id="inputName" name='name' type="text"
                                                value="{{ auth()->user()->name }}" placeholder="Name" />
                                            <x-input-error :messages="$errors->first('name')" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <x-input-label class="col-sm-3" for="inputEmail">Email</x-input-label>
                                        <div class="col-sm-9">
                                            <x-input-text id="inputEmail" name='email' type="email"
                                                value="{{ auth()->user()->email }}" :disabled="true" placeholder="Email" />
                                            <x-input-error :messages="$errors->first('email')" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <x-input-label class="col-sm-3" for="inputPassword">New password</x-input-label>
                                        <div class="col-sm-9">
                                            <x-input-text id="inputPassword" name='password' type="password"
                                                placeholder="Password" />
                                            <x-input-error :messages="$errors->first('password')" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <x-input-label class="col-sm-3" for="inputConfirmPassword">Confirm
                                            password</x-input-label>
                                        <div class="col-sm-9">
                                            <x-input-text id="inputConfirmPassword" name='password_confirmation'
                                                type="password" placeholder="Confirm password" />
                                            <x-input-error :messages="$errors->first('password_confirmation')" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="offset-sm-3 col-sm-9 col-md-2">
                                            <x-danger-button type="submit">Save</x-danger-button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
