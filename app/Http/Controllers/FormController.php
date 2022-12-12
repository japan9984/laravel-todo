<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MemoAddMail;

class FormController extends Controller
{
    public function send(Request $request)
    {
        $name = auth()->user()->name;
        $email = auth()->user()->email;

        Mail::send(new MemoAddMail($name, $email));

        return view('folder.index');
    }
}
