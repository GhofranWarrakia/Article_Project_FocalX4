<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $user=User::all();
        $roles = Role::pluck('name', 'id')->all();
        return view('graduation.users',compact('user','roles'));
    }

    public function store(Request $request)
    {  

        // dd($request->all());

    $validateData=$request->validate([
    'name'=>'required|unique:users|max:255',
    'email'=>'required|unique:users|max:255',
    'roles_name' => 'required|array',

    ],[
        'name.required'=>' يرجى ادخال اسم المستخدم',
        'name.unique'=>' المستخدم موجود مسبقا',
        'name.max'=>' لا يمكن ادخال اكثر من 255 حرف '  ,
        'email.unique'=>' الايميل موجود مسبقا',
        'email.required'=>' يرجى ادخال الايميل',
        ' password.required' => ' يرجى ادخال كلمة المرور',
        'password.min' => ' يجب أن تكون كلمة المرور مكونة من 6 أحرف على الأقل',
        'country.required' => ' يرجى ادخال الدولة',
        'national_number.required' => ' يرجى ادخال الرقم الوطني',
        'national_number.unique' => ' الرقم الوطني موجود مسبقا',
        'roles_name.required' => ' يرجى اختيار صلاحية واحدة على الأقل',
        'status.required' => ' يرجى تحديد حالة المستخدم',
    ]);

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->country = $request->country;
    $user->national_number = $request->national_number;
    $user->status = $request->input('status','مفعل');
    $user->roles_name = $request->roles_name;
    $user->save();


    session()->flash('Add','تم إضافة المستخدم بنجاح ');
    return redirect()->route('users.index');
}

public function Update(Request $request,$id){

    
    $id = $request->id;

    $this->validate($request,[
        'name'=>'required|max:255'.$id,
        'email'=>'required|max:255',
       
           ],[
               'name.required'=>' يرجى ادخال اسم المستخدم',
               'name.max'=>' لا يمكن ادخال اكثر من 255 حرف '  ,
               'email.required'=>' يرجى ادخال الايميل',
           ]);

    $user = User::find($id);
    $user->update([
        'name' => $request->name,
        'national_number' => $request->national_number,
        'country' => $request->country,
        'email' => $request->email,

    ]);

    session()->flash('edit','تم تعديل معلومات المستخدم بنجاج');
    return redirect('/users');
}

public function destroy(Request $request)
{
    $id = $request->id;
    User::find($id)->delete();
    session()->flash('delete','تم حذف القسم بنجاح');
    return redirect('/user');
}
}
