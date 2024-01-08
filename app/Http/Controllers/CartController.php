<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Helpers\Helper;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\CartRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::with('product')->where('users_id',  Auth::user()->id)->get();
        return view('pages.cart.cart', ['type_menu' => 'cart', 'carts' => $cart]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CartRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CartRequest $request)
    {
        try {
            $input = $request->safe([
                'products_id'
            ]);
            DB::transaction(function () use ($input) {
                $data = [
                    'products_id' => $input['products_id'],
                    'users_id' => Auth::user()->id
                ];

                $cart = Cart::select('qty')
                    ->where('products_id', $input['products_id'])
                    ->where('users_id', Auth::user()->id)
                    ->first();

                $cart = Cart::updateOrCreate([
                    'products_id' => $input['products_id'],
                    'users_id' => Auth::user()->id
                ], [
                    'qty' => empty($cart) ? 1 : $cart->qty + 1
                ]);
            });
            return redirect()->route(Helper::AdminOrUser('kasir.index'))->with('success', "Data telah berhasil dimasukan ke keranjang");
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function updateStock(Cart $cart, Request $request)
    {
        $cart->qty = $request->qty;
        $cart->save();
        return response()->json([
            'success' => true,
            'message' => 'Qty diberhasil diupdate!',
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->route(Helper::AdminOrUser('cart.index'))->with('success', 'Produk berhasil di hapus dari keranjang');
    }
}
