@extends('layouts.app')

@section('title', 'Edit Data User')

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
            <h1>Edit Data User</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">User</a></div>
                <div class="breadcrumb-item">Edit Data User</div>
            </div>
        </div>

        <div class="section-body">
            {{-- <h2 class="section-title">Edit Data User</h2>
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
            <form method="POST" action="{{ route('admin.user.update', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Foto Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="user-item">
                                    <img alt="image" src="{{ $user->photo == 'avatar.jpg' ? asset('img/avatar/avatar-4.png') : Helper::setUrlImage($user->photo) }}" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Kelola Pengguna</h4>
                            </div>
                            <div class="card-body mt-4">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama
                                        User</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input type="text" class="form-control" name='name' value="{{ old('name') ?? $user->name }}">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nomor
                                        HP</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input type="text" class="form-control" name='no_hp' value="{{ old('no_hp') ?? $user->no_hp }}">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto</label>
                                    <div class="col-sm-12 col-md-8">
                                        <div id="image-preview" class="image-preview">
                                            <label for="image-upload" id="image-label">Pilih Foto</label>
                                            <input type="file" name="image" id="image-upload" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat</label>
                                    <div class="col-sm-12 col-md-8">
                                        <textarea class="form-control" name="address" data-height="150" required="" style="height: 150px;">{{ old('address') ?? $user->address }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori</label>
                                    <div class="col-sm-12 col-md-8">
                                        <select class="form-control selectric" name='roles'>
                                            <option>Pilih Role User</option>
                                            <option value="ADMIN" {{ $user->roles == 'ADMIN' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="CUSTOMER" {{ $user->roles == 'CUSTOMER' ? 'selected' : '' }}>
                                                Customer
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-8">
                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Edit
                                            Data</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Kelola Akun</h4>
                            </div>
                            <div class="card-body mt-4">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input type="text" class="form-control" name='email' value="{{ old('email') ?? $user->email }}">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Username</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input type="text" class="form-control" name='username' value="{{ old('username') ?? $user->username }}">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input type="text" class="form-control" name='password' value="{{ old('password') }}">
                                        <small class="text-muted">*Kosongkan jika tidak ingin ganti password</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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