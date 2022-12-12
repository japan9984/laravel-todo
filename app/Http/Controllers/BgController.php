<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bg;
use App\Models\User;

class BgController extends Controller
{
    public function create()
    {
        return view('bg.create');
    }
    public function store(Request $request,User $user)
    {
        $user_id = auth()->user()->id;
        $file_name = $request->bgimage->getClientOriginalName();
        $request->file('bgimage')->storeAs('public/image/bg/', $file_name );
        User::where('id',$user_id)->update(['bg_path' => 'storage/image/bg/'.$file_name ]);

        return redirect()->route('folder.index');
    }
    public function destory()
    {
        $user_id = auth()->user()->id;
        User::where('id',$user_id)->update(['bg_path' => 'null' ]);
        return redirect(route('folder.index'));
    }
}
