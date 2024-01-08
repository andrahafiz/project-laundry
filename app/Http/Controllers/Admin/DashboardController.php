<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Feedback;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $data = [
            'totalOrder' => $this->totalOrder(),
            'profit' => $this->profit(),
            'totalProduct' => $this->totalProduk(),
            'topThreeProduct' => $this->topThreeProduct(),
            'transactions' => $this->trancastion(),
            'chartTransactions' => $this->chartTransaction(),
        ];

        return view('pages.admin.dashboard', ['type_menu' =>
        'dashboard', 'data' => $data]);
    }

    public function totalOrder()
    {
        $data = Transaction::whereMonth('created_at', Carbon::now()->month)->get();
        return $data->count();
    }
    public function totalProduk()
    {
        $data = TransactionDetail::whereMonth('created_at', Carbon::now()->month)->sum('qty');
        return $data;
    }

    public function profit()
    {
        $data = Transaction::whereMonth('created_at', Carbon::now()->month)->sum('total_price');
        return $data;
    }
    public function topThreeProduct()
    {
        $sales = DB::table('products')
            ->leftJoin('transaction_details', 'products.id', '=', 'transaction_details.products_id')
            ->selectRaw('products.id,products.image,products.name_product,SUM(transaction_details.qty) as qty')
            ->groupBy('products.id')
            ->orderBy('qty', 'desc')
            ->get();

        return $sales;
    }

    public function trancastion()
    {
        $transactions = Transaction::orderBy('created_at', 'desc')->take(5)->get();
        return $transactions;
    }


    public function chartTransaction()
    {
        $row = DB::table('transactions')
            ->select(DB::raw('year(created_at) as year'), DB::raw('sum(total_price) as total'))
            ->groupBy('year')
            ->orderBy('year')
            ->pluck('total', 'year');
        $labels = $row->keys();
        $data  = $row->values();
        $row = [
            'labels' => $labels,
            'data' => $data
        ];
        return $row;
    }
}
