<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Models\Profit;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfitStoreRequest;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ProfitLossController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = Profit::when(
            $request->has('date'),
            function (Builder $query) use ($request) {
                $date = $request->date('date');
                return $query->whereYear('periode', '=', $date->format('Y'))
                    ->whereMonth('periode', '=', $date->format('m'));
            },
            function ($query) {
                return $query->whereYear('periode', '=', now()->format('Y'))
                    ->whereMonth('periode', '=', now()->format('m'));
            }
        )->first();
        // dd(Helper::formatRupiah($data->penjualan_bersih));
        return view('pages.admin.laporan.profitloss.index', ['type_menu' => 'laporan', 'data' => $data]);
    }


    public function create()
    {
        return view('pages.admin.laporan.profitloss.tambah', ['type_menu' => 'laporan']);
    }
    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(ProfitStoreRequest $request)
    {
        $params = $request->safe([
            'penjualan_bersih', 'sewa_ruko', 'beban_lain', 'beban_air', 'beban_listrik', 'beban_gaji', 'total_beban', 'pajak', 'laba_bersih', 'periode'
        ]);
        // dd($request->all());
        DB::transaction(function () use ($params, $request) {
            $profitloss = Profit::updateOrCreate([
                'periode' => $params['periode'] . '-01',
            ], [
                'penjualan_bersih'  => $params['penjualan_bersih'],
                'beban_listrik'     => $params['beban_listrik'],
                'sewa_ruko'         => $params['sewa_ruko'],
                'beban_lain'        => $params['beban_lain'],
                'beban_air'         => $params['beban_air'],
                'beban_gaji'        => $params['beban_gaji'],
                'total_beban'       => $params['total_beban'],
                'laba_bersih'       => $params['laba_bersih'],
                'pajak'             => $params['pajak'],
                'periode'           => $params['periode'] . '-01',
            ]);
        });
        return redirect()->route('admin.laporan.profitloss.index');
    }

    public function edit(Profit $profitloss)
    {
        return view('pages.admin.laporan.profitloss.edit', ['type_menu' => 'laporan', 'data' => $profitloss]);
    }
}
