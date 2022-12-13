<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Mail\Mailables\Content;
use App\Models\User;
use App\Models\Memo;
use App\Models\Folder;
use App\Models\MemoFolder;
use Illuminate\Auth\Events\Validated;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    // public function home()
    // {
    //     return view('create');
    // }

    /**
     * ログイン後にフォルダ作成画面を表示します
     *
     * @return void
     */
    public function index()
    {
        $user_id = auth()->id();
        $folders = Folder::where('user_id', $user_id)
        ->orderBy('updated_at', 'DESC')
        ->get();
        return view('folder.top', compact('folders'));
    }

    //PHPで実装する場合
    // public function csv()
    // {
    //     $users = User::select('users.*')->get();
    //     return view('csv', compact('users'));
    // }

    // コントローラーの1メソッドとして実装
    public function csv()
    {
    //データ準備
    $users = User::select('users.*')->get();
    $data = [];
    foreach($users as $user){
        $data[] = [
            $user->id,
            $user->name,
            $user->email,
            $user->password
    ];
    }
    //カラム作成
    $column = ['ID','名前','eメール','パスワード'];
    //書込用ファイル開く
    $f = fopen('memo.csv','w');
    if ($f) {
        //カラムの書込
        mb_convert_variables('SJIS','UTF-8',$column);
        fputcsv($f,$column);
        //データの書込
        foreach($data as $v){
        mb_convert_variables('SJIS','UTF-8',$v);
        fputcsv($f,$v);
        }
    }
    //ファイルを閉じる
    fclose($f);
    //HTTPヘッダ
    header('Content-Type: application/octet-stream');
    header('Content-Length: '.filesize('memo.csv'));
    header('Content-Disposition: attachment; filename=memo.csv');
    readfile('memo.csv');

//   return view('welcome', compact('data'));
}

}
