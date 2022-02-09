<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaptchaController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function login(Request $res)
    {

        $res->validate([
            // 'email' => 'required',
            // 'password' => 'required',
            'captcha' => 'required|captcha',
        ]);
    }

    public function reload()
    {
        return response()->json(['captcha' => captcha_img()]);
    }
}