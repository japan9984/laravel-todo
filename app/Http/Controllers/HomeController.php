<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Mail\Mailables\Content;
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

    public function home()
    {
        return view('create');
    }

    public function index()
    {
        $user_id = auth()->id();
        $folders = Folder::where('user_id', $user_id)
        ->orderBy('updated_at', 'DESC')
        ->get();
        return view('folder.top', compact('folders'));
    }
}
