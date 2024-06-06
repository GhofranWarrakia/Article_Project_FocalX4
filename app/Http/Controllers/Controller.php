<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        return view('graduation.users');
    }

    public function store(Request $request)
    {   
        // return $request;

        $input = $request->all();

        $b_exists = User::where('national_number', '=', $input['national_number'])->exists();
    if($b_exists){
        session()->flash('Error', 'خطأ إن المستخدم موجود مسبقاً');
        return redirect('users');
    } 

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->country = $request->country;
    $user->national_number = $request->national_number;

    $user->save();

    return redirect()->route('users.store');
}
        }