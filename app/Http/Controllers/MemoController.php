<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Mail\Mailables\Content;
use App\Models\Memo;
use App\Models\Folder;
use Illuminate\Auth\Events\Validated;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\MemoAddMail;

class MemoController extends Controller
{
    public function create(Request $request, Folder $folder)
    {
        return view('memo.create', compact('folder'));
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
            $request->file('image')->storeAs('public/image/', $file_name);
            $memo->file_path = 'storage/image/'.$file_name;
            $memo->save();
        }

        $name = auth()->user()->name;
        $email = auth()->user()->email;
        Mail::send(new MemoAddMail($name, $email));

        return redirect()->route('folder.show', $folder);
    }

    public function edit(Memo $memo)
    {
        $file_path = $memo->file_path;
        return view('memo.edit', compact('memo', 'file_path'));
    }

    public function update(PostRequest $request, Memo $memo)
    {
        $posts = $request->all();
        if ($request->image !== null) {
            $file_name = $request->image->getClientOriginalName();
            $request->file('image')->storeAs('public/image/', $file_name);
            $memo->update(['content' => $posts['title'], 'status' => $posts['status'],'deadline' => $posts['deadline'],'file_path' => 'storage/image/'.$file_name ]);
        }
        $memo->update(['content' => $posts['title'], 'status' => $posts['status'],'deadline' => $posts['deadline']]);
        return redirect(route('folder.show', $memo->folder_id));
    }

    public function destory(Memo $memo)
    {
        $memo->delete();
        return redirect(route('folder.show', $memo->folder_id));
    }

    public function download()
    {
        $list = array(
            array('No', '名前', '年齢', '住所'),
            array('1', '山田一郎', '30','東京都渋谷区'),
            array('2', '佐藤二郎', '25','大阪府大阪市'),
            array('3', '鈴木三郎', '22','神奈川県横浜市'),
            array('4', '高橋四郎', '18','北海道札幌市'),
            array('5', '斉藤五郎', '16','愛知県名古屋市')
        );
        // ファイルを開く
        $fp = fopen('/Users/saegusayuyaDesktop\file.csv', 'w');
        // 1行ずつ配列の内容をファイルに書き込む
        foreach ($list as $fields) {
            fputcsv($fp, $fields);
        }
        // ファイルを閉じる
        fclose($fp);

        return redirect(route('folder.index'));
    }
}
