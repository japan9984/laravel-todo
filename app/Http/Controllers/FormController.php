<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function postValidates(Request $request) {
        return view('sample.index',['msg'=>'OK']);
      }
}
