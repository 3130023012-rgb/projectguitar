<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // 1. Query dasar untuk produk
        $query = Product::with('category')->latest();

        // 2. Filter jika ada kategori yang dipilih
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // 3. Ambil data
        $products = $query->paginate(12); // Paginate agar tidak berat
        $categories = Category::withCount('products')->get();
        
        // Untuk badge di sidebar
        $saleProducts = Product::where('status', 'sale')->latest()->take(3)->get();
        $newProducts = Product::where('is_new', true)->latest()->take(3)->get();

        // Tentukan kategori aktif untuk highlight sidebar
        $activeCategory = $request->category ?? null;

        return view('shop', compact(
            'products', 
            'categories', 
            'saleProducts', 
            'newProducts', 
            'activeCategory'
        ));
    }

    // API untuk mengambil detail produk saat diklik (Ajax)
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return response()->json($product);
    }
}