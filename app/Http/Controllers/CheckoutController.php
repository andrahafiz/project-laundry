<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cart;
use App\Helpers\Helper;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\CheckoutStoreRequest;

class CheckoutController extends Controller
{
    //

    public function store(CheckoutStoreRequest $request)
    {
        $uang = $request->metode_pembayaran == 0 ? 0 : $request->totalPrice;
        $kembalian = str_replace('.', '', str_replace('Rp. ', '', $request->uang_kembalian));
        $carts = Cart::with(['product', 'user'])
            ->where('users_id', Auth::user()->id)
            ->get();
        try {
            $transaction = null;
            DB::transaction(function () use ($request, $carts, $uang, $kembalian, &$transaction) {
                //tambah data transaksi

                $user = Auth::user()->id;
                $transaction = Transaction::create([
                    'users_id' => $user,
                    'order_type' => $request->tipe_order,
                    'payment_method' => $request->metode_pembayaran,
                    'total_price' => $request->totalPrice ?? 0,
                    'money' => $uang ?? 0,
                    'change' => $kembalian != '' ? $kembalian : 0
                ]);

                //tambah data transaksi detail dengan melooping cart dengan id user yang sedang login
                foreach ($carts as $cart) {
                    TransactionDetail::create([
                        'transactions_id' => $transaction->id,
                        'products_id' => $cart->products_id,
                        'qty' => $cart->qty,
                        'total' => $cart->product->price *  $cart->qty
                    ]);
                }

                // Delete cart data dengan id user yang sedang login
                Cart::with(['product', 'user'])
                    ->where('users_id', $user)
                    ->delete();
            });
            if ($transaction['payment_method'] == 1) {
                return redirect()->route('customer.buktitransfer', $transaction['id'])->with('success', "Transaksi Selesai, Silahkan Upload Bukti Transfer");
            } else {
                return redirect()->route('customer.transaksi.index')->with('success', "Transaksi Selesai");
            }
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
}
