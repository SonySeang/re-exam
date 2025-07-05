@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Products</h1>
        <a href="{{ route('products.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded">Add Product</a>
    </div>

    <!-- Filter Form -->
    <form method="GET" class="mb-6 bg-gray-50 p-4 rounded">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium mb-2">Product Name</label>
                <input type="text" name="name" value="{{ request('name') }}" placeholder="Search by name" class="w-full px-3 py-2 border rounded">
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">Min Price</label>
                <input type="number" name="price_min" value="{{ request('price_min') }}" step="0.01" class="w-full px-3 py-2 border rounded">
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">Max Price</label>
                <input type="number" name="price_max" value="{{ request('price_max') }}" step="0.01" class="w-full px-3 py-2 border rounded">
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded">Filter</button>
            <a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-300 rounded ml-2">Clear</a>
        </div>
    </form>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($products as $product)
            <div class="border rounded-lg p-4">
                @if($product->image)
                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded mb-4">
                @endif
                <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
                <p class="text-gray-600 mb-2">{{ Str::limit($product->description, 100) }}</p>
                <p class="text-xl font-bold text-green-600">${{ number_format($product->price, 2) }}</p>
                <p class="text-sm text-gray-500">Stock: {{ $product->stock }}</p>
                <div class="mt-4 flex space-x-2">
                    <a href="{{ route('products.edit', $product->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded text-sm">Edit</a>
                    <form method="POST" action="{{ route('products.destroy', $product->id) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" class="px-3 py-1 bg-red-500 text-white rounded text-sm">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>
@endsection