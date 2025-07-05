<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ecommerce App')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    @auth
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-800">Ecommerce</h1>
                <p class="text-sm text-gray-600">{{ auth()->user()->name }}</p>
            </div>
            
            <nav class="mt-6">
                <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-home mr-3"></i> Dashboard
                </a>
                <a href="{{ route('products.explore') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-search mr-3"></i> Explore Products
                </a>
                <a href="{{ route('shops.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-store mr-3"></i> Browse Shops
                </a>
                
                @if(auth()->user()->isAdmin())
                    <div class="px-6 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Admin</div>
                    <a href="{{ route('admin.shop-requests') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                        <i class="fas fa-clipboard-list mr-3"></i> Shop Requests
                    </a>
                    <a href="{{ route('admin.shops') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                        <i class="fas fa-store mr-3"></i> All Shops
                    </a>
                    <a href="{{ route('admin.products') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                        <i class="fas fa-box mr-3"></i> All Products
                    </a>
                @endif
                
                @if(auth()->user()->isShopOwner())
                    <div class="px-6 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Shop</div>
                    <a href="{{ route('shop.dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                        <i class="fas fa-store mr-3"></i> My Shop
                    </a>
                    <a href="{{ route('products.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                        <i class="fas fa-box mr-3"></i> Products
                    </a>
                @endif
                
                <div class="absolute bottom-0 w-64 p-6">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-4 py-2 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded">
                            <i class="fas fa-sign-out-alt mr-3"></i> Logout
                        </button>
                    </form>
                </div>
            </nav>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <header class="bg-white shadow-sm border-b">
                <div class="px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                </div>
            </header>

            <main class="p-6">
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                        <div class="flex">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <div class="flex">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ session('error') }}
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <div class="flex">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <div>
                                @foreach($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
    @else
    <!-- Guest Layout -->
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="/" class="text-2xl font-bold text-indigo-600">Ecommerce</a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('products.explore') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md">Explore</a>
                        <a href="{{ route('shops.index') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md">Shops</a>
                        <a href="{{ route('login.form') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md">Login</a>
                        <a href="{{ route('register.form') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Register</a>
                    </div>
                </div>
            </div>
        </nav>
        
        <main>
            @if(session('success'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">
                        <div class="flex">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded">
                        <div class="flex">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <div>
                                @foreach($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
            @yield('content')
        </main>
    </div>
    @endauth

</body>
</html>