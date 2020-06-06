<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostsRequest;


class PostsController extends Controller
{

    public function __construct(){
        return $this->middleware('verifyCategoriesCount')->only(['create','store']);
    } 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  
      

        $categories= Category::all();
        $posts= Post::all();
        return view('admin.posts.index',compact('posts','categories')); 
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tags= Tag::all();
        $categories= Category::all();
        return view('admin.posts.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        //
        $image=$request->image->store('posts');
        $post= Post::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'content'=>$request->content,
            'published_at'=>$request->published_at,
            'image'=>$image,
            'category_id'=>$request->category_id,
            'user_id'=> auth()->user()->id
        ]);

        if($request->tags){
            // manyToMany relationship for create method to database
            $post->tags()->attach($request->tags);
        }
        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags= Tag::all();
        $categories= Category::all();
        return view('admin.posts.create',compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request, Post $post)
    {
        // for security reasons
        $data= $request->only(['title','description','content','published_at']);

        // function for image when new image is uploaded for updating
        if($request->hasFile('image')){
            $image=$request->image->store('posts');
            // this is a delete function for image when new image is uploaded
            $post->deleteImgae();
    
            $data['image']= $image;
        }

        // for manyTomany relationship
        if($request->tags){
            $post->tags()->sync($request->tags);
        }

        $post->update($data);
        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post= Post::withTrashed()->where('id',$id)->first();
        if($post->trashed()){
            $post->deleteImgae();
            $post->forceDelete();
        }else{
            $post= $post->delete();
        }      
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }

    public function trashed(){
        $trashed= Post::onlyTrashed()->get();
        return view('admin.posts.index')->with('posts',$trashed);
    }

    public function restore($restoreId){
        $post= Post::withTrashed()->where('id',$restoreId)->first();
        $post->restore();
        return redirect()->back()->with('success', 'Post restored successfully');
    }

}
