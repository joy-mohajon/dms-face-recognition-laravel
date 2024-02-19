@extends('layouts.master')

@section('body')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Manage File</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">File</li>
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
                            <h3 class="card-title">Create File</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" action="{{ route('files.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group text-left">
                                            <label class="required @error('name') text-danger @enderror" for="name">File
                                                Name</label>
                                            <input class="form-control @error('name') is-invalid @enderror" id="name"
                                                name="name" type="text"
                                                @if (old('name')) value="{{ old('name') }}"
                                                @else value="" @endif
                                                placeholder="Role Name" required />
                                            @error('name')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="required @error('file') text-danger @enderror"
                                                for="InputFile">File input</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input class="custom-file-input @error('file') is-invalid @enderror"
                                                        id="InputFile" name="file" type="file" type="file"
                                                        accept=".doc, .docx, .xlsx, .ppt, .pptx, .csv, .txt, .xlx, .xls, .pdf, .jpg, .jpeg, .png, .gif, .webp, .zip, .rar"
                                                        @if (old('file')) value="{{ old('file') }}"
                                                        @else value="" @endif
                                                        placeholder="upload file" required>
                                                    <label class="custom-file-label" for="InputFile">Choose file</label>
                                                </div>
                                            </div>
                                            @error('file')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-lg-12">
                                        <a class="btn btn-danger" href="{{ route('files.index') }}">Cancel</a>
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
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
