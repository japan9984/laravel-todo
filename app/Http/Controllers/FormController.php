<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MemoAddMail;

class FormController extends Controller
{
    public function send(Request $request) {

        return view('folder.index');
      }
}
