<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

// this class is named HomeController but we change it's name to make it more logical in the use
class DashBoardController extends Controller
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
        $user_id = auth()->user()->id;
        // $user = new User([$user_id]);
        $user = User::find($user_id);
        // var_dump($user);
        // return view('/');
        return view('dashboard')->with('posts',$user->posts);
    }
}
