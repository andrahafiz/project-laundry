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
            <form method="POST" action="{{ route('admin.transaksi.update', $transactions->id) }}">
                @csrf
                @method('PUT')
                <div class="section-body">
                    <div class="invoice">
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
                        @error('inp_uang')
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
                                                @if ($transactions->payment_method == 1 && $transactions->transfer_proof != 'avatar.jpg')
                                                    <a alt="image" class="ml-3"
                                                        href="{{ Helper::setUrlImage($transactions->transfer_proof) }}">Bukti
                                                        Transfer</a>
                                                @endif
                                            @elseif($transactions->status_transactions == 1 && $transactions->payment_method == 1)
                                                <span class="badge badge-warning">Menunggu Pembayaran</span>
                                            @elseif($transactions->status_transactions == 2)
                                                <span class="badge badge-primary">Sedang Dicuci</span>
                                            @elseif($transactions->status_transactions == 3)
                                                <span class="badge badge-primary">Sudah Dapat Diambil</span>
                                            @elseif($transactions->status_transactions == 4)
                                                <span class="badge badge-success">Selesai</span>
                                            @elseif($transactions->status_transactions == 6)
                                                <span class="badge badge-success">Cucian Diantar</span>
                                            @elseif($transactions->status_transactions == 7)
                                                <span class="badge badge-success">Cucian Dijemput</span>
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
                                        <div class="col-md-4 text-md-left">
                                            <h4>
                                                <strong>Tipe Order:</strong><br>
                                            </h4>
                                            <div class="form-group">
                                                <select class="form-control" name="status"
                                                    {{ $transactions->status_transactions == 4 ? 'readonly' : null }}>
                                                    <option value="">Silahkan Pilih</option>
                                                    <option value="0"
                                                        {{ $transactions->status_transactions == 0 ? 'selected' : null }}>
                                                        Pengajuan</option>
                                                    <option value="1"
                                                        {{ $transactions->status_transactions == 1 ? 'selected' : null }}>
                                                        Menunggu Pembayaran</option>
                                                    <option value="2"
                                                        {{ $transactions->status_transactions == 2 ? 'selected' : null }}>
                                                        Sedang
                                                        Dicuci</option>
                                                    <option value="3"
                                                        {{ $transactions->status_transactions == 3 ? 'selected' : null }}>
                                                        Sudah
                                                        Dapat Diambil</option>
                                                    <option value="4"
                                                        {{ $transactions->status_transactions == 4 ? 'selected' : null }}>
                                                        Selesai
                                                    </option>
                                                    <option value="6"
                                                        {{ $transactions->status_transactions == 6 ? 'selected' : null }}>
                                                        Cucian
                                                        Diantar</option>
                                                    <option value="7"
                                                        {{ $transactions->status_transactions == 7 ? 'selected' : null }}>
                                                        Cucian
                                                        Dijemput</option>
                                                </select>
                                            </div>
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
                                                    <td class="text-right">Rp. {{ Helper::formatRupiah($item->total) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    @if ($transactions->payment_method == 0)
                                        <div class="row">
                                            <div class="col">
                                                <div class="section-title mt-0">Data Pembayaran</div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6 mb-0">
                                                        <div class="form-group">
                                                            <label>Uang</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text bg-primary text-white">
                                                                        Rp.
                                                                    </div>
                                                                </div>
                                                                <input type="text" id="uang" name="inp_uang"
                                                                    class="form-control currency  @error('inp_uang') is-invalid @enderror">
                                                                @error('inp_uang')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 mb-0">
                                                        <label for="uang_kembalian">Kembalian</label>
                                                        <input type="text" class="form-control" id="uang_kembalian"
                                                            placeholder="Uang kembalian" name="uang_kembalian" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

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
                                                <div class="invoice-detail-value invoice-detail-value-lg ">
                                                    <span id="uang_kembalian_text">
                                                        {{ Helper::formatRupiah($transactions->change) }}</span>
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
                            <hr class="my-3">
                            <div class="text-md-right">
                                @if ($transactions->status_transactions != 4)
                                    <button class="btn btn-success btn-block btn-icon icon-left"><i class="fas fa-save"
                                            type="submit"></i>
                                        Simpan Data</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection
@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.css') }}"></script>
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#uang").keyup(function(event) {
                var uang = $("#uang").val();
                var total = {{ $transactions->total_price }};
                console.log('total' + total + " uang = " + uang);
                if (uang >= total) {
                    var kembalian = uang - total;
                    $("#uang_kembalian").val(formatRupiah(kembalian.toString(), 'Rp. '));
                    $("#uang_kembalian_text").text(formatRupiah(kembalian.toString(), ''));
                    // $("#btn_bayar").prop('disabled', false);
                } else {
                    $("#uang_kembalian").val('Uang belum cukup');
                    $("#uang_kembalian_text").text(0);
                    // $("#btn_bayar").prop('disabled', true);
                }

            });

        });

        /* Fungsi */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
    <!-- Page Specific JS File -->
@endpush
