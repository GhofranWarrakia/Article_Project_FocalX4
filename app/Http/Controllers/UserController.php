<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 'author')->get();
        return view('writers.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'national_number' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'national_number' => $request->national_number,
            'country' => $request->country,
            'role' => 'writer',
        ]);

        return redirect()->route('writers.index')->with('Add', 'تم إضافة الكاتب بنجاح');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'national_number' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'national_number' => $request->national_number,
            'country' => $request->country,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('writers.index')->with('edit', 'تم تعديل الكاتب بنجاح');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('writers.index')->with('delete', 'تم حذف الكاتب بنجاح');
    }
}
