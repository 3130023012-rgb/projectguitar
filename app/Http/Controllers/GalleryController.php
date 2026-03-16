<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->byType($request->type)
            ->when($request->status, fn($q, $s) => $q->where('status', $s))
            ->latest()
            ->paginate(12);

        return view('gallery', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        // Get related products (same type, exclude current)
        $related = Product::where('product_type', $product->product_type)
            ->where('id', '!=', $product->id)
            ->take(3)
            ->get();

        return view('gallery_detail', compact('product', 'related'));
    }
}
