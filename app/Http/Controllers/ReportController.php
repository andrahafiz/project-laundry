<?php

namespace App\Http\Controllers;

use App\Http\Requests\LaporanTransaksiRequest;
use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ReportController extends Controller
{
    //
    public function index(LaporanTransaksiRequest $request)
    {
        if ($request->has('action') && $request->action == 'print') {
            return $this->print_transaksi($request);
        } else {
            $transactions = Transaction::when($request->has('tgl_awal'), function (Builder $query) use ($request) {
                return $query->whereDate('created_at', '>=', $request->query('tgl_awal'));
            })->when($request->has('tgl_akhir'), function (Builder $query) use ($request) {
                return $query->whereDate('created_at', '<=', $request->query('tgl_akhir'));
            })->get();
            return view('pages.admin.laporan.transaksi', ['type_menu' => 'laporan', 'transactions' => $transactions]);
        }
    }

    public function print_transaksi(LaporanTransaksiRequest $request)
    {
        $transactions = Transaction::when($request->has('tgl_awal'), function (Builder $query) use ($request) {
            return $query->whereDate('created_at', '>=', $request->query('tgl_awal'));
        })->when($request->has('tgl_akhir'), function (Builder $query) use ($request) {
            return $query->whereDate('created_at', '<=', $request->query('tgl_akhir'));
        })->get();

        $pdf = app('dompdf.wrapper')->loadView('pages.admin.laporan.print-transaksi', compact('transactions', 'request'));
        $pdf->setPaper('A4', 'potrait');
        $pdf->set_option("isPhpEnabled", true);

        return $pdf->stream('laporan transaksi.pdf');
    }
}
