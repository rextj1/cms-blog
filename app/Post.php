<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    //
    use SoftDeletes;
    protected $dates= ['published_at'];
    protected $fillable= [
        'title',
        'description',
        'content',
        'published_at',
        'image',
        'deleted_at',
        'category_id',
        'user_id'
    ];

    // functio  to delete image
    public function deleteImgae(){
       return Storage::delete($this->image);
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    // $this is the same as Post
    public function hasTag($tagId){
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

     // query scope for publish_at
     public function scopePublished($query)
     {
         return $query->where('published_at', '<=', now());
     }
    
    // query scope for search

    public function scopeSearched($query)
    {
        $search= request()->query('search');
        if(!$search){
            // in case there is no search simply return the published Post
            return $query->published();
        }

        // in case there is a search simply filter out only those that are published Post
        return $query->published()->where('title', 'LIKE', "%{$search}%");
    }

}
