@extends('layouts.master')

@section('body')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Manage Files</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Files</li>
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
                                        @can('file_create')
                                            <a class="btn btn-primary btn-flat" href="{{ route('files.create') }}">Add File</a>
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
                                    <button type="button" id="clearFileFilter" class="btn btn-outline-danger">Clear</button>
                                </div>
                            </form> --}}
                            <table class="table-bordered table-hover table-striped table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>File Name</th>
                                        <th>Type</th>
                                        <th>Size</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($files as $key => $file)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $file->name }}</td>
                                            <td>{{ $file->mimeType }}</td>
                                            <td>{{ round($file->size / 1024 / 1024, 2) }} mb</td>
                                            <td class="text-center">
                                                @if ($file->mimeType === 'application/pdf' || $file->mimeType === 'image/jpeg')
                                                    <a class="btn btn-warning btn-sm"
                                                        href="{{ route('file.preview', ['id' => $file->id]) }}">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                    {{-- @else
                                                    <a class="btn btn-warning btn-sm"
                                                        href="{{ route('files.show', ['file' => $file->id]) }}">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a> --}}
                                                @endif
                                                {{-- @can('file-download') --}}
                                                <a class="btn btn-success btn-sm" href="{{ asset($file->path) }}"
                                                    download="{{ $file->name }}">
                                                    <i class="fa-regular fa-circle-down"></i>
                                                </a>
                                                {{-- @endcan --}}

                                                @can('file_delete')
                                                    <button class="btn btn-danger btn-sm delete-file" type="button"
                                                        file-id="{{ $file->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="5">No data 😢</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if (count($files) > 0)
                            <div class="card-footer">
                                <div class="float-left">
                                    <span>Showing </span> <b>{{ $files->firstItem() }}</b>
                                    <span>to </span> <b>{{ $files->lastItem() }}</b> from
                                    <span>total: </span> <b>{{ $files->total() }}</b>
                                </div>
                                <div class="float-right">
                                    {{ @$files->links('pagination::bootstrap-4') }}
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
            $('#clearFileFilter').click(() => {
                $('input[name="column_filter_name"]').val('');
                window.location.href = "{{ route('files.index') }}";
            })
        });

        $(document).ready(function() {
            $("body").on("click", ".delete-file", function() {

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
                        let file_id = $(this).attr("file-id");
                        $.ajax({
                            url: 'files/' + file_id,
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
