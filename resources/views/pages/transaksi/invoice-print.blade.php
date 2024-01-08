<!DOCTYPE html>
<html>

<head>
    <title>How To Generate Invoice PDF In Laravel 9 - Techsolutionstuff</title>
</head>
<style type="text/css">
    body {
        font-family: 'Roboto Condensed', sans-serif;
    }

    .m-0 {
        margin: 0px;
    }

    .p-0 {
        padding: 0px;
    }

    .pt-5 {
        padding-top: 5px;
    }

    .mt-10 {
        margin-top: 10px;
    }

    .text-center {
        text-align: center !important;
    }

    .w-100 {
        width: 100%;
    }

    .w-10 {
        width: 20%;
    }

    .w-50 {
        width: 50%;
    }

    .w-75 {
        width: 75%;
    }

    .w-15 {
        width: 15%;
    }

    .logo img {
        width: 200px;
        height: 60px;
    }

    .gray-color {
        color: #5D5D5D;
    }

    .text-bold {
        font-weight: bold;
    }

    .border {
        border: 1px solid black;
    }

    table tr,
    th,
    td {
        border: 1px solid #d2d2d2;
        border-collapse: collapse;
        padding: 7px 8px;
    }

    table tr th {
        background: #F4F4F4;
        font-size: 15px;
    }

    table tr td {
        font-size: 13px;
    }

    table {
        border-collapse: collapse;
    }

    .box-text p {
        line-height: 10px;
    }

    .float-left {
        float: left;
    }

    .total-part {
        font-size: 16px;
        line-height: 12px;
    }

    .total-right p {
        padding-right: 20px;
    }
</style>

<body>
    <div class="head-title">
        <h1 class="text-center m-0 p-0">Invoice</h1>
    </div>
    <div class="add-detail mt-10">
        <div class="w-50 float-left mt-10">
            <p class="m-0 pt-5 text-bold w-100">Invoice Id - <span class="gray-color"># INV/{{ $transactions->id }}</span>
            </p>
            <p class="m-0 pt-5 text-bold w-100">Tanggal Order - <span class="gray-color">
                    {{ $transactions->created_at->isoFormat('dddd, D MMMM Y H:ss') }}</span></p>
        </div>
        <div class="w-50 float-left logo mt-10">
            {{-- <img src="https://techsolutionstuff.com/frontTheme/assets/img/logo_200_60_dark.png" alt="Logo"> --}}
        </div>
        <div style="clear: both;"></div>
    </div>
    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10">
        </table>
    </div>
    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10">
            <tr>
                <th class="w-10">No</th>
                <th class="w-50">Produk</th>
                <th class="w-50">Harga</th>
                <th class="w-50">Qty</th>
                <th class="w-50">Total</th>
            </tr>
            @foreach ($transactions->items as $item)
                <tr align="center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->product->name_product }}</td>
                    <td class="text-center">Rp.
                        {{ Helper::formatRupiah($item->product->price) }}</td>
                    <td class="text-center">{{ $item->qty }}</td>
                    <td class="text-right">Rp. {{ Helper::formatRupiah($item->total) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5">
                    <div class="total-part">
                        <div class="total-left w-75 float-left" align="right">
                            <p>Total Pembayaran</p>
                        </div>
                        <div class="total-right float-left text-bold" align="right" style="margin-left:10px">
                            <p> Rp. {{ Helper::formatRupiah($transactions->total_price) }}</p>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                    <div class="total-part">
                        <div class="total-left w-75 float-left" align="right">
                            <p>Uang</p>
                        </div>
                        <div class="total-right float-left " align="right" style="margin-left:10px">
                            <p> Rp. {{ Helper::formatRupiah($transactions->money) }}</p>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                    <div class="total-part">
                        <div class="total-left w-75 float-left" align="right">
                            <p>Kembalian</p>
                        </div>
                        <div class="total-right float-left " align="right" style="margin-left:10px">
                            <p> Rp. {{ Helper::formatRupiah($transactions->change) }}</p>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

</html>
