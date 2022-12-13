<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Mail\Mailables\Content;
use App\Models\User;
use App\Models\Memo;
use App\Models\Folder;
use Illuminate\Auth\Events\Validated;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\MemoAddMail;
use Illuminate\Support\Facades\Gate;

class MemoController extends Controller
{
    /**
     * メモの作成画面を表示します
     *
     * @param Request $request
     * @param Folder $folder
     * @return void
     */
    public function create(Request $request, Folder $folder)
    {
        return view('memo.create', compact('folder'));
    }

    /**
     * メモの保存処理です
     *
     * @param PostRequest $request
     * @param Folder $folder
     * @return void
     */
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
            $request->file('image')->storeAs('public/image/', $file_name);
            $memo->file_path = 'storage/image/'.$file_name;
            $memo->save();
        }

        $name = auth()->user()->name;
        $email = auth()->user()->email;
        Mail::send(new MemoAddMail($name, $email));

        return redirect()->route('folder.show', $folder);
    }

    /**
     * メモの編集画面を表示します
     *
     * @param Memo $memo
     * @return void
     */
    public function edit(User $user,Memo $memo)
    {
        if(! Gate::allows('memoCheck', $memo)){
            abort(404);
        }
        $file_path = $memo->file_path;
        return view('memo.edit', compact('memo', 'file_path'));
    }

    /**
     * メモの更新処理です
     *
     * @param PostRequest $request
     * @param Memo $memo
     * @return void
     */
    public function update(PostRequest $request, Memo $memo)
    {
        $posts = $request->all();
        $memo->update(['content' => $posts['title'], 'status' => $posts['status'],'deadline' => $posts['deadline']]);
        if ($request->hasFile('image')) {
            $file_name = $request->image->getClientOriginalName();
            $request->file('image')->storeAs('public/image/', $file_name);
            $memo->file_path = 'storage/image/'.$file_name;
            $memo->save();
        }

        return redirect(route('folder.show', $memo->folder_id));
    }

    /**
     * メモの削除処理です
     *
     * @param Memo $memo
     * @return void
     */
    public function destory(Memo $memo)
    {
        $memo->delete();
        return redirect(route('folder.show', $memo->folder_id));
    }
}
