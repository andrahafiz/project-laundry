@extends('layouts.app')

@section('title', 'Ecommerce Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/owl.carousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/flag-icon-css/css/flag-icon.min.css') }}">
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
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Total Transaksi</h4>
                            <div class="card-header-action">
                                <div class="card-stats-title pb-0">
                                    Data Tahun <span class="text-primary">{{ now()->isoFormat('Y') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" height="158"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card gradient-bottom">
                        <div class="card-header">
                            <h4>5 Produk Terlaris</h4>
                            <div class="card-header-action">
                                <div class="card-stats-title pb-0">
                                    Data Bulan <span class="text-primary">{{ now()->isoFormat('MMMM, Y') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="top-5-scroll">
                            <ul class="list-unstyled list-unstyled-border">
                                @if ($data['topThreeProduct']->isEmpty())
                                    <li class="text-center">Data Tidak Ada</li>
                                @else
                                    @foreach ($data['topThreeProduct'] as $item)
                                        <li class="media">
                                            <img class="mr-3 rounded" width="55"
                                                src="{{ Helper::setUrlImage($item->image) }}" alt="product">
                                            <div class="media-body">
                                                <div class="float-right">
                                                    <div class="font-weight-600 text-muted text-small">
                                                        @if ($item->stock == 0)
                                                            <div class="badge badge-danger badge-sm">Stok
                                                                :{{ $item->stock }}
                                                            </div>
                                                        @elseif ($item->stock <= 15)
                                                            <div class="badge badge-warning badge-sm">Stok
                                                                :{{ $item->stock }}
                                                            </div>
                                                        @else
                                                            <div class="badge badge-success badge-sm">Stok
                                                                :{{ $item->stock }}
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="media-title">{{ $item->name_product }}</div>
                                                <div class="mt-1">
                                                    <div class="budget-price">
                                                        <div class="font-weight-600 text-muted text-small">
                                                            {{ $item->total }}
                                                            Terjual
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <div class="card-footer d-flex justify-content-center pt-3">
                            <div class="budget-price justify-content-center">
                                <a href="{{ route('admin.produk.index') }}" class="ticket-item ticket-more">
                                    Lihat Semua <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
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
    <!-- JS Libraies -->
    <script src="{{ asset('library/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.js') }}"></script>
    <script src="{{ asset('library/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    {{-- <script src="{{ asset('js/page/index.js') }}"></script> --}}
    <script>
        var ctx = document.getElementById("myChart").getContext("2d");
        var dataLabels = {{ Js::from($data['chartTransactions']['labels']) }};
        var data = {{ Js::from($data['chartTransactions']['data']) }};
        const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var labels = dataLabels.map(item => {
            return monthNames[item - 1];
        })
        var myChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: labels,
                datasets: [{
                    label: "Transaksi",
                    data: data,
                    borderWidth: 2,
                    backgroundColor: "rgba(63,82,227,.8)",
                    borderWidth: 0,
                    borderColor: "transparent",
                    pointBorderWidth: 0,
                    pointRadius: 3.5,
                    pointBackgroundColor: "transparent",
                    pointHoverBackgroundColor: "rgba(63,82,227,.8)",
                }],
            },
            options: {
                legend: {
                    display: false,
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            // display: false,
                            drawBorder: false,
                            color: "#f2f2f2",
                        },
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                return "Rp. " + parseInt(value).toLocaleString();
                            },
                        },
                    }, ],
                    xAxes: [{
                        gridLines: {
                            display: true,
                            tickMarkLength: 15,
                        },
                    }, ],
                },
            },
        });
    </script>
@endpush
