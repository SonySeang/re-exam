@extends('layouts.app')

@section('title', 'Explore Products')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Explore Products</h1>
        <p class="text-xl text-gray-600">Discover amazing products from our verified shops</p>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Search Products</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Shop</label>
                <select name="shop" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">All Shops</option>
                    @foreach($shops as $shop)
                        <option value="{{ $shop->id }}" {{ request('shop') == $shop->id ? 'selected' : '' }}>
                            {{ $shop->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Price Range</label>
                <div class="flex space-x-2">
                    <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="Min" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="Max" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition duration-300">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
            </div>
        </form>
        @if(request()->hasAny(['search', 'shop', 'price_min', 'price_max']))
            <div class="mt-4">
                <a href="{{ route('products.explore') }}" class="text-indigo-600 hover:text-indigo-800">
                    <i class="fas fa-times mr-1"></i>Clear Filters
                </a>
            </div>
        @endif
    </div>

    <!-- Products Grid -->
    @if($products->isEmpty())
        <div class="text-center py-12">
            <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No products found</h3>
            <p class="text-gray-500">Try adjusting your search criteria</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-3xl"></i>
                        </div>
                    @endif
                    
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-indigo-600 font-medium">{{ $product->shop->name }}</span>
                            @if($product->stock > 0)
                                <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">In Stock</span>
                            @else
                                <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded-full">Out of Stock</span>
                            @endif
                        </div>
                        
                        <h3 class="font-semibold text-lg text-gray-900 mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ Str::limit($product->description, 80) }}</p>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-green-600">${{ number_format($product->price, 2) }}</span>
                            <a href="{{ route('shop.show', $product->shop->id) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition duration-300 text-sm">
                                View Shop
                            </a>
                        </div>
                        
                        <div class="mt-3 text-xs text-gray-500">
                            <i class="fas fa-boxes mr-1"></i>Stock: {{ $product->stock }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $products->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection