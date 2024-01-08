<?php

namespace App\Http\Controllers\Customer;

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
        // dd($this->chartTransaction());
        $data = [
            'totalOrder' => $this->totalOrder(),
            'profit' => $this->profit(),
            'totalProduct' => $this->totalProduk(),
            'topThreeProduct' => $this->topThreeProduct(),
            'transactions' => $this->trancastion(),
            'feedbacks' => $this->feedback(),
            'chartTransactions' => $this->chartTransaction()
        ];
        return view('pages.customer.dashboard', ['type_menu' =>
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
        // $data = Transaction::
        $sales = DB::table('products')
            ->leftJoin('transaction_details', 'products.id', '=', 'transaction_details.products_id')
            ->selectRaw('products.*, COALESCE(sum(transaction_details.qty),0) total')
            ->whereMonth('transaction_details.created_at', Carbon::now()->month)
            ->groupBy('products.id')
            ->orderBy('total', 'desc')
            ->having('total', '!=', 0)
            ->take(5)
            ->get();

        return $sales;
    }

    public function trancastion()
    {
        $transactions = Transaction::orderBy('created_at', 'desc')->take(5)->get();
        return $transactions;
    }

    public function feedback()
    {
        $feedback = Feedback::with('transaction')->orderBy('created_at', 'desc')->take(3)->get();
        return $feedback;
    }

    public function chartTransaction()
    {
        $row = DB::table('transactions')
            ->select(DB::raw('year(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('sum(total_price) as total'))
            ->groupBy('year', 'month')
            ->having('year', now()->format('Y'))
            ->orderBy('year')
            ->orderBy('month')
            ->pluck('total', 'month');
        $labels = $row->keys();
        $data  = $row->values();
        $row = [
            'labels' => $labels,
            'data' => $data
        ];
        return $row;
    }
}
