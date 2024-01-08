@extends('layouts.app')

@section('title', 'Edit Data Kategori Produk')

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
                <h1>Edit Laporan Perubahan Modal</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">Laporan</div>
                    <div class="breadcrumb-item"><a href="#">Edit Laporan Perubahan Modal</a></div>
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
                            <div class="card-body mt-4">
                                <form method="POST" action="{{ route('admin.laporan.modal.update', $data->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Periode</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="month" class="form-control" name='periode'
                                                value="{{ old('periode') ?? $data->periode->format('Y-m') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Modal
                                            Awal</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="number" class="form-control" name='modal_awal'
                                                value="{{ old('modal_awal') ?? $data->modal_awal }}" id="modal_awal">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Laba
                                            Bersih</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="number" class="form-control" name='laba_bersih'
                                                value="{{ old('laba_bersih') ?? $data->laba_bersih }}" id="laba_bersih">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Modal
                                            Akhir</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="number" class="form-control" name='modal_akhir'
                                                value="{{ old('modal_akhir') ?? $data->modal_akhir }}" id="modal_akhir"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <button class="btn btn-primary" type="submit">Edit Data</button>
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
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#modal_awal').on('focusout', function() {
                    var modal_awal = $(this).val();
                    var laba_bersih = $('#laba_bersih').val();
                    $("#modal_akhir").val(modal_awal - laba_bersih).val();
                });

                $('#laba_bersih').on('focusout', function() {
                    var modal_awal = $('#modal_awal').val();
                    var laba_bersih = $(this).val();
                    $("#modal_akhir").val(modal_awal - laba_bersih).val();
                });
            });
        </script>
    @endpush
