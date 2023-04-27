@extends('layouts.app')
@section('content')
    <h1>Posts</h1>
    @if(count($posts)>0)
      <ul class="list-group">
        @foreach ($posts as $post)
          {{-- <li class="list-group-item">
          </li> --}}
          <li class="list-group-item imgAndContent">
            <img style="width:30%; margin:10px 0px" src="/storage/cover_images/{{$post->cover_image}}">
            <div>
              <h4><a href="/posts/{{$post->id}}" class="posts-links">{{$post->title}}</a></h4>
              <small>Written on {{$post->created_at}} by {{$post->user['name']}}</small>
            </div>
          </li>
        @endforeach
      </ul>
      {{$posts->links()}}
    @else
      <h1>No Posts found</h1>
    @endif
@endsection