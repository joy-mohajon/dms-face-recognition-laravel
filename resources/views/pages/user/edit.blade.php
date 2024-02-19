@extends('layouts.master')

@section('body')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Manage users</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h3 class="card-title">Create User with Role permissions</h3>
                        </div>
                        <div class="card-body">
                            <form id="quickForm" action="{{ route('users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="exampleInputName">Full Name</label>
                                    <input class="form-control" id="exampleInputName" name="name" type="text"
                                        value="{{ old('name', $user->name) }}" placeholder="Enter name">
                                    <x-input-error :messages="$errors->first('name')" />
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input class="form-control" id="exampleInputEmail1" name="email" type="email"
                                        value="{{ $user->email }}" readonly placeholder="Enter email">
                                    <x-input-error :messages="$errors->first('email')" />
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">New password</label>
                                    <input class="form-control" id="exampleInputPassword1" name="password" type="password"
                                        placeholder="Password">
                                    <x-input-error :messages="$errors->first('password')" />
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword">Confirm password</label>
                                    <input class="form-control" id="exampleInputPassword" name="password_confirmation"
                                        type="password" placeholder="Cconfirm password">
                                </div>
                                <div class="form-group">
                                    <label for="userRole">Choose Role</label>
                                    <select class="custom-select" id="userRole" name="role">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}"
                                                @if (in_array($role->id, $data)) selected @endif> {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->first('role')" />
                                </div>

                                @can('user_update')
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                @endcan
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
