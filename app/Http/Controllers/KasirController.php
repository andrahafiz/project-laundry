<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    //

    public function index(Request $request)
    {
        $produks = Product::when($request->query('search'), function ($q) use ($request) {
            return $q->where('name_product', 'like', '%' . $request->query('search') . '%');
        })->paginate(8);
        return view('pages.kasir.kasir', ['type_menu' => 'kasir', 'produks' => $produks]);
    }

    function buktitransfer(Transaction $transaction)
    {
        return view('pages.kasir.transfer', ['type_menu' => 'kasir', 'transactions' => $transaction]);
    }

    public function uploadbuktitransfer(Request $request, Transaction $transaction)
    {

        try {
            DB::transaction(function () use ($request, $transaction) {
                $photo = $request->file('image');
                if ($photo instanceof UploadedFile) {
                    $file_path = storage_path() . '/app/' . $transaction->transfer_proof;
                    if (File::exists($file_path)) {
                        unlink($file_path);
                    }
                    $filename = $photo->store('public/photos/buktitransfer');
                } else {
                    $filename = $transaction->transfer_proof;
                    dd($transaction);
                };
                $transaction = $transaction->update([
                    'transfer_proof' => $filename ?? null,
                ]);
            });
            return redirect()->route('customer.transaksi.index')->with('success', "Bukti transfer berhasil diupload, harap menunggu konfirmasi");
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
