@extends('layouts.app')

@section('title', 'Bukti Transfer')

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
                <h1>Bukti Transfer</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">Bukti Transfer</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-6">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible alert-has-icon show fade">
                                <div class="alert-icon"><i class="far fa-circle-xmark"></i></div>
                                <div class="alert-body">
                                    <div class="alert-title">Gagal</div>
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="invoice">
                    <div class="invoice-print" id="DivIdToPrint">
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="invoice-title">
                                            <h2>Bukti Transfer</h2>
                                        </div>
                                        <hr class="my-3">
                                        <div class="row">
                                            <div class="col-12">
                                                @if ($transactions->transfer_proof == 'avatar.jpg')
                                                    <form method="POST"
                                                        action="{{ route('customer.uploadbuktitransfer', $transactions->id) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group row mb-4">
                                                            <label
                                                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto</label>
                                                            <div class="col-sm-12 col-md-8">
                                                                <div id="image-preview" class="image-preview">
                                                                    <label for="image-upload" id="image-label">Pilih
                                                                        Foto</label>
                                                                    <input type="file" name="image"
                                                                        id="image-upload" />
                                                                </div>
                                                                <button type="submit"
                                                                    class="btn btn-primary mt-3">Upload</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @else
                                                    <img alt="image"
                                                        src="{{ Helper::setUrlImage($transactions->transfer_proof) }}"
                                                        class="img-thumbnail rounded">
                                                @endif

                                            </div>
                                        </div>
                                        <hr style="height:3px;border:none;color:#333;background-color:#333;" />
                                        <div class="row">
                                            <div class="col-md-6 text-md-left">
                                                <address>
                                                    <strong>Customer :</strong><br>
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
                                                        <td class="text-right">Rp. {{ Helper::formatRupiah($item->total) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg text-right">
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
                            <div class="col-6">
                                <div class="invoice-title">
                                    <h2>Nomor Rekening</h2>
                                </div>
                                <hr class="my-3">
                                <img alt="image" src="{{ asset('img/transfer.png') }}" class="img-thumbnail rounded">
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
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-post-create.js') }}"></script>
@endpush
