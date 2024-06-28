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
    use AuthorizesRequests, ValidatesRequests;

    
    
public function index()
    {
        $users = User::all();
        $blockedUsers = auth()->user()->blockedUsers->pluck('blocked_id')->toArray();
        return view('graduation.block', compact('users', 'blockedUsers'));
    }

    public function block(Request $request)
    {
        $blockedAuthor= Block::create([
            'blocker_id' => auth()->id(),
            'blocked_id' => $request->blocked_id,
        ]);

        return redirect()->back()->with('message', 'تم الحظر الكاتب');
        return response()->json($blockedAuthor, 201);
    }

    public function unblock(Request $request)
    {
        $unblockedAuthor=  Block::where('blocker_id', auth()->id())
            ->where('blocked_id', $request->blocked_id)
            ->delete();

        return redirect()->back()->with('message', 'تم رفع الحظر عن الكاتب ');
        return response()->json($unblockedAuthor, 201);
    }
}