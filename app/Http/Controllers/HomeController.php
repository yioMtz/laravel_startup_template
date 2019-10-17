<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $roles = Auth::user()->getRoleNames();
        $role = $roles[0];
       switch ($role) {
           case 'admin':
               return view('admin.adminHome');
               break;
           case 'recepcionista':
               return view('home');
               break;

           default:
               # code...
               break;
       }
    }
}
