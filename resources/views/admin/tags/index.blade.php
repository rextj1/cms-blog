@extends('layouts.app')

@section('content')
    <div class=" d-flex justify-content-end mb-2">
        <a href="{{route('tags.create')}}" class="btn btn-success float-right">Add Tags</a>
    </div>
  
    <div class="card">
        <div class="card card-default">
            <div class="card-header">Tags</div>
        </div>

        <div class="card-body">
        @if(count($tags)>0)
            <table class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Post Count</th>
                </tr>
              </thead>
              <tbody>
                  @foreach($tags as $tag)
                    <tr>                
                        <td>{{$tag->name}}</td>  
                        <td>
                        <td>{{$tag->posts->count()}}</td>
                        <td>
                        <a href="{{route('tags.edit', $tag->id)}}" class="btn btn-primary btn-sm">Edit</a>
                           
                        <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $tag->id }})">delete</button>
                        </td>
                    </tr>
                    
                    
                @endforeach

                
              </tbody>
            </table>
            @else
                <h3 class="text-center">No Tags yet</h3>
            @endif
               <!-- Button trigger modal -->
           
              
              <!-- Modal  -->
              <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form action="" method="POST" id="deletetagForm">
                    @method('DELETE')
                    @csrf
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete tag</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p class="text-center text-bold">
                          Are you sure you want to delete Tag
                        </p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No,Go Back</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                      </div>
                    </div>  
                  </form>
                </div>
              </div>


        </div>

      
 
     
      
    </div>
@endsection

<script>
  function handleDelete(id){
    
    var form= document.getElementById('deletetagForm')
    form.action= '/tags/' + id
    console.log('deleting.', form)
    $('#deleteModal').modal('show')
  }
</script>