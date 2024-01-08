@extends('layouts.app')

@section('title', 'Laporan Perubahan Modal')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Laporan Perubahan Modal</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Laporan</div>
                <div class="breadcrumb-item"><a href="#">Laporan Perubahan Modal</a></div>
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
                            <form class="form-row" method="GET">
                                <div class="form-group mb-0 ">
                                    <input type="month" class="form-control d-inline" max="{{ now()->format('Y-m') }}" name="date" required>
                                </div>

                                <div class="form-group mb-0 ml-3 ">
                                    <input type="submit" class="btn btn-primary d-inline" value="Filter"></input>
                                </div>
                            </form>
                            <div class="card-header-action ml-auto ">
                                <a href="{{ route('admin.laporan.modal.create') }}" class="btn btn-primary">
                                    Tambah Laporan Modal
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
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
                                <table class="table-striped table lead">
                                    <tbody>
                                        <tr>
                                            <th>Modal Awal</th>
                                            <td>&nbsp;</td>
                                            <td>Rp. {{ Helper::formatRupiah($data->modal_awal) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Laba Bersih</th>
                                            <td>Rp. {{ Helper::formatRupiah($data->laba_bersih) }}</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <th>Modal Akhir</th>
                                            <td>&nbsp;</td>
                                            <td>Rp. {{ Helper::formatRupiah($data->modal_akhir) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <h3 class="text-center">Data Kosong</h3>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection