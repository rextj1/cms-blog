@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card card-default">
            <div class="card-header">
                {{isset($tag) ? 'Edit Tag' : 'Create Tags'}} 
            </div>
        </div>

        <!-- form -->
        <form action="{{isset($tag) ? route('tags.update',$tag->id) : route('tags.store')}}" 
              method="POST">
            @csrf
            @if(isset($tag))
                @method('PUT') 
            @endif

            <div class="card-body">
                <div class="form-group">
                    <label for="my-input">Name</label>
                    <input id="my-input" class="form-control" type="text" name="name" value="{{isset($tag) ? $tag->name : ''}}">
                </div>

                <div class="form-group">
                   <button class=" btn btn-success">{{isset($tag) ? 'Update Tag' : 'Create Tags'}}</button>
                </div>
            </div>
            
        </form>
        
      
    </div>
@endsection