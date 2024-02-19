@extends('layouts.master')

@section('body')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Manage roles</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Roles</li>
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
                            <h3 class="card-title">Create Role with Permissions</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" action="{{ route('roles.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group text-left">
                                            <label class="required @error('name') text-danger @enderror" for="name">Role
                                                Name</label>
                                            <input class="form-control @error('name') is-invalid @enderror" id="name"
                                                name="name" type="text"
                                                @if (old('name')) value="{{ old('name') }}"
                                                @else value="@yield('name')" @endif
                                                placeholder="Role Name" required />

                                            @error('name')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between">
                                            <label class="required @error('permissions') text-danger @enderror m-0"
                                                for="name">Permission</label>
                                            <label class="m-0"><input id="checkAll" name="checkedAll" type="checkbox" />
                                                Check All <br />
                                            </label>
                                        </div>
                                        @error('permissions')
                                            <small class="form-text text-danger mt-0">{{ $message }}</small>
                                        @enderror
                                        <div class="row mt-2">
                                            @foreach ($permissions as $key => $values)
                                                <div class="col-md-2">
                                                    <div class="card">
                                                        <div class="card-header bg-dark">
                                                            <h5 class="card-title">
                                                                <label class="m-0">
                                                                    <input
                                                                        class="{{ 'main-' . str_replace(' ', '', $key) }}"
                                                                        type="checkbox"> {{ $key }}
                                                                </label>
                                                            </h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="form-group m-0">
                                                                @foreach ($values as $val)
                                                                    <label class="d-block m-0">
                                                                        <input
                                                                            class="{{ str_replace(' ', '', $val['module_name']) }}"
                                                                            name="permissions[]" type="checkbox"
                                                                            value="{{ $val['name'] }}">
                                                                        {{ $val['name'] }}
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-lg-12">
                                        <a class="btn btn-danger" href="{{ route('roles.index') }}">Cancel</a>
                                        <button class="btn btn-success" type="submit">Create</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script type="module" src="{{ asset('plugin/adminLte/js/bs-custom-file-input.min.js') }}"></script>
    <script type="module">
        let permissions = @json($permissions);
        $(document).ready(function() {
            //bootstrap custom file
            bsCustomFileInput.init();

            $("#checkAll").click(function() {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });

            $.each(permissions, function(index, values) {
                $.each(values, function(index, value) {
                    let moduleName = value.module_name.replace(/ /g, "");
                    $('.main-' + moduleName).click(function() {
                        $('.' + moduleName).not(this).prop('checked', this.checked);
                    });
                });
            });
        });
    </script>
@endsection
