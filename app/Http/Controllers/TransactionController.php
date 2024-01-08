<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $transactions = Transaction::orderBy('created_at', 'desc')->get();
        return view('pages.transaksi.transaksi', ['type_menu' => 'transaksi', 'transactions' => $transactions]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return view('pages.transaksi.kelola-transaksi', ['type_menu' => '', 'transactions' => $transaction]);
    }


    public function update(Request $request, Transaction $transaction)
    {
        $kembalian = str_replace('.', '', str_replace('Rp. ', '', $request->uang_kembalian ?? 0));
        try {
            DB::transaction(function () use ($transaction, $request, $kembalian) {
                $transaction->update([
                    'money' => $request->inp_uang ?? 0,
                    'change' => $kembalian ?? 0,
                    'status_transactions' => $request->status,
                ]);
            });
            return redirect()->route(Helper::AdminOrUser('transaksi.index'))->with('success', "Data transaksi INV/'{$transaction->id}' berhasil diubah");
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        try {
            DB::transaction(function () use ($transaction) {
                foreach ($transaction->items as $row) {
                    $product = Product::find($row->products_id);
                    $product->update([
                        'stock' => $product->stock + $row->qty
                    ]);
                }
                $transaction->delete();
            });
            return redirect()->route(Helper::AdminOrUser('transaksi.index'))->with('success', "Data transaksi INV/'{$transaction->id}' berhasil diubah");
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
