<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
    public function index()
    {
        /*if(isset(auth()->user()->name)) {
            $username = auth()->user()->name;
            $pageowner = 's startsida';
            if (substr($username, -1) === 's') {
                $pageowner = ' startsida';
            }
            return view('home')->with('pageowner', $pageowner);
        }
        else{
            return view('home');
        }*/
        return view('home');
    }

}
