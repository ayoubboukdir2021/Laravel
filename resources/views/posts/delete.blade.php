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
                            <li class="breadcrumb-item"><a href="#">Users</a></li>
                            <li class="breadcrumb-item"><a href="#">Add admin</a></li>
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
                
              
                    
            </div>
        </div>
        
    </div>
@endsection