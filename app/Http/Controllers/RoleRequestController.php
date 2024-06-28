<?php

namespace App\Http\Controllers;

use App\Models\RoleRequest;
use App\Notifications\UserPromotionNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleRequestController extends Controller
{
    public function showForm()
    {
        return view('graduation.role_request');
    }

    public function submitForm(Request $request)
    {
        // التحقق إذا كان المستخدم مسجلاً
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'يرجى تسجيل الدخول أولاً.');
        }

        // التحقق من وجود طلب سابق
        $existingRequest = RoleRequest::where('user_id', Auth::id())->first();

        if ($existingRequest) {
            return redirect()->back()->with('error', 'لقد قدمت طلبًا بالفعل.');
        }

        $request->validate([
            'reason' => 'required|string|min:50|max:255',
        ]);

        $user = auth()->user();

        RoleRequest::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'reason' => $request->reason,
            'status' => 'الطلب قيد الانتظار',
        ]);

        return redirect()->back()->with('success', 'تم إرسال طلب الترقية بنجاح');
    }

    public function handle(Request $request, $id)
    {
        // العثور على طلب الترقية بالمعرف
        $promotionRequest = RoleRequest::findOrFail($id);
        $action = $request->input('action');

        // تحديث حالة الطلب بناءً على الإجراء
        if ($action == 'approve') {
            $promotionRequest->status = 'approved';
        } elseif ($action == 'deny') {
            $promotionRequest->status = 'denied';
        }

        $promotionRequest->save();

        // إرسال الإشعار إلى المستخدم
        $user = $promotionRequest->user;
        $user->notify(new UserPromotionNotification($promotionRequest->status));

        return redirect()->back()->with('success', 'تم تحديث حالة الطلب بنجاح.');
    }
}
