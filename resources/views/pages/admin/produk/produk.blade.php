@extends('layouts.app')

@section('title', 'Jasa')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Jasa</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">Jasa</div>
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
                                <h4>Data Jasa</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('admin.produk.tambah-produk') }}" class="btn btn-primary">
                                        Tambah Data Jasa
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table align-middle" id="table-produk">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    No
                                                </th>
                                                <th>Nama</th>
                                                <th>Kategori</th>
                                                <th>Harga</th>
                                                <th>Satuan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $produk)
                                                <tr>
                                                    <td class="text-center align-middle">
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td class="align-middle">{{ $produk->name_product }}</td>
                                                    <td class="align-middle">{{ $produk->categories->category }}</td>
                                                    <td class="align-middle">@
                                                        Rp. {{ Helper::formatRupiah($produk->price) }}
                                                    <td class="align-middle">{{ $produk->unit }}</td>
                                                    <td width="10%" class="align-middle">
                                                        <a href="{{ route('admin.produk.detail', $produk->slug) }}"
                                                            class="btn btn-icon btn-sm btn-info">
                                                            <i class="fas fa-circle-info"></i>
                                                        </a>
                                                        <a href="{{ route('admin.produk.edit-produk', $produk->slug) }}"
                                                            class="btn btn-icon btn-sm btn-primary">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form method="POST"
                                                            action="{{ route('admin.produk.destroy', $produk->slug) }}"
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
@endpush
