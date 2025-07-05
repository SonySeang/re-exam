@extends('layouts.app')

@section('title', 'All Shops')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">All Shops</h1>
    
    @if($shops->isEmpty())
        <p class="text-gray-500">No shops found.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-2 text-left">Shop Name</th>
                        <th class="px-4 py-2 text-left">Owner</th>
                        <th class="px-4 py-2 text-left">Description</th>
                        <th class="px-4 py-2 text-left">Created</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shops as $shop)
                        <tr class="border-b">
                            <td class="px-4 py-2 font-semibold">{{ $shop->name }}</td>
                            <td class="px-4 py-2">{{ $shop->user->name }}</td>
                            <td class="px-4 py-2">{{ Str::limit($shop->description, 50) }}</td>
                            <td class="px-4 py-2">{{ $shop->created_at->format('M d, Y') }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('shop.show', $shop->id) }}" class="text-blue-600 hover:underline">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $shops->links() }}
        </div>
    @endif
</div>
@endsection