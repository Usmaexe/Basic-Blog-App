@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="panel-body">
                    <h3>Your Blog Posts</h3>
                    {{-- Look for the accordion Componenets in bootstrap5 --}}

                    @if(count($posts) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th style="align-content:center;">options</th>
                                <th></th>
                            </tr>

                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td style="display:flex;flex-direction:row;gap:10px;"><a href="/posts/{{$post->id}}/edit" class="btn btn-secondary">Edit</a>
                                    {!!Form::open(['url' => action('App\Http\Controllers\PostsController@destroy',$post->id),'method'=>'POST'])!!}
                                      {{Form::hidden("_method",'DELETE')}}
                                      {{Form::submit("Delete",['class'=>'btn btn-outline-danger'])}}
                                    {!!Form::close()!!}</td>
                                    <td>
                                        {{-- {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!} --}}
                                    </td>
                                </tr>
                            @endforeach
                        </table> 
                    @else
                        <p>You have no posts</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
