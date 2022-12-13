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
    /**
     * メモを一覧表示します
     *
     * @return void
     */
    public function index()
    {
        return view('folder.index');
    }

    /**
     * 対象のフォルダーのメモを表示します
     *
     * @param Folder $folder
     * @return void
     */
    public function show(Folder $folder)
    {
        $user_id = auth()->id();
        $target = $folder;
        return view('folder.show', compact('target'));
    }

    /**
     * フォルダーの作成画面を表示します
     *
     * @return void
     */
    public function create()
    {
        return view('folder.create');
    }

    /**
     * フォルダーの保存処理です
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $user_id = auth()->id();
        Folder::create(['folder' => $request->title,'user_id'=>$user_id ]);
        $folder_id = Folder::max('id');
        return redirect()->route('folder.show', $folder_id);
    }

    /**
     * フォルダーの編集画面を表示します
     *
     * @param [type] $folder
     * @return void
     */
    public function edit($folder)
    {
        $edit_folder = Folder::find($folder);
        return view('folder.edit', compact('edit_folder'));
    }

    /**
     * フォルダーの更新処理です
     *
     * @param Request $request
     * @param Folder $folder
     * @return void
     */
    public function update(Request $request, Folder $folder)
    {
        $folder->update(['folder' => $request->title]);
        return redirect(route('folder.show', $folder));
    }

    /**
     * フォルダーの削除処理です
     *
     * @param Request $request
     * @param Folder $folder
     * @return void
     */
    public function destory(Request $request, Folder $folder)
    {
        $folder->memo()->delete();
        $folder->delete();
        return redirect(route('folder.index'));
    }
}
