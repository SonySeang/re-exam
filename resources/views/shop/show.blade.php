@extends('layouts.app')

@section('title', $shop->name)

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center mb-6">
        @if($shop->logo)
            <img src="{{ Storage::url($shop->logo) }}" alt="{{ $shop->name }}" class="w-16 h-16 object-cover rounded mr-4">
        @endif
        <div>
            <h1 class="text-3xl font-bold">{{ $shop->name }}</h1>
            <p class="text-gray-600">{{ $shop->description }}</p>
        </div>
    </div>
    
    <h2 class="text-2xl font-bold mb-4">Products</h2>
    
    @if($shop->products->isEmpty())
        <p class="text-gray-500">No products available.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($shop->products as $product)
                <div class="border rounded-lg p-4">
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded mb-4">
                    @endif
                    <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
                    <p class="text-gray-600 mb-2">{{ Str::limit($product->description, 100) }}</p>
                    <p class="text-xl font-bold text-green-600">${{ number_format($product->price, 2) }}</p>
                    <p class="text-sm text-gray-500">Stock: {{ $product->stock }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection