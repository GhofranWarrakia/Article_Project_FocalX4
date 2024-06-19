<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Block;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BlockController extends Controller
{
    
//     public function index()
//     {
//         return view ('graduation.block');
//     }


//     public function store(Request $request)
//     {   
//         // return $request;

//         $input = $request->all();

//         $b_exists = Block::where('blocked_id', '=', $input['blocked_id'])->exists();
//         if($b_exists){
//         session()->flash('Error', 'خطأ إن المعلومات المدخلة مكررة ');
//         return redirect('block');
//     } 

//     $user = new Block();
//     $user->blocker_id = $request->blocker_id;
//     $user->blocked_id = $request->blocked_id;

//     $user->save(); //save information

//     return redirect()->route('block.store');// block users route
// }
//         }
    use AuthorizesRequests, ValidatesRequests;

//     public function index()
//     {
//         $blocks = Block::with(['blocker', 'blocked'])->get();
//         return view('graduation.block', compact('blocks'));
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'blocker_id' => 'required|exists:users,id',
//             'blocked_id' => 'required|exists:users,id',
//         ]);

//         Block::create([
//             'blocker_id' => $request->blocker_id,
//             'blocked_id' => $request->blocked_id,
//         ]);

//         session()->flash('Add', 'Block created successfully.');
//         return redirect()->route('block.index');
//     }

//     public function destroy(Request $request)
//     {
//         $block = Block::findOrFail($request->id);
//         $block->delete();

//         session()->flash('delete', 'Block removed successfully.');
//         return redirect()->route('block.index');
//     }
// }

// public function index()
//     {
//         $blocks = Block::with(['blocker', 'blocked'])->get();
//         $users = User::all();
//         return view('block.index', compact('blocks', 'users'));
//     }

//     public function store(Request $request)
//     {
//         $validatedData = $request->validate([
//             'blocker_id' => 'required|exists:users,id',
//             'blocked_id' => 'required|exists:users,id',
//         ]);

//         Block::create($validatedData);

//         session()->flash('Add', 'تم إضافة الحظر بنجاح');
//         return redirect()->route('block.index');
//     }

//     public function destroy(Request $request)
//     {
//         $block = Block::findOrFail($request->id);
//         $block->delete();

//         session()->flash('delete', 'تم ازالة الحظر بنجاح');
//         return redirect()->route('block.index');
//     }
// }
public function index()
    {
        $users = User::all();
        $blockedUsers = auth()->user()->blockedUsers->pluck('blocked_id')->toArray();
        return view('graduation.block', compact('users', 'blockedUsers'));
    }

    public function block(Request $request)
    {
        Block::create([
            'blocker_id' => auth()->id(),
            'blocked_id' => $request->blocked_id,
        ]);

        return redirect()->back()->with('message', 'User blocked successfully');
    }

    public function unblock(Request $request)
    {
        Block::where('blocker_id', auth()->id())
            ->where('blocked_id', $request->blocked_id)
            ->delete();

        return redirect()->back()->with('message', 'User unblocked successfully');
    }
}