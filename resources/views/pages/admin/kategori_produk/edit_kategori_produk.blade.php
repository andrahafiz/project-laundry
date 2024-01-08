@extends('layouts.app')

@section('title', 'Edit Data Kategori Produk')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="features-posts.html" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Edit Data Kategori Produk</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">Utilitas</div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.kategori-produk.index') }}">Kategori Produk</a>
                    </div>
                    <div class="breadcrumb-item"><a href="#">Edit Kategori Produk</a></div>
                </div>
            </div>

            <div class="section-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-body mt-4">
                                <form method="POST" action="{{ route('admin.kategori-produk.update', $category->slug) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama
                                            Kategori Produk</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name='nama'
                                                value="{{ old('nama') ?? $category->category }}">
                                        </div>
                                    </div>
                                    <div class="form-group row mxb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                            Kode Kategori Produk
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name='code'
                                                style="text-transform: uppercase"
                                                value="{{ old('code') ?? $category->code }}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <button class="btn btn-primary" type="submit">Edit Data</button>
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

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-post-create.js') }}"></script>
@endpush
