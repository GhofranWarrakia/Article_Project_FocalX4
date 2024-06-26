<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleRequest;
use Illuminate\Support\Facades\Mail;

class RoleRequestController extends Controller
{
    public function showForm()
    {
        return view('graduation.role_request');
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);


        $user = auth()->user();

        RoleRequest::create([
            // 'user_id' => auth()->id(),

            'user_id' => $user->id,


            'name' => $user->name,
            'email' => $user->email,

            'reason' => $request->reason,
            'status' => 'الطلب قيد الانتظار',
        ]);
        return redirect()->back()->with('success', 'تم إرسال طلب الترقية بنجاح');
    }
}
