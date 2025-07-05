@extends('layouts.app')

@section('title', 'Edit Shop')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Edit Shop</h1>
    
    <form method="POST" action="{{ route('shop.update', $shop->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Shop Name</label>
            <input type="text" name="name" value="{{ old('name', $shop->name) }}" required class="w-full px-3 py-2 border rounded">
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Description</label>
            <textarea name="description" rows="4" class="w-full px-3 py-2 border rounded">{{ old('description', $shop->description) }}</textarea>
        </div>
        
        <div class="mb-6">
            <label class="block text-sm font-medium mb-2">Logo</label>
            @if($shop->logo)
                <div class="mb-2">
                    <img src="{{ Storage::url($shop->logo) }}" alt="Current logo" class="w-32 h-32 object-cover rounded">
                    <p class="text-sm text-gray-500">Current logo</p>
                </div>
            @endif
            <input type="file" name="logo" accept="image/*" class="w-full px-3 py-2 border rounded">
            <p class="text-sm text-gray-500">Leave empty to keep current logo</p>
        </div>
        
        <div class="flex space-x-4">
            <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Update Shop
            </button>
            <a href="{{ route('shop.dashboard') }}" class="px-6 py-2 bg-gray-300 rounded hover:bg-gray-400">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection