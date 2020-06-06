@if(session()->has('error'))
    <div class="alert alert-dismissible alert-danger fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ session()->get('error') }}
    </div>    
@endif

{{-- flash message --}}
{{-- @if(session('success')) --}}
@if(session()->has('success'))
    <div class="alert alert-dismissible alert-success fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {!! session()->get('success') !!}
    </div>    
@endif


