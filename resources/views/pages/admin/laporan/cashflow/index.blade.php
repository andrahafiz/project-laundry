@extends('layouts.app')

@section('title', 'Laporan Perubahan CashFlow')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/chocolat/dist/css/chocolat.css') }}">
<link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Laporan Perubahan CashFlow</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Laporan</div>
                <div class="breadcrumb-item"><a href="#">Laporan Perubahan CashFlow</a></div>
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

                            <div class="card-header-action ml-auto ">
                                <a href="{{ route('admin.laporan.cashflow.create') }}" class="btn btn-primary">
                                    Tambah Laporan Cashflow
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="title text-center">
                                <h3>
                                    Laporan Perubahan CashFlow<br />
                                    Toko Alrescha Wash<br />
                                </h3>
                            </div>
                            <hr />
                            <form action="">
                                <div class="form-group">
                                    <label>Tanggal Awal - Tanggal Akhir</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control datepicker" name="start_date" value="{{ Request::get('tgl_awal') }}">
                                        <input type="text" class="form-control datepicker" name="end_date" value="{{ Request::get('tgl_akhir') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary btn-icon icon-left" type="submit">
                                                <i class="fas fa-filter"></i>Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered text-center">
                                    <thead class="thead-light lead">
                                        <tr>
                                            <th rowspan="2">No</th>
                                            <th rowspan="2">No Akun</th>
                                            <th rowspan="2">Tanggal</th>
                                            <th rowspan="2">Keterangan</th>
                                            <th colspan="2">Jenis</th>
                                            <th rowspan="2">Aksi</th>
                                        </tr>
                                        <tr>
                                            <th>Pemasukan</th>
                                            <th>Pengluaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->no_akun }}</td>
                                            <td>{{ $item->tanggal?->isoFormat('dddd, D MMMM Y') }}</td>
                                            <td>{{ $item->keterangan }}</td>
                                            <td>{{ $item->pemasukan != 0 ? 'Rp. ' . Helper::formatRupiah($item->pemasukan) : '-' }}
                                            </td>
                                            <td>{{ $item->pengeluaran != 0 ? 'Rp. ' . Helper::formatRupiah($item->pengeluaran) : '-' }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.laporan.cashflow.edit', $item->id) }}" class="btn btn-icon btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="POST" action="{{ route('admin.laporan.cashflow.destroy', $item->id) }}" class="d-inline">
                                                    @csrf
                                                    {{ method_field('delete') }}
                                                    <button type="submit" class="btn btn-icon btn-sm btn-danger" title='Delete' onclick="return confirm('Data ini akan di hapus, anda yakin?')">
                                                        <i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr class="lead font-weight-bold" id="total">
                                            <td colspan="4">Total Kas</td>
                                            <td colspan="2">{{ 'Rp. ' . Helper::formatRupiah($total) }}</td>
                                            <td></td>
                                        </tr>
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
<!-- JS Libraies -->
<script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>
<script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
<script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('library/cleave.js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('library/cleave.js/dist/addons/cleave-phone.us.js') }}"></script>
<script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('library/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>
@endpush