@extends('layouts.app')

@section('title', 'Tambah Laporan Perubahan Modal')

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
            <h1>Tambah Laporan Perubahan Modal</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Laporan</div>
                <div class="breadcrumb-item"><a href="#">Tambah Laporan Perubahan Modal</a></div>
            </div>
        </div>

        <div class="section-body">
            {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif --}}
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-body mt-4">
                        <div class="title text-center">
                            <h3>
                                Laporan Laba Rugi<br />
                                Toko Alrescha Wash<br />
                            </h3>
                        </div>
                        <hr />
                        <form method="POST" action="{{ route('admin.laporan.profitloss.store') }}">
                            @csrf
                            <div class="form-group col-md-4">
                                <label>Periode</label>
                                <input type="month" class="form-control @error('periode') is-invalid @enderror" name="periode">
                                @error('periode')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
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
                                                        <input type="text" class="form-control  @error('penjualan_bersih') is-invalid @enderror" name="penjualan_bersih" value="{{ old('penjualan_bersih') }}" placeholder="0" id="penjualan_bersih">
                                                        @error('penjualan_bersih')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
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
                                                        <input type="text" class="form-control @error('sewa_ruko') is-invalid @enderror" name="sewa_ruko" value="{{ old('sewa_ruko') }}" placeholder="0" id="sewa_ruko">
                                                        @error('sewa_ruko')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
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
                                                        <input type="text" class="form-control @error('beban_lain') is-invalid @enderror" name="beban_lain" value="{{ old('beban_lain') }}" placeholder="0" id="beban_lain">
                                                        @error('beban_lain')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
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
                                                        <input type="text" class="form-control  @error('beban_air') is-invalid @enderror" name="beban_air" value="{{ old('beban_air') }}" placeholder="0" id="beban_air">
                                                        @error('beban_air')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
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
                                                        <input type="text" class="form-control @error('beban_listrik') is-invalid @enderror" name="beban_listrik" value="{{ old('beban_listrik') }}" placeholder="0" id="beban_listrik">
                                                        @error('beban_listrik')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
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
                                                        <input type="text" class="form-control @error('beban_gaji') is-invalid @enderror" name="beban_gaji" value="{{ old('beban_gaji') }}" placeholder="0" id="beban_gaji">
                                                        @error('beban_gaji')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
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
                                                        <input type="text" class="form-control  @error('total_beban') is-invalid @enderror" name="total_beban" value="{{ old('total_beban') }}" placeholder="0" id="total_beban" readonly>
                                                        @error('total_beban')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
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
                                                        <input type="text" class="form-control @error('pajak') is-invalid @enderror" name="pajak" value="{{ old('pajak') }}" placeholder="0" id="pajak">
                                                        @error('pajak')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
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
                                                        <input type="text" class="form-control @error('laba_bersih') is-invalid @enderror" name="laba_bersih" value="{{ old('laba_bersih') }}" placeholder="0" id="laba_bersih" readonly>
                                                        @error('laba_bersih')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md col-lg"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary btn-lg" type="submit">Tambah Data</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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

<script>
    $(document).ready(function() {
        $('#penjualan_bersih, #sewa_ruko, #beban_lain, #beban_air, #beban_listrik, #beban_gaji, #total_beban, #pajak')
            .on('focusout',
                function() {
                    calculateAll();
                });

        function calculateAll() {
            var penjualan_bersih = parseInt($('#penjualan_bersih').val());
            var pajak = parseInt($('#pajak').val());
            total = ~~penjualan_bersih - ~~calculateBeban() - ~~pajak;
            $('#laba_bersih').val(total);

        }

        function calculateBeban() {
            var sewa_ruko = parseInt($('#sewa_ruko').val());
            var beban_lain = parseInt($('#beban_lain').val());
            var beban_air = parseInt($('#beban_air').val());
            var beban_listrik = parseInt($('#beban_listrik').val());
            var beban_gaji = parseInt($('#beban_gaji').val());
            var rumus = ~~sewa_ruko + ~~beban_lain + ~~beban_air + ~~beban_listrik + ~~beban_gaji;
            $('#total_beban').val(rumus);
            return rumus;

        }
    });
</script>
@endpush