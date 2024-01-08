<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
