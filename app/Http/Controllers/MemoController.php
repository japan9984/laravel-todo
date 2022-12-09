<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Mail\Mailables\Content;
use App\Models\Memo;
use App\Models\Folder;
use Illuminate\Auth\Events\Validated;

class MemoController extends Controller
{
    public function create(Request $request, $folder_id)
    {
        return view('todo.task_create', compact('folder_id'));
    }

    public function store(Request $request)
    {
        $request->validate([ 'title' => 'required' , 'deadline' => 'required' ]);
        $posts = $request->all();
        $folder_id = $request->folder_id;

        $user_id = auth()->id();

        $file_name = $request->image->getClientOriginalName();
        $img = $request->file('image')->storeAs('public/image/', $file_name );
        Memo::insert(['content' => $posts['title'],'folder_id' => $posts['folder_id'],'status' => $posts['status'],'deadline' => $posts['deadline'],'user_id'=> $user_id,'file_path' => 'storage/image/'.$file_name ]);
        return redirect( 'todo/folder_show/'.$folder_id);
    }

    public function edit(Memo $memo)
    {
        $edit_memo = Memo::find($memo->id);
        $file_path = $memo->file_path;
        return view('todo.task_edit',compact('edit_memo', 'file_path'));
    }

    public function update(Request $request)
    {
        $posts = $request->all();
        $folder_id = $posts['folder_id'];
        $file_name = $request->image->getClientOriginalName();
        $img = $request->file('image')->storeAs('public/image/', $file_name );
        $request->validate([ 'title' => 'required' , 'deadline' => 'required' ]);
        Memo::where('id', $posts['memo_id'])
        ->update(['content' => $posts['title'], 'status' => $posts['status'],'deadline' => $posts['deadline'],'file_path' => 'storage/image/'.$file_name ]);
        return redirect( route('todo.folder_show', $folder_id) );
    }

    public function destory(Request $request,Memo $memo)
    {
        $posts = $request->all();
        $destory_memo = Memo::find($posts['memo_id']);
        Memo::where('id',$posts['memo_id'])->update(['deleted_at' => date("Y-m-d H:i:s",time())]);
        return redirect(route('todo.folder_show',$destory_memo->folder_id));
    }
}
