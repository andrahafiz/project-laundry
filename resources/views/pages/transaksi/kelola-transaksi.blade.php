@extends('layouts.app')

@section('title', 'Kelola Pesanan')

@push('style')
    <!-- CSS Libraries -->
    <style>
        @media print {
            body * {
                visibility: hidden;
                width: 100%;
            }

            #DivIdToPrint,
            #DivIdToPrint * {
                visibility: visible;
            }

            #DivIdToPrint {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Kelola Pesanan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">Kelola Pesanan</div>
                </div>
            </div>

            <div class="section-body">
                <div class="invoice">
                    <div class="invoice-print" id="DivIdToPrint">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="invoice-title">
                                    <h1>Kelola Pesanan</h1>
                                    <div class="invoice-number">No Invoice # INV/{{ $transactions->id }}</div>
                                </div>
                                <hr class="my-3">
                                <div class="row">
                                    <div class="col-md-4 text-md-left">
                                        <h4>
                                            <strong>Customer</strong>
                                        </h4>
                                        <h5 class="text-muted"> {{ $transactions->user->name }}</h5>
                                    </div>
                                    <div class="col-md-4 text-md-left">
                                        <h4>
                                            <strong>Metode Pembayaran:</strong>
                                        </h4>
                                        <h5 class="text-muted">
                                            {{ $transactions->payment_method == 0 ? 'Cash' : 'Transfer' }}</h5>
                                    </div>
                                    <div class="col-md-4 text-md-left">
                                        <h4>
                                            <strong>Status Pesanan:</strong><br>
                                        </h4>
                                        @if ($transactions->status_transactions == 0)
                                            <span class="badge badge-warning">Pengajuan</span>
                                        @elseif($transactions->status_transactions == 1 && $transactions->payment_method == 1)
                                            <span class="badge badge-warning">Menunggu Pembayaran</span>
                                        @elseif($transactions->status_transactions == 2)
                                            <span class="badge badge-primary">Sedang Dicuci</span>
                                        @elseif($transactions->status_transactions == 3)
                                            <span class="badge badge-primary">Sudah Dapat Diambil</span>
                                        @elseif($transactions->status_transactions == 4)
                                            <span class="badge badge-success">Selesai</span>
                                        @else
                                            <span class="badge badge-secondary">Tidak Ada Status</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4 text-md-left">
                                        <h4>
                                            <strong>Tanggal Order:</strong><br>
                                        </h4>
                                        <h5 class="text-muted">
                                            {{ $transactions->created_at->isoFormat('dddd, D MMMM Y H:ss') }}</h5>
                                    </div>
                                    <div class="col-md-4 text-md-left">
                                        <h4>
                                            <strong>Tipe Order:</strong><br>
                                        </h4>
                                        <h5 class="text-muted">
                                            @if ($transactions->order_type == 1)
                                                Antar Jemput Sendiri
                                            @else
                                                Antar Jemput Staff
                                            @endif
                                        </h5>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-title">Daftar Pesanan</div>
                                <div class="table-responsive">
                                    <table class="table-striped table-hover table-md table">
                                        <tr>
                                            <th data-width="40">No</th>
                                            <th>Item</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Kuantitas</th>
                                            <th class="text-right">Totals</th>
                                        </tr>
                                        @foreach ($transactions->items as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->product->name_product }}</td>
                                                <td class="text-center">Rp.
                                                    {{ Helper::formatRupiah($item->product->price) }}</td>
                                                <td class="text-center">{{ $item->qty }}</td>
                                                <td class="text-right">Rp. {{ Helper::formatRupiah($item->total) }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 text-right">
                                        <hr class="mt-2 mb-2">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Uang</div>
                                            <div class="invoice-detail-value invoice-detail-value-lg">
                                                Rp. {{ Helper::formatRupiah($transactions->money) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <hr class="mt-2 mb-2">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Kembalian</div>
                                            <div class="invoice-detail-value invoice-detail-value-lg">
                                                Rp. {{ Helper::formatRupiah($transactions->change) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <hr class="mt-2 mb-2">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Total</div>
                                            <div class="invoice-detail-value invoice-detail-value-lg">
                                                Rp. {{ Helper::formatRupiah($transactions->total_price) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-md-right">
                        <a href="{{ route(Helper::AdminOrUser('invoice.print'), $transactions->id) }}">
                            <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <!-- Page Specific JS File -->
@endpush
