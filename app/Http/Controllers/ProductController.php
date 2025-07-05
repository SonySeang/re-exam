<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $shop = Auth::user()->shop;
        if (!$shop) {
            return redirect()->route('shop.create')->with('error', 'You need to create a shop first.');
        }
        $query = $shop->products();

        if ($request->has('name') && $request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->has('price_min') && $request->price_min) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->has('price_max') && $request->price_max) {
            $query->where('price', '<=', $request->price_max);
        }

        $products = $query->paginate(10);
        return view('products.index', compact('products', 'shop'));
    }

    public function create()
    {
        if (!Auth::user()->shop) {
            return redirect()->route('shop.create')->with('error', 'You need to create a shop first.');
        }
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $shop = Auth::user()->shop;
        if (!$shop) {
            return redirect()->route('shop.create')->with('error', 'You need to create a shop first.');
        }

        Product::create([
            'shop_id' => $shop->id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function edit($id)
    {
        $product = Product::whereHas('shop', function($query) {
            $query->where('user_id', Auth::id());
        })->findOrFail($id);
        
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::whereHas('shop', function($query) {
            $query->where('user_id', Auth::id());
        })->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::whereHas('shop', function($query) {
            $query->where('user_id', Auth::id());
        })->findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

    public function adminIndex()
    {
        $products = Product::with('shop.user')->paginate(10);
        return view('admin.products', compact('products'));
    }

    public function explore(Request $request)
    {
        $query = Product::with('shop');

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('shop') && $request->shop) {
            $query->where('shop_id', $request->shop);
        }

        if ($request->has('price_min') && $request->price_min) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->has('price_max') && $request->price_max) {
            $query->where('price', '<=', $request->price_max);
        }

        $products = $query->paginate(12);
        $shops = \App\Models\Shop::all();
        
        return view('products.explore', compact('products', 'shops'));
    }
}