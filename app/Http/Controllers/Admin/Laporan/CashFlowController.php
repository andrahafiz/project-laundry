<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Models\CashFlow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\CashFlowStoreRequest;
use App\Http\Requests\CashFlowUpdateRequest;

class CashFlowController extends Controller
{
    public function index(Request $request)
    {
        // when($request->has('search'), function (Builder $query) use ($request) {
        //     return $query->where('name', 'ilike', '%' . $request->query('name') . '%');
        // })

        $data = CashFlow::when($request->has('start_date'), function (Builder $query) use ($request) {
            return $query->whereDate('tanggal', '>=', $request->query('start_date'));
        })->when($request->has('end_date'), function (Builder $query) use ($request) {
            return $query->whereDate('tanggal', '<=', $request->query('end_date'));
        })->get();
        $pengeluaran = 0;
        $pemasukan = 0;
        foreach ($data as $row) {
            $pengeluaran += $row->pengeluaran;
            $pemasukan += $row->pemasukan;
        }
        $total = $pemasukan - $pengeluaran;
        return view('pages.admin.laporan.cashflow.index', ['type_menu' => 'laporan', 'data' => $data, 'total' => $total]);
    }


    public function create()
    {
        return view('pages.admin.laporan.cashflow.tambah', ['type_menu' => 'laporan']);
    }
    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(CashFlowStoreRequest $request)
    {
        $params = $request->safe([
            'no_akun', 'tanggal', 'keterangan', 'jumlah', 'jenis'
        ]);
        DB::transaction(function () use ($params, $request) {
            $cashflow = CashFlow::create([
                'no_akun' => $params['no_akun'],
                'tanggal' => $params['tanggal'],
                'keterangan' => $params['keterangan'],
                'pemasukan' => $params['jenis'] == 1 ? $params['jumlah'] : 0,
                'pengeluaran' => $params['jenis'] == 2 ? $params['jumlah'] : 0,
            ]);
        });
        return redirect()->route('admin.laporan.cashflow.index');
    }

    public function edit(CashFlow $cashflow)
    {
        return view('pages.admin.laporan.cashflow.edit', ['type_menu' => 'laporan', 'data' => $cashflow]);
    }
    /**
     * Store a newly created resource in storage.
     *
     */
    public function update(CashFlow $cashflow, CashFlowUpdateRequest $request)
    {
        $params = $request->safe([
            'no_akun', 'tanggal', 'keterangan', 'jumlah', 'jenis'
        ]);

        DB::transaction(function () use ($params, $cashflow) {
            $cashflow = $cashflow->update([
                'no_akun' => $params['no_akun'],
                'tanggal' => $params['tanggal'],
                'keterangan' => $params['keterangan'],
                'pemasukan' => $params['jenis'] == 1 ? $params['jumlah'] : 0,
                'pengeluaran' => $params['jenis'] == 2 ? $params['jumlah'] : 0,
            ]);
            return $cashflow;
        });

        return redirect()->route('admin.laporan.cashflow.index');
    }

    public function destroy(CashFlow $cashflow)
    {
        try {
            $cashflow->delete();
            return redirect()->route('admin.laporan.cashflow.index')
                ->with('success', "Data  berhasil dihapus");
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
