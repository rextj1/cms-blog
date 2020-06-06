@extends('layouts.app')

@section('content')
    
    <div class="card">
        <div class="card card-default">
            <div class="card-header">Users</div>
        </div>

        <div class="card-body">
            @if(count($users)>0)
                <table class="table table-light">
                    <thead class="thead-light">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($users as $user)
                            <tr>
                                <td>{{'image'}}</td>
                                
                            {{-- <td><img class="img-thumbnail" width="60" src="{{asset('storage/'.$post->image)}}" alt="Post image"></td> --}}
                                <td><img src="{{gravatar('example@email', 'another_preset')}}"></td>
                                <td>{{$user->name}}</td>
                    
                                <td>
                                    {{$user->email}}
                                </td>

                                @if(!$user->isAdmin())
                                    <td>
                                        <form action="{{route('users.make-admin', $user->id)}}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn badge-success btn-sm">Make Admin</button>
                                        </form>
                                    </td>
                                @endif
                                                                 
                            </tr>
                        @endforeach

                    </tbody>
                 </table>
            @else
                <h3 class="text-center">No Users yet</h3>
            @endif
           
        </div>
    </div>
@endsection