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
        return view( 'folder.index', );
    }

    public function show(Folder $folder)
    {
        $user_id = auth()->id();
        $target = $folder;
        return view('folder.show', compact('target'));
    }

    public function create()
    {
        return view('folder.create');
    }

    public function store(Request $request)
    {
        $user_id = auth()->id();
        Folder::create(['folder' => $request->title,'user_id'=>$user_id ]);
        $folder_id = Folder::max('id');
        return redirect()->route('folder.show', $folder_id);
    }

    public function edit($folder)
    {
        $edit_folder = Folder::find($folder);
        return view('folder.edit',compact('edit_folder'));
    }

    public function update(Request $request, Folder $folder)
    {
        $folder->update(['folder' => $request->title]);
        return redirect( route('folder.show', $folder) );
    }

    public function destory(Request $request, Folder $folder)
    {
        $folder->memo()->delete();
        $folder->delete();
        return redirect(route('folder.index'));
    }
}
