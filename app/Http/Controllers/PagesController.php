<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = "Welcome To laravel";
        // return view("pages.index",compact('title'));
        return view("pages.index")->with("title",$title);
    }

    public function about(){
        $title = "About Us";
        return view("pages.about")->with('title',$title);
    }
    public function create(){
        $title = "Posts";
        return view("posts.index")->with('title',$title);
    }
    public function services(){
        $data=array(
            'title' => 'Services',
            'services' => ["Web design","Data Analyse","Cyber Security"]      
        );
        return view("pages.services")->with($data);
    }
}
