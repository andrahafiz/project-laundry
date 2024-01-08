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
        // dd($this->feedback_4());
        $data = [
            'totalOrder' => $this->totalOrder(),
            'profit' => $this->profit(),
            'totalProduct' => $this->totalProduk(),
            'topThreeProduct' => $this->topThreeProduct(),
            'transactions' => $this->trancastion(),
            'feedbacks' => $this->feedback(),
            'chartTransactions' => $this->chartTransaction(),
            'Pertanyaan1' => $this->feedback_1(),
            'Pertanyaan2' => $this->feedback_2(),
            'Pertanyaan3' => $this->feedback_3(),
            'Pertanyaan4' => $this->feedback_4(),
            'Pertanyaan5' => $this->feedback_5(),
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

    public function feedback()
    {
        $feedback = Feedback::with('transaction')->orderBy('created_at', 'desc')->take(3)->get();
        return $feedback;
    }

    function feedback_1()
    {
        $pertanyaan_1 = Feedback::select('jawaban1', DB::raw('count(*) as total'))
            ->without(['transaction', 'user'])
            ->groupBy('jawaban1')
            ->get()->pluck('total', 'jawaban1');
        $labels = $pertanyaan_1->keys();
        $data  = $pertanyaan_1->values();
        $row = [
            'labels' => $labels,
            'data' => $data
        ];
        return $row;
    }

    function feedback_2()
    {
        $pertanyaan_2 = Feedback::select('jawaban2', DB::raw('count(*) as total'))
            ->without(['transaction', 'user'])
            ->groupBy('jawaban2')
            ->get()->pluck('total', 'jawaban2');
        $labels = $pertanyaan_2->keys();
        $data  = $pertanyaan_2->values();
        $row = [
            'labels' => $labels,
            'data' => $data
        ];
        return $row;
    }

    function feedback_3()
    {
        $pertanyaan_3 = Feedback::select('jawaban3', DB::raw('count(*) as total'))
            ->without(['transaction', 'user'])
            ->groupBy('jawaban3')
            ->get()->pluck('total', 'jawaban3');
        $labels = $pertanyaan_3->keys();
        $data  = $pertanyaan_3->values();
        $row = [
            'labels' => $labels,
            'data' => $data
        ];
        return $row;
    }

    function feedback_4()
    {
        $pertanyaan_4 = Feedback::select('jawaban4', DB::raw('count(*) as total'))
            ->without(['transaction', 'user'])
            ->groupBy('jawaban4')
            ->get()->pluck('total', 'jawaban4');
        $labels = $pertanyaan_4->keys();
        $data  = $pertanyaan_4->values();
        $row = [
            'labels' => $labels,
            'data' => $data
        ];
        return $row;
    }

    function feedback_5()
    {
        $pertanyaan_5 = Feedback::select('jawaban5', DB::raw('count(*) as total'))
            ->without(['transaction', 'user'])
            ->groupBy('jawaban5')
            ->get()->pluck('total', 'jawaban5');
        $labels = $pertanyaan_5->keys();
        $data  = $pertanyaan_5->values();
        $row = [
            'labels' => $labels,
            'data' => $data
        ];
        return $row;
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
