@extends('layouts.app')

@section('content')
    <div class=" d-flex justify-content-end mb-2">
        <a href="{{route('categories.create')}}" class="btn btn-success float-right">Add Categories</a>
    </div>
  
    <div class="card">
        <div class="card card-default">
            <div class="card-header">Categories</div>
        </div>

        <div class="card-body">
        @if(count($categories)>0)
            <table class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Post Count</th>
                </tr>
              </thead>
              <tbody>
                  @foreach($categories as $category)
                    <tr>                
                        <td>{{$category->name}}</td>  
                        <td>
                        <td>{{$category->posts->count()}}</td>
                        <td>
                        <a href="{{route('categories.edit', $category->id)}}" class="btn btn-primary btn-sm">Edit</a>
                           
                        <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $category->id }})">delete</button>
                        </td>
                    </tr>
                    
                    
                @endforeach

                
              </tbody>
            </table>
            @else
                <h3 class="text-center">No categories yet</h3>
            @endif
               <!-- Button trigger modal -->
           
              
              <!-- Modal  -->
              <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form action="" method="POST" id="deleteCategoryForm">
                    @method('DELETE')
                    @csrf
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p class="text-center text-bold">
                          Are you sure you want to delete Category
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
    
    var form= document.getElementById('deleteCategoryForm')
    form.action= '/categories/' + id
    console.log('deleting.', form)
    $('#deleteModal').modal('show')
  }
</script>