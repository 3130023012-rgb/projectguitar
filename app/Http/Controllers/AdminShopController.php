<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminShopController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.shop_index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.shop_form', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:active,sale',
            'is_new' => 'nullable'
        ]);

        // Proses Spesifikasi (Key - Value)
        $specs = [];
        if ($request->specs_keys) {
            foreach ($request->specs_keys as $index => $key) {
                if (!empty($key)) {
                    $specs[$key] = $request->specs_vals[$index] ?? '';
                }
            }
        }
        $validated['specs'] = !empty($specs) ? $specs : null;

        // Proses Slug
        $validated['slug'] = Str::slug($request->name);

        // Proses Upload Gambar
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $validated['image'] = 'uploads/' . $filename;
        }

        // Checkbox is_new
        $validated['is_new'] = $request->has('is_new');

        Product::create($validated);

        return redirect()->route('admin.shop.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    // Method Edit: Variabel $product WAJIB sama dengan route parameter {shop} kalau pakai resource
    // Tapi biar aman, kita ubah nama variabelnya jadi $product di sini.
    // Laravel secara default akan mengirim variabel bernama $shop jika route resource-nya 'shop'.
    // Jadi di sini kita terima $shop, lalu kirim ke view sebagai $product.
    public function edit(Product $shop)
    {
        $product = $shop; // Rename variabel agar mudah di view
        $categories = Category::all();
        return view('admin.shop_form', compact('product', 'categories'));
    }

    public function update(Request $request, Product $shop)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:active,sale',
            'is_new' => 'nullable'
        ]);

        // Proses Spesifikasi
        $specs = [];
        if ($request->specs_keys) {
            foreach ($request->specs_keys as $index => $key) {
                if (!empty($key)) {
                    $specs[$key] = $request->specs_vals[$index] ?? '';
                }
            }
        }
        $validated['specs'] = !empty($specs) ? $specs : null;

        $validated['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            if ($shop->image && file_exists(public_path($shop->image))) {
                unlink(public_path($shop->image));
            }
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $validated['image'] = 'uploads/' . $filename;
        }

        $validated['is_new'] = $request->has('is_new');

        $shop->update($validated);

        return redirect()->route('admin.shop.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $shop)
    {
        if ($shop->image && file_exists(public_path($shop->image))) {
            unlink(public_path($shop->image));
        }
        $shop->delete();
        return back()->with('success', 'Produk berhasil dihapus.');
    }
}