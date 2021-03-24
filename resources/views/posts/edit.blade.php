@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        @if( Auth::user()->admin  == 1)
                            <li class="breadcrumb-item"><a href="{{ route('archive') }}">Archive</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('all') }}">All</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users') }}">Users</a></li>
                        @endif
                        <li class="breadcrumb-item active">
                            <a href="{{ route('mypost') }}">
                                My post
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('posts.create') }}">Add post</a></li>
                        <li class="breadcrumb-item">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                
              <form action="{{ route('posts.update' , ['post'=>$post->first()->id]) }}" method="POST" class="form">
                @csrf
                @method('PATCH')
                    <div class="form-group">
        
                        <input class="form-control" style="margin-bottom: 5px" type="text" 
                            name="title" placeholder="title" id="title" 
                            value="{{ old('title' , $post->first()->title ?? null ) }}"
                            />
                        
                        <textarea class="form-control " name="description" id="description" cols="80" 
                                rows="10" placeholder="description" >
                                {{ old('description' , $post->first()->description ?? null ) }}
                        </textarea>
                        
                    </div>
                    @include('posts.form')
                    
                    <input type="submit" class="btn btn-info btn-block" value="Update"/>
              </form>
                    
            </div>
        </div>
        
    </div>
@endsection