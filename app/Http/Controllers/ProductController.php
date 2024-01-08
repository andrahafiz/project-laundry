<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ImageProduct;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Customer\ProdukCreateRequest;
use App\Http\Requests\Customer\ProdukUpdateRequest;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * @var \App\Models\Product
     */
    protected $productModel;

    /**
     * @var \App\Models\Category
     */
    protected $categoryProductModel;

    public function __construct(
        Product $productModel,
        Category $categoryProductModel,
    ) {
        $this->productModel = $productModel;
        $this->categoryProductModel = $categoryProductModel;
    }

    public function index()
    {
        $products = $this->productModel->latest()->get();
        return view('pages.customer.produk.produk', ['type_menu' => '', 'products' => $products]);
    }

    public function create()
    {
        //
        $category = $this->categoryProductModel->get();
        return view('pages.customer.produk.tambah-produk', ['type_menu' => '', 'categorys' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Customer\ProdukCreateRequest  $request
     */
    public function store(ProdukCreateRequest $request)
    {
        $params = $request->safe([
            'nama', 'category', 'deskripsi', 'stok', 'harga', 'image'
        ]);
        DB::transaction(function () use ($params, $request) {
            $photo = $request->file('image');
            if ($photo instanceof UploadedFile) {
                $filename = $photo->store('public/photos/product');
            }

            $product = $this->productModel->create([
                'name_product' => $params['nama'],
                'slug' => Str::slug($params['nama']),
                'categories_id' => $params['category'],
                'description' => $params['deskripsi'],
                'stock' => $params['stok'],
                'price' => $params['harga'],
                'image' => $filename ?? 'no-image.jpg'
            ]);
        });
        return redirect()->route('customer.produk.index')->with('success', "Data produk berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     *
     */
    public function show(Product $product)
    {
        //
        // return $product;
        return view('pages.customer.produk.detail-produk', ['type_menu' => '', 'product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     */
    public function edit(Product $product)
    {
        $category = $this->categoryProductModel->get();
        return view('pages.customer.produk.edit-produk', [
            'type_menu' => '',
            'product' => $product,
            'categorys' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Customer\ProdukUpdateRequest $request
     * @param  \App\Models\Product  $product
     */
    public function update(ProdukUpdateRequest $request, Product $product)
    {
        $params = $request->safe([
            'nama', 'category', 'deskripsi', 'stok', 'harga', 'image'
        ]);
        try {
            DB::transaction(function () use ($params, $request, $product) {
                $photo = $request->file('image');
                if ($photo instanceof UploadedFile) {
                    $file_path = storage_path() . '/app/' . $product->image;
                    if (File::exists($file_path)) {
                        unlink($file_path);
                    }
                    $filename = $photo->store('public/photos/product');
                } else {
                    $filename = $product->image;
                };

                $product = $product->update([
                    'name_product' => $params['nama'],
                    'slug' => Str::slug($params['nama']),
                    'categories_id' => $params['category'],
                    'description' => $params['deskripsi'],
                    'stock' => $params['stok'],
                    'price' => $params['harga'],
                    'image' => $filename
                ]);
            });
            return redirect()->route('customer.produk.index')->with('success', "Data produk '{$product->name_product}' berhasil diubah");
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('customer.produk.index')->with('success', "Data produk '{$product->name_product}' berhasil dihapus");
    }
}
