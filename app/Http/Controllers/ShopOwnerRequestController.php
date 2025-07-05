<?php

namespace App\Http\Controllers;

use App\Models\ShopOwnerRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopOwnerRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        ShopOwnerRequest::create([
            'user_id' => Auth::id(),
            'business_name' => $request->business_name,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Shop owner request submitted successfully!');
    }

    public function index()
    {
        $requests = ShopOwnerRequest::with('user')->where('status', 'pending')->get();
        return view('admin.shop-requests', compact('requests'));
    }

    public function approve($id)
    {
        $request = ShopOwnerRequest::findOrFail($id);
        $request->update(['status' => 'approved']);
        
        $user = $request->user;
        $user->update(['role' => 'shop_owner']);

        return redirect()->back()->with('success', 'Request approved successfully!');
    }

    public function reject($id)
    {
        $request = ShopOwnerRequest::findOrFail($id);
        $request->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Request rejected successfully!');
    }
}