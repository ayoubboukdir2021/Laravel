@extends('layouts.app')

@section('content')


<div class="container">
    @if(Auth::check())
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @if( Auth::user()->admin  == 1)
                        <li class="breadcrumb-item"><a href="{{ route('archive') }}">Archive</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('all') }}">All</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users') }}">Users</a></li>
                    @endif
                    <li class="breadcrumb-item"><a href="{{ route('posts.create') }}">Add post</a></li>
                    <li class="breadcrumb-item ">
                        <a href="{{ route('mypost') }}">
                          My post
                        </a>
                      </li>
                    <li class="breadcrumb-item active">
                        post
                    </li>
                </ol>
                </nav>
            </div>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8 col-xs-12">
                <div class="card" style="margin-bottom: 15px;">
                    <div class="card-header bg-secondary text-white" style="text-align:right;"> 
                        
                        <p style="text-align:left;">{{ $post->first()->title }} </p>
                        <form action="{{ route('posts.destroy',['post' => $post->first()->id]) }}" method="POST" class="form">
                            @csrf
                                @method('DELETE')
                                <input style="text-align:left;"  type="submit" class="btn btn-danger btn-sm " value="delete"/></i>
                        </form>
                    </div>
                    <div class="card-body" style="text-align:right;">
                        <p style="text-align:left;">{{ $post->first()->description }}</p>
                        Posted by : {{ $post->first()->user->name }}   
                        <small class="badge badge-info">
                            {{ $post->first()->created_at->diffForHumans() }}
                        </small>
                    </div>
                   
                </div>
                
                
                
                  
        </div>
    </div>
</div>

@endsection
