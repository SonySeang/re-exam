@extends('layouts.app')

@section('title', 'Shop Requests')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Shop Owner Requests</h1>
    
    @if($requests->isEmpty())
        <p class="text-gray-500">No pending requests.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-2 text-left">User</th>
                        <th class="px-4 py-2 text-left">Business Name</th>
                        <th class="px-4 py-2 text-left">Description</th>
                        <th class="px-4 py-2 text-left">Date</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $request)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $request->user->name }}</td>
                            <td class="px-4 py-2">{{ $request->business_name }}</td>
                            <td class="px-4 py-2">{{ Str::limit($request->description, 50) }}</td>
                            <td class="px-4 py-2">{{ $request->created_at->format('M d, Y') }}</td>
                            <td class="px-4 py-2">
                                <form method="POST" action="{{ route('admin.shop-requests.approve', $request->id) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded text-sm">Approve</button>
                                </form>
                                <form method="POST" action="{{ route('admin.shop-requests.reject', $request->id) }}" class="inline ml-2">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded text-sm">Reject</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection