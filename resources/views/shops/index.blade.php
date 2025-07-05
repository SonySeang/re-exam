@extends('layouts.app')

@section('title', 'All Shops')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Discover Shops</h1>
        <p class="text-xl text-gray-600">Browse through our collection of verified shops</p>
    </div>

    <!-- Shops Grid -->
    @if($shops->isEmpty())
        <div class="text-center py-12">
            <i class="fas fa-store text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No shops available</h3>
            <p class="text-gray-500">Check back later for new shops</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
            @foreach($shops as $shop)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            @if($shop->logo)
                                <img src="{{ Storage::url($shop->logo) }}" alt="{{ $shop->name }}" class="w-16 h-16 object-cover rounded-full mr-4">
                            @else
                                <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-store text-indigo-600 text-xl"></i>
                                </div>
                            @endif
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">{{ $shop->name }}</h3>
                                <p class="text-sm text-gray-500">
                                    <i class="fas fa-box mr-1"></i>{{ $shop->products_count }} Products
                                </p>
                            </div>
                        </div>
                        
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ $shop->description ?: 'Welcome to our shop! Discover amazing products and great deals.' }}
                        </p>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-calendar mr-1"></i>Since {{ $shop->created_at->format('M Y') }}
                            </span>
                            <a href="{{ route('shop.show', $shop->id) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition duration-300">
                                Visit Shop <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $shops->links() }}
        </div>
    @endif
</div>
@endsection