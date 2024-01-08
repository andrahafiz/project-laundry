@extends('layouts.app')

@section('title', 'Detail Data Produk')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/chocolat/dist/css/chocolat.css') }}">
    <style>
        .text-default {
            color: #34395e;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ url()->previous() }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Detail Data Produk</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('admin.produk.index') }}">Produk</a></div>
                    <div class="breadcrumb-item">Detail Data Produk</div>
                </div>
            </div>

            <div class="section-body">
                {{-- <h2 class="section-title">Detail Data Produk</h2>
                <p class="section-lead">
                    On this page you can create a new post and fill in all fields.
                </p> --}}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            {{-- <div class="card-header">
                                <h4>My Picture</h4>
                                <div class="card-header-action">
                                    <a href="#" class="btn btn-primary">View All</a>
                                </div>
                            </div> --}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="chocolat-parent">
                                            <a href="{{ Helper::setUrlImage($product->image) }}" class="chocolat-image"
                                                title="Foto Produk {{ $product->name }}">
                                                <div>
                                                    <img alt="image" src="{{ Helper::setUrlImage($product->image) }}"
                                                        class="img-fluid img-thumbnail">
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-6 text-default">
                                        <h1>{{ $product->name_product }}</h1>
                                        <h6 class="">
                                            <span class="text-muted">Kategori : </span>
                                            {{ $product->categories->category }}
                                        </h6>
                                        <p>{!! $product->description !!}</p>
                                        <div class="row">
                                            <div class="col-8">
                                                <h3>
                                                    Rp. {{ Helper::formatRupiah($product->price) }}
                                                    <small class="text-muted">/ Pcs</small>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.css') }}"></script>

    <!-- Page Specific JS File -->
@endpush
