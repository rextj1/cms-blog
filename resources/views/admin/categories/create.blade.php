@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card card-default">
            <div class="card-header">
                {{isset($category) ? 'Edit Category' : 'Create Categories'}} 
            </div>
        </div>

        <!-- form -->
        <form action="{{isset($category) ? route('categories.update',$category->id) : route('categories.store')}}" 
              method="POST">
            @csrf
            @if(isset($category))
                @method('PUT') 
            @endif

            <div class="card-body">
                <div class="form-group">
                    <label for="my-input">Name</label>
                    <input id="my-input" class="form-control" type="text" name="name" value="{{isset($category) ? $category->name : ''}}">
                </div>

                <div class="form-group">
                   <button class=" btn btn-success">{{isset($category) ? 'Update Category' : 'Create Categories'}}</button>
                </div>
            </div>
            
        </form>
        
      
    </div>
@endsection