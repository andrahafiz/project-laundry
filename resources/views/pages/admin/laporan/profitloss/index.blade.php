@extends('layouts.app')

@section('title', 'Laporan Laba Rugi')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="features-posts.html" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Laporan Laba Rugi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Laporan</div>
                <div class="breadcrumb-item"><a href="#">Laporan Laba Rugi</a></div>
            </div>
        </div>

        <div class="section-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <form class="form-row" method="GET">
                                <div class="form-group mb-0 ">
                                    <input type="month" class="form-control d-inline" max="{{ now()->format('Y-m') }}" name="date" required>
                                </div>

                                <div class="form-group mb-0 ml-3 ">
                                    <input type="submit" class="btn btn-primary d-inline" value="Filter"></input>
                                </div>
                            </form>
                            <div class="card-header-action ml-auto ">
                                <a href="{{ route('admin.laporan.profitloss.create') }}" class="btn btn-primary">
                                    Tambah Laporan Laba Rugi
                                </a>
                            </div>
                        </div>
                        <div class="card-body mt-4">
                            <div class="title text-center">
                                <h3>
                                    Laporan Perubahan Modal<br />
                                    Toko Alrescha Wash<br />
                                    <small class="text-muted">Periode
                                        {{ $data?->periode->format('M Y') }}</small>
                                </h3>
                            </div>
                            <hr />
                            @if (isset($data))
                            <div class="table-responsive">
                                <table class="table table-striped" border="1">
                                    <tbody>
                                        <tr>
                                            <td class="font-weight-bold">Pendapatan</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="font-weight-bold">Penjualan Bersih</td>
                                            <td></td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-primary text-white">Rp.
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" name="penjualan_bersih" value="{{ Helper::formatRupiah($data->penjualan_bersih) }}" disabled>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Beban</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="font-weight-bold">Sewa Ruko</td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-primary text-white">Rp.
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" name="sewa_ruko" value="{{ Helper::formatRupiah($data->sewa_ruko) }}" disabled>
                                                    </div>
                                                </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="font-weight-bold">Beban Lain Lain</td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-primary text-white">Rp.
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" name="beban_lain" value="{{ Helper::formatRupiah($data->beban_lain) }}" disabled>
                                                    </div>
                                                </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="font-weight-bold">Beban Air</td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-primary text-white">Rp.
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" name="beban_air" value="{{ Helper::formatRupiah($data->beban_air) }}" disabled>
                                                    </div>
                                                </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="font-weight-bold">Beban Listrik</td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-primary text-white">Rp.
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" name="beban_listrik" value="{{ Helper::formatRupiah($data->beban_listrik) }}" disabled>
                                                    </div>
                                                </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="font-weight-bold">Beban Gaji</td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-primary text-white">Rp.
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" name="beban_gaji" value="{{ Helper::formatRupiah($data->beban_gaji) }}" disabled>
                                                    </div>
                                                </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="font-weight-bold">Total Beban</td>
                                            <td></td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-primary text-white">Rp.
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" name="total_beban" value="{{ Helper::formatRupiah($data->total_beban) }}" disabled>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Pajak</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-primary text-white">Rp.
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" name="pajak" value="{{ Helper::formatRupiah($data->pajak) }}" disabled>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Laba Bersih</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-primary text-white">Rp.
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" name="laba_bersih" value="{{ Helper::formatRupiah($data->laba_bersih) }}" disabled>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @else
                        <h3 class="text-center">Data Kosong</h3>
                        @endif
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