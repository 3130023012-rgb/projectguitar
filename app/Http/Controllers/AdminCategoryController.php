<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    // Tampil list kategori
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category_index', compact('categories'));
    }

    // Simpan kategori baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Buat slug otomatis (opsional, agar URL rapi)
        $validated['slug'] = \Str::slug($request->name);

        Category::create($validated);

        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Hapus kategori
    public function destroy(Category $category)
    {
        // Cek jika kategori masih dipakai produk
        if ($category->products()->count() > 0) {
            return back()->with('error', 'Tidak bisa menghapus! Kategori ini masih memiliki produk.');
        }

        $category->delete();
        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}