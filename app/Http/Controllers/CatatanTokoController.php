<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\CatatanTokoStoreRequest;
use App\Http\Requests\Admin\CatatanTokoUpdateRequest;
use App\Models\CatatanToko;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CatatanTokoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = CatatanToko::paginate(15);
        return view('pages.admin.catatantoko.catatantoko', ['type_menu' => 'laporan', 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.catatantoko.tambah-catatantoko', ['type_menu' => 'laporan']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\CatatanTokoStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CatatanTokoStoreRequest $request)
    {
        $params = $request->safe([
            'nama', 'keterangan', 'tanggal', 'image'
        ]);
        DB::transaction(function () use ($params, $request) {
            $photo = $request->file('image');
            if ($photo instanceof UploadedFile) {
                $filename = $photo->store('public/photos/catatantoko');
            }

            $catatantoko = CatatanToko::create([
                'nama' => $params['nama'],
                'keterangan' => $params['keterangan'],
                'tanggal' => $params['tanggal'],
                'image' => $filename ?? 'no-image.jpg'
            ]);
        });
        return redirect()->route('admin.catatantoko.index')->with('success', "Data produk berhasil ditambahkan");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CatatanToko  $catatantoko
     * @return \Illuminate\Http\Response
     */
    public function edit(CatatanToko $catatantoko)
    {
        return view('pages.admin.catatantoko.edit-catatantoko', [
            'type_menu' => 'laporan',
            'data' => $catatantoko,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CatatanToko  $catatantoko
     * @return \Illuminate\Http\Response
     */
    public function update(CatatanTokoUpdateRequest $request, CatatanToko $catatantoko)
    {
        $params = $request->safe([
            'nama', 'keterangan', 'tanggal', 'image'
        ]);
        try {
            DB::transaction(function () use ($params, $request, $catatantoko) {
                $photo = $request->file('image');
                if ($photo instanceof UploadedFile) {
                    $file_path = storage_path() . '/app/' . $catatantoko->image;
                    if (File::exists($file_path)) {
                        unlink($file_path);
                    }
                    $filename = $photo->store('public/photos/catatantoko');
                } else {
                    $filename = $catatantoko->image;
                };

                $catatantoko = $catatantoko->update([
                    'nama' => $params['nama'],
                    'keterangan' => $params['keterangan'],
                    'tanggal' => $params['tanggal'],
                    'image' => $filename
                ]);
            });
            return redirect()->route('admin.catatantoko.index')->with('success', "Data catatan toko berhasil diubah");
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CatatanToko  $catatantoko
     * @return \Illuminate\Http\Response
     */
    public function destroy(CatatanToko $catatantoko)
    {
        $file_path = storage_path() . '/app/' . $catatantoko->image;
        if (File::exists($file_path)) {
            unlink($file_path);
        }
        $catatantoko->delete();
        return redirect()->route('admin.catatantoko.index')->with('success', "Data berhasil dihapus");
    }
}
