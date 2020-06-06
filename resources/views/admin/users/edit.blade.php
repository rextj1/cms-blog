@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">My Profile</div>

        <div class="card-body">
            <form action="{{route('users.update-profile')}}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="">Name</label>
                    <input id="" class="form-control" type="text" name="name" value="{{$user->name}}">
                </div>

                <div class="form-group">
                    <label for="">About Me</label>
                    <textarea id="" class="form-control" name="about" rows="5" cols="5">{{$user->about}}</textarea>
                </div>

                <button type="submit" class="btn btn-success">Update Profile</button>
            </form>

        </div>
    </div>
        
@endsection
