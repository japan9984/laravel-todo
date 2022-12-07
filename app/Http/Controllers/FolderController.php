<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Mail\Mailables\Content;
use App\Models\Memo;
use App\Models\Folder;
use Illuminate\Auth\Events\Validated;

class FolderController extends Controller
{
    public function index()
    {
        return view( 'todo.folder_index', );
    }

    public function show(Folder $folder)
    {
        $user_id = auth()->id();
        $target = $folder;
        return view('todo.folder_show', compact('target'));
    }

    public function create()
    {
        return view('todo.folder_create');
    }

    public function store(Request $request)
    {
        $posts = $request->all();
        $request->validate([ 'title' => 'required']);
        Folder::insert(['folder' => $posts['title'],'user_id'=>\Auth::id()]);
        $folder_id = Folder::max('id');
        return redirect()->route('todo.folder_show', $folder_id);
    }

    public function edit($folder)
    {
        $edit_folder = Folder::find($folder);
        return view('todo.folder_edit',compact('edit_folder'));
    }

    public function update(Request $request)
    {
        $posts = $request->all();
        $folder_id = $posts['folder_id'];
        $request->validate([ 'title' => 'required']);
        Folder::where('id', $posts['folder_id'])
        ->update(['folder' => $posts['title']]);
        return redirect( route('todo.folder_show', $folder_id) );
    }

    public function destory(Request $request)
    {
        $folder = Folder::find($request->post('folder_id'));
        $folder->memo()->delete();
        $folder->delete();
        return redirect(route('todo.folder_index'));
    }
}
