<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\tags\CreateTagRequest;
use App\Http\Requests\tags\UpdateTagRequest;

class tagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tags= Tag::all();
        return view('admin.tags.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagRequest $request)
    {
        // check CreateTagRequest for validation

        $Tag= Tag::create([
            'name'=>$request->name
        ]);
        return redirect()->route('tags.index')->with('success', 'Tag created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $Tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $Tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
        return view('admin.tags.create',compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $Tag
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        //
        $tag->name= $request->name;
        $tag->save();
        return redirect()->route('tags.index')->with('success', 'Tag updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $Tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
        if($tag->posts->count()>0){
            return redirect()->back()->with('error', 'Tags cannot be deleted because it is associated with some posts');
        }
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully');
    }
  
}
