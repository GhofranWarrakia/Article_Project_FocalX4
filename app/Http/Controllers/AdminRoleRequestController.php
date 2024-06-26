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
        // $requests = RoleRequest::where('status', 'pending')->get();
        // return view('graduation.submition_requests', compact('requests'));
    }

    public function handleRequest(Request $request, $id)
    {
        $roleRequest = RoleRequest::find($id);
        if ($request->action == 'approve') {
            $user = User::find($roleRequest->user_id);
            $user->roles_name = 'author';  // Assuming you have a role column in users table
            $user->save();
            $roleRequest->status = 'تمت الموافقة على طلب الترقية';
        } else {
            $roleRequest->status = 'تم رفض طلب الترقية إلى كاتب';
        }
        $roleRequest->save();

        return redirect()->back()->with('success', 'Request handled successfully!');
    }
}
