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
                            <div class="card-stats-title">Order Statistics -
                                <div class="dropdown d-inline">
                                    <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#"
                                        id="orders-month">August</a>
                                    <ul class="dropdown-menu dropdown-menu-sm">
                                        <li class="dropdown-title">Select Month</li>
                                        <li><a href="#" class="dropdown-item">January</a></li>
                                        <li><a href="#" class="dropdown-item">February</a></li>
                                        <li><a href="#" class="dropdown-item">March</a></li>
                                        <li><a href="#" class="dropdown-item">April</a></li>
                                        <li><a href="#" class="dropdown-item">May</a></li>
                                        <li><a href="#" class="dropdown-item">June</a></li>
                                        <li><a href="#" class="dropdown-item">July</a></li>
                                        <li><a href="#" class="dropdown-item active">August</a></li>
                                        <li><a href="#" class="dropdown-item">September</a></li>
                                        <li><a href="#" class="dropdown-item">October</a></li>
                                        <li><a href="#" class="dropdown-item">November</a></li>
                                        <li><a href="#" class="dropdown-item">December</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-stats-items">
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">24</div>
                                    <div class="card-stats-item-label">Pending</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">12</div>
                                    <div class="card-stats-item-label">Shipping</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">23</div>
                                    <div class="card-stats-item-label">Completed</div>
                                </div>
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
                        <div class="card-chart">
                            <canvas id="balance-chart" height="80"></canvas>
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
                        <div class="card-chart">
                            <canvas id="sales-chart" height="80"></canvas>
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
                            <h4>Budget vs Sales</h4>
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
                            {{-- <div class="card-header-action dropdown">
                                <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle">Month</a>
                                <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                    <li class="dropdown-title">Select Period</li>
                                    <li><a href="#" class="dropdown-item">Today</a></li>
                                    <li><a href="#" class="dropdown-item">Week</a></li>
                                    <li><a href="#" class="dropdown-item active">Month</a></li>
                                    <li><a href="#" class="dropdown-item">This Year</a></li>
                                </ul>
                            </div> --}}
                        </div>
                        <div class="card-body" id="top-5-scroll">
                            <ul class="list-unstyled list-unstyled-border">
                                @foreach ($data['topThreeProduct'] as $item)
                                    <li class="media">
                                        <img class="mr-3 rounded" width="55"
                                            src="{{ Helper::setUrlImage($item->image) }}" alt="product">
                                        <div class="media-body">
                                            <div class="float-right">
                                                <div class="font-weight-600 text-muted text-small">
                                                    @if ($item->stock == 0)
                                                        <div class="badge badge-danger badge-sm">Stok :{{ $item->stock }}
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
                <div class="col-md-8">
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
                                        <th>Customer</th>
                                        <th>Total Transaksi</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Aksi</th>
                                    </tr>
                                    @foreach ($data['transactions'] as $transaksi)
                                        <tr>
                                            <td>
                                                INV/{{ $transaksi->id }}
                                            </td>
                                            <td class="font-weight-600">
                                                {{ $transaksi->feedback->customer_name ?? 'Tidak tercatat' }}</td>
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
                <div class="col-md-4">
                    <div class="card card-hero">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="far fa-question-circle"></i>
                            </div>
                            <h4>Feedback</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="tickets-list">
                                @foreach ($data['feedbacks'] as $item)
                                    <div class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>{{ Str::limit($item->description, 100, '....') }}</h4>
                                        </div>
                                        <div class="ticket-info">
                                            <div>{{ $item->customer_name }}</div>
                                            <div class="bullet"></div>
                                            <div class="text-primary">{{ $item->created_at->diffForHumans() }}</div>
                                            <div class="bullet"></div>
                                            <div><a
                                                    href="{{ route(Helper::AdminOrUser('invoice'), $item->transaction->id) }}">
                                                    INV/{{ $item->transaction->id }}
                                                </a></div>
                                        </div>
                                    </div>
                                @endforeach
                                <a href="{{ route('admin.feedback.index') }}" class="ticket-item ticket-more">
                                    Lihat Semua <i class="fas fa-chevron-right"></i>
                                </a>
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
    <script src="{{ asset('js/page/index.js') }}"></script>
@endpush
