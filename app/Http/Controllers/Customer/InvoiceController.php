<?php

namespace App\Http\Controllers\Customer;

use PDF;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function invoice(Transaction $transaction)
    {
        $total = 0;
        $transaction;
        foreach ($transaction->items as $item) {
            $total += $item->total;
        }
        if ($total != $transaction->total_price) {
            return redirect()->route('admin.transaksi.index')->withErrors(['error' => 'Terjadi Kesalahan Mengambil Data Invoice']);
        } else {
            return view('pages.transaksi.invoice', ['type_menu' => 'transaksi', 'transactions' => $transaction]);
        }
    }

    public function print_invoice(Transaction $transaction)
    {
        $transactions = $transaction;
        $pdf = app('dompdf.wrapper')->loadView('pages.transaksi.invoice-print', compact('transactions'));
        $pdf->setPaper('A4', 'potrait');


        return $pdf->stream('techsolutionstuff.pdf');
    }
}
