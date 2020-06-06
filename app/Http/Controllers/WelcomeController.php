<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //
    public function index(){
        // return view('welcome')
        //         ->with('categories',$category::all())
        //         ->with('tags',$tag::all())
        //         ->with('posts',$post::all());

        //query scope for search

        // $search= request()->query('search');
        // if($search){
        //     $posts= Post::where('title', 'LIKE', "%{$search}%")->simplePaginate(3);
        // }else{
        //     $posts= Post::simplePaginate(4);
        // }

        return view('welcome')
            ->with('categories', Category::all())
            ->with('tags', Tag::all())
            ->with('posts', Post::searched()->simplePaginate(3));
            
    }
    
}
