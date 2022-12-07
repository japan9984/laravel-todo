<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Mail\Mailables\Content;
use App\Models\Memo;
use App\Models\Folder;
use App\Models\MemoFolder;
use DB;
use Illuminate\Auth\Events\Validated;

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
    // public function index()
    // {
    //     $query_folder = \Request::query('folder');

    //     $memos = Memo::select('memos.*')
    //     ->leftJoin('memo_folders', 'memo_folders.memo_id', '=', 'memos.id')
    //     ->where('memo_folders.folder_id', '=', $query_folder)
    //     ->where('user_id', '=', \Auth::id())
    //     ->whereNull('deleted_at')
    //     ->orderBy('updated_at', 'DESC')
    //     ->get();

    //     $folders = Folder::select('folders.*')
    //     ->where('user_id', '=', \Auth::id())
    //     ->whereNull('deleted_at')
    //     ->orderBy('updated_at', 'DESC')
    //     ->get();
    //     return view('home',compact('memos','folders'));
    // }

    public function home()
    {
        return view('create');
    }

    public function memo_create(Request $request)
    {
        $user = auth()->user();
        dd($user);
        $folders = $user->folders;

        // $posts = $request->all();
        $folder_id_n = $request->folder_id;
        return view('memo.create', compact('folder_id_n'));
    }

    public function memo_edit($id)
    {
        $memos = Memo::select('memos.*')
        ->where('user_id', '=', \Auth::id())
        // ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();

        $edit_memo = Memo::find($id);

        return view('memo.edit',compact('memos','edit_memo'));
    }

    public function memo_store(Request $request)
    {

        // $request->validate(['content' => 'reqired']);
        $posts = $request->all();
        // DB::transaction(function() use($posts){
        $memo_id = Memo::insertGetId(['content' => $posts['content'],'deadline' => $posts['deadline'],'user_id'=>\Auth::id()]);
        // $folder_id = $posts['folder_id'];
        // MemoFolder::insert(['memo_id' => $memo_id, 'folder_id' => $folder_id]);
        // });

        // $folders = Folder::where('user_id', '=', '\Auth::id()')
        // ->whereNull('deleted_at')
        // ->orderBy('id', 'DESC')
        // ->get();

        // Memo::insert(['content' => $posts['content'],'deadline' => $posts['deadline'],'user_id'=>\Auth::id()]);
        return redirect( route('index') );

    }

    public function memo_update(Request $request)
    {
        $posts = $request->all();

        Memo::where('id', $posts['memo_id'])
        ->update(['content' => $posts['content'],'deadline' => $posts['deadline']]);
        return redirect( route('index') );
    }

    // public function folder_create()
    // {
    //     return view('folder.create');
    // }

    public function folder_store(Request $request)
    {
        $posts = $request->all();
        Folder::insert(['folder' => $posts['folder'],'user_id'=>\Auth::id()]);
        // DB::transaction(function() use($posts){
        //     $folder_id = Folder::insertGetId(['folder' => $posts['folder'],'user_id'=>\Auth::id()]);
        // });
        return redirect( route('index') );
    }

    public function folder_show(Folder $folder)
    {
        $folders = Folder::select('folders.*')
        ->where('user_id', '=', \Auth::id())
        // ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();

        // $edit_folder = Folder::find($id);

        $folder_id = $folder->id;

        return view('folder.show',compact('folders','folder_id'));
    }


    public function index()
    {
        $folders = Folder::where('user_id', '=', \Auth::id())
        // ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();
        return view('todo.4_top', compact('folders'));
    }

    public function todo_folder_create()
    {
        return view('todo.5_folder_create');
    }

    public function todo_folder_store(Request $request)
    {
        $posts = $request->all();
        $request->validate([ 'title' => 'required']);
        Folder::insert(['folder' => $posts['title'],'user_id'=>\Auth::id()]);
        // DB::transaction(function() use($posts){
        $folder_id = Folder::max('id');
            // });
        // dd($folder_id);
        return redirect()->route('todo.folder_show', $folder_id);
    }

    public function todo_folder_index()
    {
        $query_folder = \Request::query('folder');

        $memos = Memo::select('memos.*')
        // ->leftJoin('memo_folders', 'memo_folders.memo_id', '=', 'memos.id')
        // ->where('memo_folders.folder_id', '=', $query_folder)
        ->where('user_id', '=', \Auth::id())
        // ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();
        // $memos = Memo::select('memos.*')
        // ->leftJoin('memo_folders', 'memo_folders.memo_id', '=', 'memos.id')
        // ->where('memo_folders.folder_id', '=', $query_folder)
        // ->where('user_id', '=', \Auth::id())
        // ->whereNull('deleted_at')
        // ->orderBy('updated_at', 'DESC')
        // ->get();

        $folders = Folder::select('folders.*')
        ->where('user_id', '=', \Auth::id())
        // ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();

        return view( 'todo.6_folder_index',compact('memos','folders') );
    }

    public function todo_task_create(Request $request, $folder_id)
    {
        // $posts = $request->all();
        // dd($request->folder_id);
    //     dd($folder_id);
    //    $folder_id_n = $request->folder_id;

        return view('todo.7_task_create', compact('folder_id'));
    }
    public function todo_task_create2(Request $request, $folder)
    {
        // $posts = $request->all();
        // dd($request->folder_id);
    //     dd($folder_id);
    //    $folder_id_n = $request->folder_id;

        return view('todo.7_task_create2', compact('folder'));
    }

    public function todo_task_store(Request $request)
    {

        // $request->validate(['content' => 'reqired']);
        $posts = $request->all();
        $folder_id = $request->folder_id;
        $request->validate([ 'title' => 'required' , 'deadline' => 'required' ]);
        // dd($posts);
        // DB::transaction(function() use($posts){
        $memo_id = Memo::insertGetId(['content' => $posts['title'],'folder_id' => $posts['folder_id'],'status' => $posts['status'],'deadline' => $posts['deadline'],'user_id'=>\Auth::id()]);
        // $folder_id = $posts['folder_id'];
        // MemoFolder::insert(['memo_id' => $memo_id, 'folder_id' => $folder_id]);
        // });

        // $folders = Folder::where('user_id', '=', '\Auth::id()')
        // ->whereNull('deleted_at')
        // ->orderBy('id', 'DESC')
        // ->get();
        // $folder_id = $posts['folder_id'];
        // dd($folder_id);

        // Memo::insert(['content' => $posts['content'],'deadline' => $posts['deadline'],'user_id'=>\Auth::id()]);
        // return redirect( route('todo.folder_index'));
        // return redirect()->route('todo.folder_show', $folder_id);
        return redirect( 'todo/folder_show/'.$folder_id);
        // ->with([$folder_id]);
    }

    public function todo_task_edit($id)
    {
        $memos = Memo::select('memos.*')
        ->where('user_id', '=', \Auth::id())
        // ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();

        $edit_memo = Memo::find($id);
        // $edit_memo = Memo::select('memos.*', 'tags.id AS tag_id')
        // ->leftjoin('memo_tags' ,'memo_tags.memo_id', '=' , 'memos.id')
        // ->leftjoin('tags' ,'memo_tags.tag_id', '=' , 'tags.id')
        // ->where('memos.user_id', '=', \Auth::id())
        // ->where('memos.id', '=', $id)
        // ->whereNull('memos.deleted_at')
        // ->get();

        return view('todo.8_task_edit',compact('memos','edit_memo'));
    }

    public function todo_folder_show(Folder $folder)
    {
        // $test_folder = Folder::select('folders.folder')
        // ->get();
        // $test_folder = Folder::where('user_id', 1)->get();
        // dd($test_folder);

        // $test_user_id = \Auth::id();
        // $test_user_id = auth()->user()->id;
        // dd($test_user_id);

        // $folder_id = $folder['id'] ;
    //    dd($folder['id']);
        // $memos_id = MemoFolder::where('folder_id', $folder['id'])->pluck('memo_id')->toArray();
        // $memos_id = Folder::where('id', $folder['id']);
        // dd($folder->id);
        $memos = Memo::where('folder_id', $folder->id)
        ->where('user_id',  \Auth::id())
        ->get();
        // dd($memos);


        // $memos = Memo::select('memos.*')
        // ->leftJoin('memo_folders', 'memo_folders.memo_id', '=', 'memos.id')
        // ->leftJoin('folders', 'memo_folders.folder_id', '=', 'folders.id')
        // ->where('memo_folders.folder_id', '=', 'folders.id')
        // ->where('user_id', '=', \Auth::id())
        // ->where('folders.id', '=', $folder_id)
        // ->whereNull('deleted_at')
        // ->orderBy('updated_at', 'DESC')
        // ->get();

        $folders = Folder::select('folders.*')
        // ->where('id', '=', $folder['id'])
        ->where('user_id', '=', \Auth::id())
        // ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();

        // $edit_folder = Folder::find($id);

        $folder_id = $folder->id;

        return view('todo.folder_show',compact('memos', 'folders','folder_id'));
    }

    public function todo_task_update(Request $request)
    {
        $posts = $request->all();
        $request->validate([ 'title' => 'required' , 'deadline' => 'required' ]);
        // dd($posts);
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

    public function todo_folder_edit($id)
    {
        $folders = Folder::select('folders.*')
        ->where('user_id', '=', \Auth::id())
        // ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();

        $edit_folder = Folder::find($id);

        return view('todo.folder_edit',compact('folders','edit_folder'));
    }

    public function todo_folder_update(Request $request)
    {
        $posts = $request->all();
        $request->validate([ 'title' => 'required']);
        Folder::where('id', $posts['folder_id'])
        ->update(['folder' => $posts['title']]);
        return redirect( route('todo.folder_index') );
    }

    public function todo_folder_destory(Request $request)
    {
        // $posts = $request->all();
        $folder = Folder::find($request->post('folder_id'));
        // where('id',$posts['folder_id'])->first();

        $folder->memo()->delete();
        $folder->delete();

        // ->update(['deleted_at' => date("Y-m-d H:i:s",time())]);
        // Memo::select('memos.*')
        // ->leftjoin('memo_folders' ,'memo_folders.memo_id', '=' , 'memos.id')
        // ->leftjoin('folders' ,'folders.id', '=' , 'memo_folders.folder_id')
        // ->where('id',$posts['folder_id'])
        // ->update(['deleted_at' => date("Y-m-d H:i:s",time())]);

        return redirect(route('todo.folder_index'));
    }

}
