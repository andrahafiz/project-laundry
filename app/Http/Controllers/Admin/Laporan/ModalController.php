<?php

namespace App\Http\Controllers\Admin\Laporan;

use Carbon\Carbon;
use App\Models\Modal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ModalStoreRequest;
use App\Http\Requests\ModalUpdateRequest;
use Illuminate\Database\Eloquent\Builder;

class ModalController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = Modal::when(
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
        return view('pages.admin.laporan.modal.index', ['type_menu' => 'laporan', 'data' => $data]);
    }


    public function create()
    {
        return view('pages.admin.laporan.modal.tambah', ['type_menu' => 'laporan']);
    }
    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(ModalStoreRequest $request)
    {
        $params = $request->safe([
            'modal_awal', 'laba_bersih', 'periode', 'modal_akhir'
        ]);
        DB::transaction(function () use ($params, $request) {
            $modal = Modal::updateOrCreate([
                'periode' => $params['periode'] . '-01',
            ], [
                'modal_awal' => $params['modal_awal'],
                'laba_bersih' => $params['laba_bersih'],
                'modal_akhir' => $params['modal_awal'] - $params['laba_bersih'],
                'periode' => $params['periode'] . '-01',
            ]);
        });
        return redirect()->route('admin.laporan.modal.index');
    }

    public function edit(Modal $modal)
    {
        return view('pages.admin.laporan.modal.edit', ['type_menu' => 'laporan', 'data' => $modal]);
    }
    /**
     * Store a newly created resource in storage.
     *
     */
    public function update(Modal $modal, ModalUpdateRequest $request)
    {
        $params = $request->safe([
            'modal_awal', 'laba_bersih', 'periode', 'modal_akhir'
        ]);

        DB::transaction(function () use ($params, $modal) {
            $modal = $modal->update([
                'modal_awal' => $params['modal_awal'],
                'laba_bersih' => $params['laba_bersih'],
                'modal_akhir' => $params['modal_awal'] - $params['laba_bersih'],
                'periode' => $params['periode'] . '-01',
            ]);
            return $modal;
        });

        return redirect()->route('admin.laporan.modal.index');
    }
}
