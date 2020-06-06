@extends('layouts.app')

@section('content')
    <div class=" d-flex justify-content-end mb-2">
        <a href="{{route('posts.create')}}" class="btn btn-success float-right">Add Posts</a>
    </div>

    
    <div class="card">
        <div class="card card-default">
            <div class="card-header">Posts</div>
        </div>

        <div class="card-body">
            @if(count($posts)>0)
                <table class="table table-light">
                    <thead class="thead-light">
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Post Category</th>
                            <th>Description</th>
                            <th>Content</th>
                            <th>Published At</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($posts as $post)
                            <tr>
                                <td><img class="img-thumbnail" width="100" src="{{asset('storage/'.$post->image)}}" alt="Post image"></td>
                                <td>{{$post->title}}</td>
                    
                                <td><a href="{{route('categories.edit',$post->category->id)}}">
                                        {{$post->category->name}}
                                    </a>
                                </td>

                                <td>{{$post->description}}</td>
                                <td>{!! $post->content !!}</td>
                                <td>{{$post->published_at}}</td>
                                @if(!$post->trashed())
                                    <td><a href="{{route('posts.edit',$post->id)}}" class="btn btn-info btn-sm">Edit</a>
                                @else
                                    <td>
                                        <form action="{{route('restore-posts',$post->id)}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-info btn-sm">Restore</button>
                                        </form>
                                        
                                    </td>
                                @endif 
                                
                                <td>   
                                    <form action="{{route('posts.destroy', $post->id)}}" method="post">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn btn-danger btn-sm">
                                            {{$post->trashed() ? 'Delete' : 'Trashed'}}
                                        </button>
                                    </form>
                                </td>
                                                                 
                            </tr>
                        @endforeach

                    </tbody>
                 </table>
            @else
                <h3 class="text-center">No posts yet</h3>
            @endif
           
        </div>
    </div>
@endsection