@extends('layouts.app')

@section('title', 'Shop Dashboard')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">{{ $shop->name }}</h1>
        <a href="{{ route('shop.edit', $shop->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded">Edit Shop</a>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-blue-50 p-4 rounded">
            <h3 class="font-semibold text-lg">Total Products</h3>
            <p class="text-2xl font-bold text-blue-600">{{ $shop->products->count() }}</p>
        </div>
        <div class="bg-green-50 p-4 rounded">
            <h3 class="font-semibold text-lg">Actions</h3>
            <a href="{{ route('products.create') }}" class="text-green-600 hover:underline">Add Product</a>
        </div>
        <div class="bg-purple-50 p-4 rounded">
            <h3 class="font-semibold text-lg">View Shop</h3>
            <a href="{{ route('shop.show', $shop->id) }}" class="text-purple-600 hover:underline">Public View</a>
        </div>
    </div>
    
    <h2 class="text-xl font-bold mb-4">Recent Products</h2>
    @if($products->isEmpty())
        <p class="text-gray-500">No products yet. <a href="{{ route('products.create') }}" class="text-blue-600">Add your first product</a></p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($products as $product)
                <div class="border rounded p-4">
                    <h3 class="font-semibold">{{ $product->name }}</h3>
                    <p class="text-green-600 font-bold">${{ number_format($product->price, 2) }}</p>
                    <p class="text-sm text-gray-500">Stock: {{ $product->stock }}</p>
                </div>
            @endforeach
        </div>
        <div class="mt-4">
            <a href="{{ route('products.index') }}" class="text-blue-600 hover:underline">View All Products</a>
        </div>
    @endif
</div>
@endsection