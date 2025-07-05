@extends('layouts.app')

@section('title', 'Welcome to Ecommerce')

@section('content')
<div class="relative overflow-hidden">
    <!-- Hero Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
                Welcome to <span class="text-indigo-600">Ecommerce</span>
            </h1>
            <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                The ultimate platform for shop owners to showcase their products and customers to discover amazing deals. 
                Start your journey today!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('products.explore') }}" class="bg-indigo-600 text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-indigo-700 transition duration-300">
                    <i class="fas fa-search mr-2"></i>Explore Products
                </a>
                <a href="{{ route('register.form') }}" class="border border-indigo-600 text-indigo-600 px-8 py-3 rounded-lg text-lg font-semibold hover:bg-indigo-50 transition duration-300">
                    Get Started
                </a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Why Choose Our Platform?</h2>
                <p class="text-xl text-gray-600">Everything you need to start and grow your online business</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6">
                    <div class="bg-indigo-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-store text-2xl text-indigo-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Easy Shop Setup</h3>
                    <p class="text-gray-600">Create your online shop in minutes with our intuitive interface. Upload your logo, add descriptions, and start selling.</p>
                </div>
                
                <div class="text-center p-6">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-box text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Product Management</h3>
                    <p class="text-gray-600">Add unlimited products with images, descriptions, pricing, and inventory tracking. Filter and search with ease.</p>
                </div>
                
                <div class="text-center p-6">
                    <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Admin Approval</h3>
                    <p class="text-gray-600">Secure platform with admin approval for shop owners. Quality control ensures the best experience for everyone.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="bg-indigo-600 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center text-white">
                <div>
                    <div class="text-4xl font-bold mb-2">{{ \App\Models\Shop::count() }}+</div>
                    <div class="text-xl">Active Shops</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">{{ \App\Models\Product::count() }}+</div>
                    <div class="text-xl">Products Listed</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">{{ \App\Models\User::where('role', '!=', 'admin')->count() }}+</div>
                    <div class="text-xl">Happy Users</div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gray-50 py-20">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Ready to Start Your Journey?</h2>
            <p class="text-xl text-gray-600 mb-8">Join thousands of successful shop owners who trust our platform</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register.form') }}" class="bg-indigo-600 text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-indigo-700 transition duration-300">
                    <i class="fas fa-rocket mr-2"></i>Start Selling Now
                </a>
                <a href="{{ route('login.form') }}" class="border border-gray-300 text-gray-700 px-8 py-3 rounded-lg text-lg font-semibold hover:bg-gray-100 transition duration-300">
                    <i class="fas fa-sign-in-alt mr-2"></i>Already Have Account?
                </a>
            </div>
        </div>
    </div>
</div>
@endsection