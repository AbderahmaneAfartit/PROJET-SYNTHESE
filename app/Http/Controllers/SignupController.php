<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function Showsigne(){
        return view('pages.auth.signup');
    }
}
