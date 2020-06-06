@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card card-default">
            <div class="card-header">
               {{isset($post) ? 'Edit Post' : 'Create Posts'}}
            </div>
        </div>

        <!-- form -->
        <form action="{{isset($post) ? route('posts.update',$post->id) : route('posts.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            @if(isset($post))
                @method('PUT')
            @endif
            
            <div class="card-body">
                <div class="form-group">
                    <label for="">Title</label>
                    <input id="" class="form-control" type="text" name="title" value="{{isset($post) ? $post->title : ''}}">
                </div>

                <div class="form-group">
                    <label for="">description</label>
                    <textarea class="form-control" name="description" id="" cols="5" rows="5">{{isset($post) ? $post->description : ''}}</textarea>
                </div>

                <div class="form-group">

                    <input id="content" type="hidden" name="content" value="{!! isset($post) ? $post->content : ''!!}">
                    <trix-editor input="content"></trix-editor>

                </div>

                @if(isset($post))
                    <div class="form-group">
                        <img class="img-thumbnail" style="width: 50%"  src="{{asset('storage/'.$post->image)}}" alt="">
                    </div>
                @endif

                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category" class="form-control" name="category_id">
                        @foreach($categories as $category)
                            
                            <option value="{{$category->id}}"
                                @if(isset($post))
                                    @if($category->id == $post->category_id)
                                        selected
                                    @endif
                                @endif
                                >
                                {{$category->name}} 
                            </option>
                           
                        @endforeach
                    </select>
                </div>

        
                @if($tags->count()>0)
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <select id="tags" class="form-control" name="tags[]" multiple>
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}"
                                    @if(isset($post))
                                        @if($post->hasTag($tag->id))
                                        {{-- @if(in_array($tag->id, $post->tags->pluck('id')->toArray())) --}}
                                            selected
                                        @endif
                                    @endif
                                    >
                                    {{$tag->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
                


                <div class="form-group">
                    <label for="">Published At</label>
                    <input id="published_at" class="form-control" type="text" name="published_at" value="{{isset($post) ? $post->published_at : ''}}">
                </div>

                <div class="form-group">
                    <label for="">File</label>                  
                    <input id="" class="form-control" type="file" name="image" value="">
                </div>

                <div class="form-group">
                   <button class="btn btn-success">{{isset($post) ? 'Edit Post' : 'Create Posts'}}</button>
                </div>
            </div>
            
        </form>
        
      
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        flatpickr('#published_at', {
            enableTime: true
        })
        
    </script>
@endsection

 

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
