@extends('layouts.app')
@section('content')
    <a href = "/posts" class="btn btn-outline-secondary">&laquo; Go Back</a>
    <div class="article-container">
      <img style="width:30%; margin:10px 0px" src="/storage/cover_images/{{$post->cover_image}}">
      <br>
      <div class="title-container">
        <h1 class="title">{{$post->title}}</h1>
        @if(!Auth::guest())
          @if(Auth::user()->id == $post->user_id)
            <div class="title-container" style="gap:0.5em;">
              <a href="/posts/{{$post->id}}/edit" class="btn btn-secondary EorD-button">Edit</a>
              {{-- <a href="/posts/{{$post->id}}/edit" class="btn btn-outline-danger EorD-button">Delete</a> --}}
              {!!Form::open(['url' => action('App\Http\Controllers\PostsController@destroy',$post->id),'method'=>'POST'])!!}
                {{Form::hidden("_method",'DELETE')}}
                {{Form::submit("Delete",['class'=>'btn btn-outline-danger EorD-button'])}}
              {!!Form::close()!!}
            </div>
          @endif
        @endif
      </div>
      <div>
        {!!$post->body!!}
      </div>
      <hr style="width:40%">
      <small>Written on {{$post->created_at}}  by {{$post->user['name']}}</small><BR><BR>
    </div>
    
      
    {{-- @if(count($posts)>1)
      <ul class="list-group">
        @foreach ($posts as $post)
          <li class="list-group-item">
            <h4><a href="/posts/{{$post->id}}">{{$post->title}}</a></h4>
          </li>
        @endforeach
      <ul>
    @else
      <h1>No Posts found</h1>
    @endif --}}
@endsection