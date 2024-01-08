<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cart;
use App\Helpers\Helper;
use App\Models\Feedback;
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
        $uang = $request->inp_uang ?? 0;
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

                // Menambahkan data feedback
                $feedback =  Feedback::create([
                    'transactions_id' => $transaction->id,
                    'code'            => $this->generateCodeNumber(),
                    'customer_name'   => $request->customer_name,
                    'nohp_customer'   => $request->nohp_customer,
                    'user_id'         => $user,
                ]);

                $this->sendWhatsapp($request, $feedback);
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

    function sendWhatsapp($request, $feedback)
    {
        $name = ucfirst($request->customer_name);
        $nohp = $request->nohp_customer;
        $linkfeedback = config('app.url') . "feedback/" . $feedback->code;
        $response = Http::withHeaders([
            'Authorization' => env('Wa_Authorization')
        ])->post('https://api.fonnte.com/send', [
            'target' => "$nohp|$name",
            'message' => 'Terima kasih {name} telah membeli produk di Alrescha Wash. Jangan lupa mengisi ulasan untuk membantu kami meningkatkan pelayanan.
            Beri ulasan mu pada link berikut ' . $linkfeedback . ' .
            Terima kasih atas ketersediaan Anda mengisi kolom ulasan. Semua kritik dan saran yang disampaikan akan menjadi bahan evaluasi bagi kami.',
            'delay' => '2',
            'countryCode' => '62',
        ]);
        Log::info($response);
    }

    function generateCodeNumber()
    {
        $number = mt_rand(1000000000, 9999999999);

        if ($this->codeNumberExists($number)) {
            return $this->generateCodeNumber();
        }

        return $number;
    }

    function codeNumberExists($number)
    {
        return Feedback::whereCode($number)->exists();
    }
}
