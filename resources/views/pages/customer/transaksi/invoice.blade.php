@extends('layouts.app')

@section('title', 'Invoice')

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
                <h1>Invoice</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">Invoice</div>
                </div>
            </div>

            <div class="section-body">
                <div class="invoice">
                    <div class="invoice-print" id="DivIdToPrint">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="invoice-title">
                                    <h2>Invoice</h2>
                                    <div class="invoice-number">No Invoice # INV/{{ $transactions->id }}</div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6 text-md-left">
                                        <address>
                                            <strong>Customer:</strong><br>
                                            {{ $transactions->user->name }}

                                        </address>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 text-md-left">
                                        <address>
                                            <strong>Tanggal Order:</strong><br>
                                            {{ $transactions->created_at->isoFormat('dddd, D MMMM Y H:ss') }}
                                        </address>
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
