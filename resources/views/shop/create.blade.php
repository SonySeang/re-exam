@extends('layouts.app')

@section('title', 'Create Shop')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Create Your Shop</h1>
    
    <form method="POST" action="{{ route('shop.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Shop Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-3 py-2 border rounded">
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Description</label>
            <textarea name="description" rows="4" class="w-full px-3 py-2 border rounded">{{ old('description') }}</textarea>
        </div>
        
        <div class="mb-6">
            <label class="block text-sm font-medium mb-2">Logo</label>
            <input type="file" name="logo" accept="image/*" class="w-full px-3 py-2 border rounded">
        </div>
        
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
            Create Shop
        </button>
    </form>
</div>
@endsection