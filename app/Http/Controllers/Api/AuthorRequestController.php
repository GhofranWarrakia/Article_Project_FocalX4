<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthorRequestController extends Controller
{//تقديم طلب تعريف حساب كاتب
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'documents' => 'required|file',
        ]);

        $authorRequest = new AuthorRequest();
        $authorRequest->user_id = auth()->user()->id;
        $authorRequest->name = $request->name;
        $authorRequest->documents = $request->file('documents')->store('documents');
        $authorRequest->save();

        return response()->json(['message' => 'Author request submitted'], 201);
    }
}
