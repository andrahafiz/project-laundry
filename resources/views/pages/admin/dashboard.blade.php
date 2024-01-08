@extends('layouts.app')

@section('title', 'Ecommerce Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/owl.carousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-stats">
                            <div class="card-stats-title pb-0">
                                Data Bulan <span class="text-primary">{{ now()->isoFormat('MMMM, Y') }}</span>
                            </div>
                        </div>
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-archive"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Transaksi</h4>
                            </div>
                            <div class="card-body">
                                {{ $data['totalOrder'] }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-stats">
                            <div class="card-stats-title pb-0">
                                Data Bulan <span class="text-primary">{{ now()->isoFormat('MMMM, Y') }}</span>
                            </div>
                        </div>
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Transaksi</h4>
                            </div>
                            <div class="card-body">
                                Rp. {{ Helper::formatRupiah($data['profit']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-stats">
                            <div class="card-stats-title pb-0">
                                Data Bulan <span class="text-primary">{{ now()->isoFormat('MMMM, Y') }}</span>
                            </div>
                        </div>
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Produk Terjual</h4>
                            </div>
                            <div class="card-body">
                                {{ $data['totalProduct'] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Total Transaksi</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" height="158"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card gradient-bottom">
                        <div class="card-header">
                            <h4>Penjualan Produk</h4>
                            <div class="card-header-action">
                                <div class="card-stats-title pb-0">
                                    Data Tahun <span class="text-primary">{{ now()->isoFormat('Y') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="top-5-scroll">
                            @if ($data['topThreeProduct']->isEmpty())
                                <li class="text-center">Data Tidak Ada</li>
                            @else
                                <div class="table-responsive">
                                    <table class="table-striped table" id="table-1">
                                        <thead>
                                            <tr class="text-center">
                                                <th>
                                                    #
                                                </th>
                                                <th>Foto Produk</th>
                                                <th>Jumlah Produk Terjual</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data['topThreeProduct'] as $item)
                                                <tr class="text-center">
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        <img class="rounded" width="55" height="55"
                                                            src="{{ Helper::setUrlImage($item->image) }}" alt="product">
                                                    </td>
                                                    <td>
                                                        {{ $item->qty ?? '0' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md">
                    <div class="card">
                        <div class="card-header">
                            <h4>Invoices</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-danger">Selengkapnya <i
                                        class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive table-invoice">
                                <table class="table-striped table">
                                    <tr>
                                        <th>Invoice ID</th>
                                        <th>Total Transaksi</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Aksi</th>
                                    </tr>
                                    @foreach ($data['transactions'] as $transaksi)
                                        <tr>
                                            <td>
                                                INV/{{ $transaksi->id }}
                                            </td>
                                            <td>
                                                Rp. {{ Helper::formatRupiah($transaksi->total_price) }}</td>
                                            <td> {{ $transaksi->created_at->isoFormat('dddd, D MMMM Y H:ss') }}
                                            </td>
                                            <td>
                                                <a href="{{ route(Helper::AdminOrUser('invoice'), $transaksi->id) }}"
                                                    class="btn btn-primary">Invoice</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/chart.js/dist/Chart.js') }}"></script>
    <script src="{{ asset('library/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('library/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>

    <!-- Page Specific JS File -->
    {{-- <script src="{{ asset('js/page/index.js') }}"></script> --}}
    @include('pages.admin.chartdashboard')
@endpush
