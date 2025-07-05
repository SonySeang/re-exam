@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold mb-6">Login</h2>
    
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-3 py-2 border rounded">
        </div>
        
        <div class="mb-6">
            <label class="block text-sm font-medium mb-2">Password</label>
            <input type="password" name="password" required class="w-full px-3 py-2 border rounded">
        </div>
        
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
            Login
        </button>
    </form>
    
    <p class="mt-4 text-center">
        Don't have an account? <a href="{{ route('register.form') }}" class="text-blue-600 hover:underline">Register</a>
    </p>
</div>
@endsection