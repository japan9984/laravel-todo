<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Mail\Mailables\Content;
use App\Models\Memo;
use App\Models\Folder;
use Illuminate\Auth\Events\Validated;
use App\Http\Requests\PostRequest;

class MemoController extends Controller
{
    public function create(Request $request, Folder $folder)
    {
        return view('todo.task_create', compact('folder'));
    }

    public function store(PostRequest $request, Folder $folder)
    {
        $user = auth()->user();
        $memo = Memo::create([
            'content' => $request['title'],
            'folder_id' => $folder->id ,
            'status' => $request['status'],
            'deadline' => $request['deadline'],
            'user_id'=> $user->id,
        ]);
        if ($request->hasFile('image')) {
            $file_name = $request->image->getClientOriginalName();
            $request->file('image')->storeAs('public/image/', $file_name );
            $memo->file_path = 'storage/image/'.$file_name;
            $memo->save();
        }
        return redirect()->route('todo.folder_show', $folder);
    }

    public function edit(Memo $memo)
    {
        $edit_memo = Memo::find($memo->id);
        $file_path = $memo->file_path;
        return view('todo.task_edit',compact('edit_memo', 'file_path'));
    }

    public function update(PostRequest $request)
    {
        $posts = $request->all();
        $folder_id = $posts['folder_id'];
        if($request->image !== null){
            $file_name = $request->image->getClientOriginalName();
            $img = $request->file('image')->storeAs('public/image/', $file_name );
            Memo::where('id', $posts['memo_id'])
            ->update(['content' => $posts['title'], 'status' => $posts['status'],'deadline' => $posts['deadline'],'file_path' => 'storage/image/'.$file_name ]);
        }
        Memo::where('id', $posts['memo_id'])
        ->update(['content' => $posts['title'], 'status' => $posts['status'],'deadline' => $posts['deadline']]);
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
