<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        return view('pages.home.home');
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }
}
