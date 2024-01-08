@extends('layouts.app')
@section('title', 'Edit Data Produk')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('library/chocolat/dist/css/chocolat.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.produk.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Edit Data Produk</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="#">Produk</a></div>
                    <div class="breadcrumb-item">Edit Data Produk</div>
                </div>
            </div>

            <div class="section-body">
                {{-- <h2 class="section-title">Edit Data Produk</h2>
                <p class="section-lead">
                    On this page you can create a new post and fill in all fields.
                </p> --}}
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
                                <form method="POST" action="{{ route('admin.produk.update', $product->slug) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama
                                            Produk</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name='nama'
                                                value="{{ old('nama') ?? $product->name_product }}">

                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name='category'>
                                                <option>Pilih Kategori Produk</option>
                                                @foreach ($categorys as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ $category->id == $product->categories_id ? 'selected' : '' }}>
                                                        {{ $category->category }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Satuan</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name='satuan'>
                                                <option>Pilih Satuan Produk</option>
                                                <option value="meter" {{ $product->unit == 'meter' ? 'selected' : '' }}>
                                                    Meter</option>
                                                <option value="dudukan"
                                                    {{ $product->unit == 'dudukan' ? 'selected' : '' }}>Dudukan</option>
                                                <option value="set" {{ $product->unit == 'set' ? 'selected' : '' }}>
                                                    Set</option>
                                                <option value="unit" {{ $product->unit == 'unit' ? 'selected' : '' }}>
                                                    Unit</option>
                                                <option value="pcs" {{ $product->unit == 'pcs' ? 'selected' : '' }}>
                                                    Pcs</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea class="summernote-simple" name="deskripsi">{{ old('deskripsi') ?? $product->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto
                                            Produk</label>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="row">
                                                <div class="col">
                                                    <div id="image-preview" class="image-preview">
                                                        <label for="image-upload" id="image-label">Pilih Foto</label>
                                                        <input type="file" name="image" id="image-upload" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <h6 class="text-muted">Foto Lama</h6>
                                                    <div class="chocolat-parent">
                                                        <a href="{{ Helper::setUrlImage($product->image) }}"
                                                            class="chocolat-image"
                                                            title="Foto Produk {{ $product->name }}">
                                                            <div>
                                                                <img alt="image"
                                                                    src="{{ Helper::setUrlImage($product->image) }}"
                                                                    class="img-fluid img-thumbnail">
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <small class="text-muted">* Kosongkan file gambar jika tidak ingin
                                                        mengubah gambar</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Harga
                                            Satuan</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="number" class="form-control" name="harga"
                                                value="{{ old('harga') ?? $product->price }}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <button class="btn btn-primary" type="submit">Edit Data</button>
                                            <a href="{{ route('admin.produk.index') }}">
                                                <button class="btn btn-warning" type="button">Batal</button></a>
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
