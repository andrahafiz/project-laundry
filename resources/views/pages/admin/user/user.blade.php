@extends('layouts.app')

@section('title', 'User')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/chocolat/dist/css/chocolat.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">User</div>
                </div>
            </div>
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible alert-has-icon show fade">
                    <div class="alert-icon"><i class="far fa-circle-check"></i></div>
                    <div class="alert-body">
                        <div class="alert-title">Sukses</div>
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        {{ session('success') }}!
                    </div>
                </div>
            @endif
            @error('error')
                <div class="alert alert-danger alert-dismissible alert-has-icon show fade">
                    <div class="alert-icon"><i class="far fa-circle-xmark"></i></div>
                    <div class="alert-body">
                        <div class="alert-title">Gagal</div>
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        {{ $message }}.
                    </div>
                </div>
            @enderror
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Data User</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('admin.user.tambah-user') }}" class="btn btn-primary">
                                        Tambah Data User
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table align-middle" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    No
                                                </th>
                                                <th>Photo</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                                <th>No HP</th>
                                                <th>Roles</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td class="text-center align-middle">
                                                        {{ $loop->iteration }}
                                                    </td>

                                                    <td class="align-middle">
                                                        <div class="chocolat-parent">
                                                            <a href="{{ $user->photo == 'avatar.jpg' ? asset('img/avatar/avatar-1.png') : Helper::setUrlImage($user->photo) }}"
                                                                class="chocolat-image">
                                                                <img alt="image"
                                                                    src="{{ $user->photo == 'avatar.jpg' ? asset('img/avatar/avatar-1.png') : Helper::setUrlImage($user->photo) }}"
                                                                    class="rounded-circle" data-toggle="tooltip"
                                                                    title="Wildan Ahdian" width="35">
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle">{{ $user->name }}</td>
                                                    <td class="align-middle">{{ $user->email }}</td>
                                                    <td class="align-middle">{{ $user->username }}</td>
                                                    <td class="align-middle">{{ $user->no_hp }}</td>
                                                    <td class="align-middle">
                                                        @if ($user->roles === 'ADMIN')
                                                            <div class="badge badge-warning">ADMIN</div>
                                                        @else
                                                            <div class="badge badge-success">USER</div>
                                                        @endif
                                                    </td>
                                                    <td width="10%" class="align-middle">
                                                        <a href="{{ route('admin.user.edit', $user->id) }}"
                                                            class="btn btn-icon btn-sm btn-primary">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        {{-- <a href="{{ route('admin.user.detail', $user->slug) }}"
                                                            class="btn btn-icon btn-sm btn-info">
                                                            <i class="fas fa-circle-info"></i>
                                                        </a> --}}
                                                        <form method="POST"
                                                            action="{{ route('admin.user.destroy', $user->id) }}"
                                                            class="d-inline">
                                                            @csrf
                                                            {{ method_field('delete') }}
                                                            <button type="submit" class="btn btn-icon btn-sm btn-danger"
                                                                title='Delete'
                                                                onclick="return confirm('Data ini akan di hapus, anda yakin?')">
                                                                <i class="fas fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
@endpush
