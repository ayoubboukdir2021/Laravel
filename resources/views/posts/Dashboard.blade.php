@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('posts.create') }}">Add post</a></li>
                        <li class="breadcrumb-item active">
                          <a href="{{ route('mypost') }}">
                            My post : 
                          </a>
                        </li>
                        @if( Auth::user()->admin  == 1)
                            <li class="breadcrumb-item"><a href="{{ route('archive') }}">Archive</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('all') }}">All</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users') }}">Users</a></li>
                        @endif
                    </ol>
                </nav>
            </div>
        </div>

        @if (Auth::user()->admin)
            <div class="row">
                <div class="col-sm-6">
                    <div class="card" style="margin-bottom: 5px;" >
                        <div class="card-body">
                        <h5 class="card-title">
                            Users number : 
                            <span class="badge bg-success text-white"> {{ $allusers }} </span>
                        </h5>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6">
                <div class="card" style="margin-bottom: 5px; ">
                    <div class="card-body">
                        <h5 class="card-title">
                        Number of articles : 
                        <span class="badge bg-success text-white"> {{ $posts }} </span>
                        </h5>
                    </div>
                </div>
                </div>

                <div class="col-sm-6">
                    <div class="card" style="margin-bottom: 5px;" >
                    <div class="card-body">
                        <h5 class="card-title">
                            Suspended accounts : 
                            <span class="badge bg-success text-white"> {{ $suspended }} </span>
                        </h5>
                        
                    </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Number of active accounts : 
                            <span class="badge bg-success text-white"> {{ $users }} </span>
                        </h5>
                    </div>
                    </div>
                </div>

            </div>
        @else
            <div class="row">
                <div class="col-sm-6">
                    <div class="card" style="margin-bottom: 5px;" >
                        <div class="card-body">
                            <h5 class="card-title">
                                Number of articles : 
                                <span class="badge bg-success text-white"> {{ $postsuser }} </span>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        
    </div>
@endsection