<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleRequest;
use App\Models\User;

class AdminRoleRequestController extends Controller
{
    public function index()
    {
        $requests = RoleRequest::all();

        // Return the view with the requests data
        return view('graduation.adminRequest', ['requests' => $requests]);
    }

    public function handleRequest(Request $request, $id)
    {
        $roleRequest = RoleRequest::find($id);
        
        if ($roleRequest) {
            if ($request->action == 'approve') {
                $user = User::find($roleRequest->user_id);
                $user->roles_name = 'author';  
                $user->save();
                $roleRequest->status = 'تمت الموافقة على طلب الترقية';
            } else {
                $roleRequest->status = 'تم رفض طلب الترقية إلى كاتب';
            }
            $roleRequest->save();

            return redirect()->back()->with('success', 'تم معالجة الطلب بنجاح');
        }

        return redirect()->back()->with('error', 'لم يتم العثور على الطلب');
    }
}
