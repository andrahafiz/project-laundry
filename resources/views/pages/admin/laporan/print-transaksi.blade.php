<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Transaksi [ {{ $request->tgl_awal ?? 'Null' }} - {{ $request->tgl_akhir ?? 'Null' }}]
    </title>
</head>
<style type="text/css">
    body {
        font-family: 'Roboto Condensed', sans-serif;
        font: 400 14px 'Calibri', 'Arial';
    }

    table {
        border-collapse: collapse;
        border-radius: 1em;
        overflow: hidden;
        width: 100%;
        background: white;
        text-align: center;

    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    thead tr th {
        background: #6777ef;
        color: whitesmoke;
        font-size: 16px;
    }

    th,
    td {
        padding: 0.5em;
        /* background: #e8e6e6; */
        border-bottom: 2px solid white;
    }


    .css-mine {
        margin-top: 2em;
        clear: both;
    }

    .summury {
        font-weight: 900;
        text-align: center;
        font-size: 1.3em;
        border-top: 2.1px solid #6777ef;
    }

    table#test {
        text-align: left;
        border: 0 solid;
        border-radius: 0px;
        border-collapse: collapse;
        overflow: hidden;
        width: 100%;
        background: white;

    }

    #test tr:nth-child(even) {
        background-color: white;
    }

    blockquote {
        color: white;
    }
</style>

<body>
    <h2 style="text-align: center">LAPORAN TRANSAKSI</h2>
    <hr />
    @php
        $total = 0;
    @endphp
    <table id="test" style="margin-bottom:4%">
        <tr>
            <td style="width: 100px;">Nama Usaha</td>
            <td>:</td>
            <td>Alrescha Wash</td>
            <td>Jumlah transaksi</td>
            <td>:</td>
            <td>{{ count($transactions) }}</td>
        </tr>
        <tr>
            <td style="width: 100px;">Nama Laporan</td>
            <td>:</td>
            <td>Laporan Transaksi</td>
            <td>Jumlah transaksi</td>
            <td>:</td>
            <td><b>Rp. {{ Helper::formatRupiah($transactions->sum('total_price')) }}</b></td>
        </tr>
        <tr>
            <td>Periode </td>
            <td>:</td>
            <td>{{ $request->tgl_awal ?? '@' }} sampai {{ $request->tgl_akhir }}</td>
        </tr>
    </table>
    <table id="transaksi">
        <thead>
            <tr>
                <th style="width:10%">
                    No
                </th>
                <th>Tanggal Transaksi</th>
                <th>ID Invoice</th>
                <th>Customer</th>
                <th>Customer</th>
                <th>Total Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaksi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td> {{ $transaksi->created_at->isoFormat('D MMMM Y H:ss') }}</td>
                    <td>INV/{{ $transaksi->id }}</td>
                    <td>{{ $transaksi->user->name }}</td>
                    <td>{{ $transaksi->feedaback->customer_name ?? '-' }}</td>
                    <td><b>Rp. {{ Helper::formatRupiah($transaksi->total_price) }}</b>
                </tr>
            @endforeach
            <tr class="summury">
                <td colspan="2">Jumlah Transaksi</td>
                <td>{{ count($transactions) }}</td>
                <td colspan="2">Total</td>
                <td><b>Rp. {{ Helper::formatRupiah($transactions->sum('total_price')) }}</b></td>
            </tr>
        </tbody>
    </table>
    <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                if ($PAGE_COUNT > 1) {
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $size = 12;
                    $pageText = "Halaman " . $PAGE_NUM . " dari " . $PAGE_COUNT;
                    $y = 810;
                    $x = 460;
                    $pdf->text($x, $y, $pageText, $font, $size);
                }
            ');
        }
        </script>

</html>
