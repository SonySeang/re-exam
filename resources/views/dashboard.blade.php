@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="bg-blue-100 p-3 rounded-full">
                <i class="fas fa-user text-blue-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-800">Welcome Back!</h3>
                <p class="text-gray-600">{{ auth()->user()->name }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="bg-green-100 p-3 rounded-full">
                <i class="fas fa-shield-alt text-green-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-800">Role</h3>
                <p class="text-gray-600 capitalize">{{ str_replace('_', ' ', auth()->user()->role) }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="bg-purple-100 p-3 rounded-full">
                <i class="fas fa-calendar text-purple-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-800">Member Since</h3>
                <p class="text-gray-600">{{ auth()->user()->created_at->format('M Y') }}</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow p-6">
    @if(auth()->user()->role === 'user')
        <div class="mb-6">
            <div class="flex items-center mb-4">
                <i class="fas fa-store text-indigo-600 mr-2"></i>
                <h2 class="text-lg font-semibold">Become a Shop Owner</h2>
            </div>
            @if(auth()->user()->shopOwnerRequest)
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
                    <div class="flex">
                        <i class="fas fa-clock text-yellow-600 mr-2 mt-1"></i>
                        <div>
                            <p class="font-medium text-yellow-800">Request Status</p>
                            <p class="text-yellow-700 capitalize">{{ auth()->user()->shopOwnerRequest->status }}</p>
                        </div>
                    </div>
                </div>
            @else
                <form method="POST" action="{{ route('shop-owner-request.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Business Name</label>
                        <input type="text" name="business_name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition duration-300">
                        <i class="fas fa-paper-plane mr-2"></i>Submit Request
                    </button>
                </form>
            @endif
        </div>
    @endif

    @if(auth()->user()->isShopOwner())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-6 rounded-lg border border-blue-200">
                <div class="flex items-center mb-3">
                    <i class="fas fa-store text-blue-600 text-xl mr-3"></i>
                    <h3 class="font-semibold text-blue-800">Shop Management</h3>
                </div>
                <p class="text-blue-600 mb-3">Manage your shop settings and information</p>
                <a href="{{ route('shop.dashboard') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                    Go to Shop Dashboard <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            <div class="bg-gradient-to-r from-green-50 to-green-100 p-6 rounded-lg border border-green-200">
                <div class="flex items-center mb-3">
                    <i class="fas fa-box text-green-600 text-xl mr-3"></i>
                    <h3 class="font-semibold text-green-800">Products</h3>
                </div>
                <p class="text-green-600 mb-3">Add, edit, and manage your products</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center text-green-600 hover:text-green-800 font-medium">
                    Manage Products <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    @endif

    @if(auth()->user()->isAdmin())
        <div class="bg-gradient-to-r from-red-50 to-red-100 p-6 rounded-lg border border-red-200">
            <div class="flex items-center mb-4">
                <i class="fas fa-crown text-red-600 text-xl mr-3"></i>
                <h3 class="font-semibold text-red-800">Admin Panel</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('admin.shop-requests') }}" class="flex items-center p-3 bg-white rounded border hover:shadow-md transition duration-300">
                    <i class="fas fa-clipboard-list text-red-600 mr-3"></i>
                    <span class="text-gray-700">Shop Requests</span>
                </a>
                <a href="{{ route('admin.shops') }}" class="flex items-center p-3 bg-white rounded border hover:shadow-md transition duration-300">
                    <i class="fas fa-store text-red-600 mr-3"></i>
                    <span class="text-gray-700">All Shops</span>
                </a>
                <a href="{{ route('admin.products') }}" class="flex items-center p-3 bg-white rounded border hover:shadow-md transition duration-300">
                    <i class="fas fa-box text-red-600 mr-3"></i>
                    <span class="text-gray-700">All Products</span>
                </a>
            </div>
        </div>
    @endif
</div>
@endsection