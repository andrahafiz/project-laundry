@extends('layouts.app')

@section('title', 'Laporan Transaksi')

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
                <h1>Laporan Transaksi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">Laporan Transaksi</div>
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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class=" mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="section-body">
                <div class="row">

                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Data Transaksi</h4>
                            </div>
                            <div class="card-body">
                                <form action="">
                                    <div class="form-group">
                                        <label>Tanggal Awal - Tanggal Akhir</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker" name="tgl_awal"
                                                value="{{ Request::get('tgl_awal') }}">
                                            <input type="text" class="form-control datepicker" name="tgl_akhir"
                                                value="{{ Request::get('tgl_akhir') }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary btn-icon icon-left" type="submit"
                                                    name="action" value="filter">
                                                    <i class="fas fa-filter"></i>Filter</button>
                                                <button class="btn btn-warning btn-icon icon-left" type="submit"
                                                    name="action" value="print">
                                                    <i class="fas fa-print"></i>Print</button>
                                                {{-- <button class="btn btn-warning" type="button">Print</button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table class="table-striped table align-middle" id="table-transaksi">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    No
                                                </th>
                                                <th>ID Invoice</th>
                                                <th>Total Transaksi</th>
                                                <th>Customer</th>
                                                <th>Invoice</th>
                                                <th>Tanggal Transaksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transactions as $transaksi)
                                                <tr>
                                                    <td class="text-center align-middle">
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td class="align-middle">
                                                        INV/{{ $transaksi->id }}
                                                    </td>
                                                    <td class="align-middle">
                                                        Rp. {{ Helper::formatRupiah($transaksi->total_price) }}</td>
                                                    <td class="align-middle">{{ $transaksi->user->name }}</td>
                                                    <td class="align-middle">
                                                        <a
                                                            href="{{ route(Helper::AdminOrUser('invoice'), $transaksi->id) }}">Lihat
                                                            Invoice</a>
                                                    </td>
                                                    <td> {{ $transaksi->created_at->isoFormat('dddd, D MMMM Y H:ss') }}
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
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script>
        function print() {
            window.location = 'http://www.google.com';
        }
    </script>
@endpush
