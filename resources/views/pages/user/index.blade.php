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
                <div class="col-12">
                    <!-- Card Start -->
                    <div class="card card-dark">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-3 offset-md-9">
                                    <div class="float-right">
                                        @can('user_create')
                                            <a class="btn btn-primary btn-flat" href="{{ route('users.create') }}"> Add User
                                            </a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body Start -->
                        <div class="card-body">
                            {{-- <form action="{{url()->current()}}" method="GET" >
                                <div class="input-group mb-3">
                                    <input name="column_filter_name" type="text" value="{{ Request::get('column_filter_name') }}" class="form-control" placeholder="Search by area" >

                                    <button type="submit" class="btn btn-outline-success">Filter</button>
                                    <button type="button" id="clearuserFilter" class="btn btn-outline-danger">Clear</button>
                                </div>
                            </form> --}}
                            <table class="table-bordered table-hover table-striped table">
                                <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>User Name</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $key => $user)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $user->name }}</td>

                                            <td class="text-center">
                                                @can('user_show')
                                                    <a class="btn btn-info btn-sm" href="{{ route('users.edit', $user->id) }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                @endcan
                                                @can('user_delete')
                                                    <button class="btn btn-danger btn-sm delete-user" type="button"
                                                        user-id="{{ $user->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="3">No data 😢</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if (count($users) > 0)
                            <div class="card-footer">
                                <div class="float-left">
                                    <span>Showing </span> <b>{{ $users->firstItem() }}</b>
                                    <span>to </span> <b>{{ $users->lastItem() }}</b> from
                                    <span>total: </span> <b>{{ $users->total() }}</b>
                                </div>
                                <div class="float-right">
                                    {{ @$users->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        @endif
                        <!-- Card Body End -->
                    </div>
                    <!-- Card End -->
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $(document).ready(function() {
            $('#clearuserFilter').click(() => {
                $('input[name="column_filter_name"]').val('');
                window.location.href = "{{ route('users.index') }}";
            })
        });

        $(document).ready(function() {
            $("body").on("click", ".delete-user", function() {

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        let user_id = $(this).attr("user-id");
                        $.ajax({
                            url: 'users/' + user_id,
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            type: 'delete',
                            success: function(result) {
                                Swal.fire(
                                    'Deleted!',
                                    result.status,
                                    'success'
                                );
                                setTimeout(function() {
                                    window.location.reload();
                                }, 2000);
                            }
                        });

                    }
                })
            });
        });
    </script>
@endsection
