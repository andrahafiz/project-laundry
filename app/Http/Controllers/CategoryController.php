<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\Customer\CategoryCreateRequest;
use App\Http\Requests\Customer\CategoryUpdateRequest;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * @var \App\Models\Category
     */
    protected $categoryProductModel;

    public function __construct(
        Category $categoryProductModel,
    ) {
        $this->categoryProductModel = $categoryProductModel;
    }

    public function index()
    {
        $category_produk = $this->categoryProductModel->get();
        return view('pages.customer.kategori_produk.kategori_produk', ['type_menu' => '', 'category_products' => $category_produk]);
    }

    public function create()
    {
        return view('pages.customer.kategori_produk.tambah_kategori_produk', ['type_menu' => '']);
    }

    public function store(CategoryCreateRequest $request)
    {
        $params = $request->safe([
            'nama', 'code'
        ]);
        try {
            DB::transaction(function () use ($params, $request) {
                $this->categoryProductModel->create([
                    'category' => $params['nama'],
                    'slug'     => Str::slug($params['nama']),
                    'code'     => Str::upper($params['code']),
                ]);
            });
            return redirect()->route('customer.kategori-produk.index')
                ->with('success', "Data kategori produk berhasil ditambah");
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit(Category $category)
    {
        return view('pages.customer.kategori_produk.edit_kategori_produk', [
            'type_menu' => '',
            'category' => $category
        ]);
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $params = $request->safe([
            'nama', 'code'
        ]);
        try {
            DB::transaction(function () use ($params, $request, $category) {
                $category = $category->update([
                    'category' => $params['nama'],
                    'slug' => Str::slug($params['nama']),
                    'code' => Str::upper($params['code']),
                ]);
            });
            return redirect()->route('customer.kategori-produk.index')
                ->with('success', "Data kategori produk '{$category->category}' berhasil diubah");
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('customer.kategori-produk.index')
                ->with('success', "Data kategori produk '{$category->category}' berhasil dihapus");
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
