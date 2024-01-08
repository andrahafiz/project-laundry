@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/chocolat/dist/css/chocolat.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Riwayat Pesanan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">Riwayat Pesanan</div>
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
                                <h4>Data Riwayat Pesanan</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table align-middle" id="table-transaksi">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    No
                                                </th>
                                                <th>ID Invoice</th>
                                                <th>Total</th>
                                                <th>Customer</th>
                                                <th>Metode Pembayaran</th>
                                                <th>Invoice</th>
                                                <th>Tipe Order</th>
                                                <th>Tanggal Pemesanan</th>
                                                <th>Status Pemesanan</th>
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
                                                        {{ $transaksi->payment_method == 0 ? 'Cash' : 'Transfer' }}</td>
                                                    <td class="align-middle">
                                                        @if ($transaksi->payment_method == 0 && $transaksi->status_transactions == 4)
                                                            <a
                                                                href="{{ route(Helper::AdminOrUser('invoice'), $transaksi->id) }}">Lihat
                                                                Invoice</a>
                                                        @elseif($transaksi->payment_method == 2)
                                                            <a
                                                                href="{{ route(Helper::AdminOrUser('invoice'), $transaksi->id) }}">Lihat
                                                                Invoice</a>
                                                        @else
                                                            Invoice Belum Terbit
                                                        @endif
                                                    </td>
                                                    <td class="align-middle">
                                                        @if ($transaksi->order_type == 1)
                                                            Antar Jemput Sendiri
                                                        @else
                                                            Antar Jemput Staff
                                                        @endif
                                                        </<td>
                                                    <td class="align-middle">
                                                        {{ $transaksi->created_at->isoFormat('dddd, D MMMM Y H:ss') }}
                                                    </td>
                                                    <td class="align-middle">
                                                        @if ($transaksi->status_transactions == 0)
                                                            <span class="badge badge-warning">Pengajuan</span>
                                                        @elseif($transaksi->status_transactions == 1 && $transaksi->payment_method == 1)
                                                            <span class="badge badge-warning">Menunggu Pembayaran</span>
                                                        @elseif($transaksi->status_transactions == 2)
                                                            <span class="badge badge-primary">Sedang Dicuci</span>
                                                        @elseif($transaksi->status_transactions == 3)
                                                            <span class="badge badge-primary">Sudah Dapat Diambil</span>
                                                        @elseif($transaksi->status_transactions == 4)
                                                            <span class="badge badge-success">Selesai</span>
                                                        @elseif($transaksi->status_transactions == 6)
                                                            <span class="badge badge-success">Cucian Diantar</span>
                                                        @elseif($transaksi->status_transactions == 7)
                                                            <span class="badge badge-success">Cucian Dijemput</span>
                                                        @else
                                                            <span class="badge badge-secondary">Tidak Ada Status</span>
                                                        @endif
                                                        @if ($transaksi->payment_method == 1 && $transaksi->transfer_proof != 'avatar.jpg')
                                                            <a alt="image" class="ml-3"
                                                                href="{{ Helper::setUrlImage($transaksi->transfer_proof) }}">Bukti
                                                                Transfer</a>
                                                        @endif
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
