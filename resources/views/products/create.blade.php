@extends('layouts.app')

@section('title', 'Add Product')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Add New Product</h1>
    
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Product Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-3 py-2 border rounded">
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Description</label>
            <textarea name="description" rows="4" class="w-full px-3 py-2 border rounded">{{ old('description') }}</textarea>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium mb-2">Price</label>
                <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0" required class="w-full px-3 py-2 border rounded">
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">Stock</label>
                <input type="number" name="stock" value="{{ old('stock') }}" min="0" required class="w-full px-3 py-2 border rounded">
            </div>
        </div>
        
        <div class="mb-6">
            <label class="block text-sm font-medium mb-2">Product Image</label>
            <input type="file" name="image" accept="image/*" class="w-full px-3 py-2 border rounded">
        </div>
        
        <div class="flex space-x-4">
            <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Add Product
            </button>
            <a href="{{ route('products.index') }}" class="px-6 py-2 bg-gray-300 rounded hover:bg-gray-400">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection