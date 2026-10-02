<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('aktif', true)
            ->orderBy('nama')
            ->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'harga_coret' => 'nullable|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'aktif' => 'nullable|boolean',
            'unggulan' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['nama']);

        $baseSlug = $validated['slug'];
        $counter = 1;

        while (Product::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $baseSlug . '-' . $counter++;
        }

        $validated['aktif'] = $request->boolean('aktif');
        $validated['unggulan'] = $request->boolean('unggulan');

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request
                ->file('gambar')
                ->store('produk', 'public');
        }

        Product::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::where('aktif', true)
            ->orderBy('nama')
            ->get();

        return view('admin.products.edit', compact(
            'product',
            'categories'
        ));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'harga_coret' => 'nullable|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'aktif' => 'nullable|boolean',
            'unggulan' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['nama']);

        $baseSlug = $validated['slug'];
        $counter = 1;

        while (
            Product::where('slug', $validated['slug'])
                ->where('id', '!=', $product->id)
                ->exists()
        ) {
            $validated['slug'] = $baseSlug . '-' . $counter++;
        }

        $validated['aktif'] = $request->boolean('aktif');
        $validated['unggulan'] = $request->boolean('unggulan');

        if ($request->hasFile('gambar')) {
            if (
                $product->gambar &&
                Storage::disk('public')->exists($product->gambar)
            ) {
                Storage::disk('public')->delete($product->gambar);
            }

            $validated['gambar'] = $request
                ->file('gambar')
                ->store('produk', 'public');
        }

        $product->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if (
            $product->gambar &&
            Storage::disk('public')->exists($product->gambar)
        ) {
            Storage::disk('public')->delete($product->gambar);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
