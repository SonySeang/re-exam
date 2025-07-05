@extends('layouts.app')

@section('title', 'All Products')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">All Products</h1>
    
    @if($products->isEmpty())
        <p class="text-gray-500">No products found.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-2 text-left">Product</th>
                        <th class="px-4 py-2 text-left">Shop</th>
                        <th class="px-4 py-2 text-left">Owner</th>
                        <th class="px-4 py-2 text-left">Price</th>
                        <th class="px-4 py-2 text-left">Stock</th>
                        <th class="px-4 py-2 text-left">Created</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr class="border-b">
                            <td class="px-4 py-2 font-semibold">{{ $product->name }}</td>
                            <td class="px-4 py-2">{{ $product->shop->name }}</td>
                            <td class="px-4 py-2">{{ $product->shop->user->name }}</td>
                            <td class="px-4 py-2">${{ number_format($product->price, 2) }}</td>
                            <td class="px-4 py-2">{{ $product->stock }}</td>
                            <td class="px-4 py-2">{{ $product->created_at->format('M d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection