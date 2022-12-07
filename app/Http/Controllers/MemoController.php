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
    public function todo_task_create(Request $request, $folder_id)
    {
        return view('todo.task_create', compact('folder_id'));
    }

    public function store(Request $request)
    {
        $posts = $request->all();
        $folder_id = $request->folder_id;
        $user_id = auth()->id();
        $request->validate([ 'title' => 'required' , 'deadline' => 'required' ]);
        Memo::insert(['content' => $posts['title'],'folder_id' => $posts['folder_id'],'status' => $posts['status'],'deadline' => $posts['deadline'],'user_id'=> $user_id ]);
        return redirect( 'todo/folder_show/'.$folder_id);
    }

    public function edit($id)
    {
        $edit_memo = Memo::find($id);
        return view('todo.task_edit',compact('edit_memo'));
    }

    public function update(Request $request)
    {
        $posts = $request->all();
        $request->validate([ 'title' => 'required' , 'deadline' => 'required' ]);
        Memo::where('id', $posts['memo_id'])
        ->update(['content' => $posts['title'], 'status' => $posts['status'],'deadline' => $posts['deadline']]);
        return redirect( route('todo.folder_index') );
    }

    public function todo_task_destory(Request $request)
    {
        $posts = $request->all();
        Memo::where('id',$posts['memo_id'])->update(['deleted_at' => date("Y-m-d H:i:s",time())]);
        return redirect(route('todo.folder_index'));
    }
}
