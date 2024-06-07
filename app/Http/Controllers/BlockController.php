<?php

namespace App\Http\Controllers;

use App\Models\Block;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BlockController extends Controller
{
    
    public function index()
    {
        return view ('graduation.block');
    }

    public function store(Request $request)
    {   
        // return $request;

        $input = $request->all();

        $b_exists = Block::where('blocked_id', '=', $input['blocked_id'])->exists();
    if($b_exists){
        session()->flash('Error', 'خطأ إن المعلومات المدخلة مكررة ');
        return redirect('block');
    } 

    $user = new Block();
    $user->blocker_id = $request->blocker_id;
    $user->blocked_id = $request->blocked_id;

    $user->save(); //save information

    return redirect()->route('block.store');// block users route
}
        }
