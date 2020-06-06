<?php

namespace App\Http\Controllers\Blog;

use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function show(Post $post)
    {
        return view('blog.show')->with('post',$post);
    }

    public function category(Category $category)
    {
        //query scope for search. go to the post controller for this query.

        // $search= request()->query('search');
        // if($search){
        //     $posts= $category->posts()->where('title', 'LIKE', "%{search}%")->simplePaginate(1);
        // }else{
        //     $posts= $category->posts()->simplePaginate(1);
        // }
        return view('blog.category')
            ->with('category', $category)
            ->with('categories', Category::all())
            ->with('tags', Tag::all())
            ->with('posts', $category->posts()->searched()->simplePaginate(3)); // all posts belonging to this category
    }

    public function tag(Tag $tag)
    {
         //query scope for search

        // $search= request()->query('search');
        // if($search){
        //     $posts= $tag->posts()->where('title', 'LIKE', "%{search}%")->simplePaginate(1);
        // }else{
        //     $posts= $tag->posts()->simplePaginate(1);
        // }

        return view('blog.tag')
            ->with('tag',$tag)
            ->with('categories', Category::all())
            ->with('tags', Tag::all())
            ->with('posts',  $tag->posts()->searched()->simplePaginate(3));
    }
    
}
