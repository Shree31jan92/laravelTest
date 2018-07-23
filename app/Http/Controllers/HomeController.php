<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Post;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id=Auth::id();
        $posts=Post::with(['createdBy'])->orderBy('created_at','desc')->get();
        return view('home',['posts'=>$posts]);
    }
}
