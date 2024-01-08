@extends('layouts.app')

@section('title', 'Keranjang')

@push('style')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('library/chocolat/dist/css/chocolat.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Keranjang</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">Keranjang</div>
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
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Daftar Belanjaan</h4>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <table class="table table-striped table">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Gambar</th>
                                                <th scope="col">Nama Produk</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Menu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total = 0;
                                            @endphp
                                            @if ($carts->isEmpty())
                                                <td colspan="7" class="h6  font-weight-bold text-center">Tidak Barang Di
                                                    Kereanjang Mu</td>
                                            @else
                                                @foreach ($carts as $cart)
                                                    <tr>
                                                        <th scope="row"> {{ $loop->iteration }}</th>
                                                        <td width="10%">
                                                            <div class="gallery gallery-md">
                                                                <div class="gallery-item m-3"
                                                                    data-image="{{ Helper::setUrlImage($cart->product->image, 'news/img13.jpg') }}"
                                                                    data-title="Image 1"></div>
                                                            </div>
                                                        </td>
                                                        <td>{{ $cart->product->name_product }}</td>
                                                        <td style="width: 10%">
                                                            <div class="form-group">
                                                                <label></label>
                                                                <input type="number" class="form-control input_quantity"
                                                                    min="1" max="999" id="txt_quantity"
                                                                    value="{{ $cart->qty }}" name="txt_quantity"
                                                                    class="input_quantity" data-id="{{ $cart->id }}" />
                                                            </div>
                                                        </td>
                                                        <td>Rp. {{ number_format($cart->product->price, 0, ',', '.') }}
                                                        </td>
                                                        <td>Rp.
                                                            {{ number_format($cart->product->price * $cart->qty, 0, ',', '.') }}
                                                        </td>
                                                        <td>
                                                            <form
                                                                action="{{ route(Helper::AdminOrUser('cart.destroy'), $cart->id) }}"
                                                                method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="button"
                                                                    onclick="$(this).closest('form').submit()"
                                                                    class="btn btn-icon btn-sm btn-danger"
                                                                    title='Hapus dari keranjang'>
                                                                    <i class="fas fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $total += $cart->product->price * $cart->qty;
                                                    @endphp
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>


                                <hr />
                                @if (!$carts->isEmpty())
                                    <form action="{{ route(Helper::AdminOrUser('checkout.store')) }}" method="POST">
                                        @method('POST')
                                        @csrf
                                        <div class="row">
                                            <div class="col">
                                                <div class="section-title mt-0">Data Customer</div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6 mb-0">
                                                        <label for="customer_name">Nama Customer</label>
                                                        <input type="text" class="form-control" id="customer_name"
                                                            name="customer_name" placeholder="Nama Customer" required
                                                            value="{{ old('customer_name') }}">
                                                    </div>
                                                    <div class="form-group col-md-6 mb-0">
                                                        <label for="nohp_customer">Nomor Customer</label>
                                                        <input type="text" class="form-control" id="nohp_customer"
                                                            placeholder="Nomor Whatsapp/Hp Customer. Format : 628123123123"
                                                            name="nohp_customer" value="{{ old('nohp_customer') }}">
                                                        <small id="" class="form-text text-muted">
                                                            Gunakan Format : 628123123123
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
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
                                        <hr />

                                        <div class="row mt-2">
                                            <div class="col">
                                            </div>
                                            <div class="col-3 text-right">
                                                <div class="h5 font-weight-bold text-dark">{{ auth()->user()->name }}
                                                </div>
                                                <div class="product-subtitle">Customer</div>
                                            </div>
                                            <div class="col-3 mr-1 text-right">
                                                <div class="h5 font-weight-bold text-success">
                                                    Rp. {{ number_format($total ?? 0) }}</div>
                                                <input type="hidden" name="totalPrice" value="{{ $total }}">
                                                <div class="">Total</div>
                                            </div>
                                            <div class="col">
                                                <button type="submit" id="btn_bayar"
                                                    class="btn btn-icon btn-sm btn-success btn-block p-2">
                                                    <i class="far fa-money-bill-1 py-2 " style="font-size:20px"></i>
                                                    <span class="font-weight-bold h5"> Bayar</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
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
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.input_quantity').on('focusout', function() {
                $.ajax({
                    url: `keranjang/${$(this).data('id')}/update-stock`,
                    type: "PATCH",
                    cache: false,
                    data: {
                        "_token": '{{ csrf_token() }}',
                        "qty": $(this).val(),
                    },
                    success: function(response) {
                        console.log(response);
                        location.reload();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            $("#uang").keyup(function(event) {
                var uang = $("#uang").val();
                var total = {{ $total }};
                console.log('total' + total + " uang = " + uang);
                if (uang >= total) {
                    var kembalian = uang - total;
                    $("#uang_kembalian").val(formatRupiah(kembalian.toString(), 'Rp. '));
                    // $("#btn_bayar").prop('disabled', false);
                } else {
                    $("#uang_kembalian").val('Uang belum cukup');
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
