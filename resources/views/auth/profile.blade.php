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

                    <div class="col-md-12">
                        <div class="card pt-2">
                            <div class="card-body">
                                <x-alert class="p-3 mb-4" />
                                <form class="form-horizontal" action="{{ route('post.profile') }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group row">
                                        <x-input-label for="inputName">Name</x-input-label>
                                        <div class="col-sm-10">
                                            <x-input-text name='name' type="text" id="inputName" placeholder="Name"
                                                value="{{ auth()->user()->name }}" />
                                            <x-input-error :messages="$errors->first('name')" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <x-input-label for="inputEmail">Email</x-input-label>
                                        <div class="col-sm-10">
                                            <x-input-text name='email' type="email" id="inputEmail" :disabled="true"
                                                placeholder="Email" value="{{ auth()->user()->email }}" />
                                            <x-input-error :messages="$errors->first('email')" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <x-input-label for="inputPassword">New password</x-input-label>
                                        <div class="col-sm-10">
                                            <x-input-text name='password' type="password" id="inputPassword"
                                                placeholder="Password" />
                                            <x-input-error :messages="$errors->first('password')" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <x-input-label for="inputConfirmPassword">Confirm password</x-input-label>
                                        <div class="col-sm-10">
                                            <x-input-text name='password_confirmation' type="password"
                                                id="inputConfirmPassword" placeholder="Confirm password" />
                                            <x-input-error :messages="$errors->first('password_confirmation')" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10 col-md-2">
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
