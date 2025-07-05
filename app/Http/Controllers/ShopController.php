<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    public function create()
    {
        return view('shop.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        Shop::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'logo' => $logoPath,
        ]);

        return redirect()->route('shop.dashboard')->with('success', 'Shop created successfully!');
    }

    public function show($id)
    {
        $shop = Shop::with('products')->findOrFail($id);
        return view('shop.show', compact('shop'));
    }

    public function edit($id)
    {
        $shop = Shop::where('user_id', Auth::id())->findOrFail($id);
        return view('shop.edit', compact('shop'));
    }

    public function update(Request $request, $id)
    {
        $shop = Shop::where('user_id', Auth::id())->findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $logoPath = $shop->logo;
        if ($request->hasFile('logo')) {
            if ($logoPath) {
                Storage::disk('public')->delete($logoPath);
            }
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        $shop->update([
            'name' => $request->name,
            'description' => $request->description,
            'logo' => $logoPath,
        ]);

        return redirect()->route('shop.dashboard')->with('success', 'Shop updated successfully!');
    }

    public function dashboard()
    {
        $shop = Auth::user()->shop;
        if (!$shop) {
            return redirect()->route('shop.create');
        }
        
        $products = $shop->products()->paginate(10);
        return view('shop.dashboard', compact('shop', 'products'));
    }

    public function adminIndex()
    {
        $shops = Shop::with('user')->paginate(10);
        return view('admin.shops', compact('shops'));
    }

    public function publicIndex()
    {
        $shops = Shop::withCount('products')->paginate(12);
        return view('shops.index', compact('shops'));
    }
}