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
                            <li class="breadcrumb-item"><a href="#">Add admin</a></li>
                        @endif
                        <li class="breadcrumb-item active">
                            <a href="{{ route('mypost') }}">
                            My post
                          </a>
                        </li>
                        <li class="breadcrumb-item">Add post</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                
              <form action="{{ route('posts.store') }}" method="POST" class="form">
                @csrf
                        <div class="form-group">
            
                            <input class="form-control" style="margin-bottom: 5px" type="text" 
                                name="title" placeholder="title" id="title"  />
                            
                            <textarea class="form-control " name="description" id="description" cols="80" 
                                    rows="10" placeholder="description" >
                                    
                            </textarea>
                            
                        </div>
                        
                      @include('posts.form')

                      <input type="submit" class="btn btn-info btn-block" value="submit"/>
              </form>
                    
            </div>
        </div>
        
    </div>
@endsection