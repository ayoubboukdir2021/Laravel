@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('posts.create') }}">Add post</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('mypost') }}">
                      My post
                    </a>
                    </li>
                      @if( Auth::user()->admin  == 1)
                          <li class="breadcrumb-item"><a href="{{ route('archive') }}">Archive</a></li>
                          <li class="breadcrumb-item"><a href="{{ route('users') }}">Users</a></li>
                          <li class="breadcrumb-item">All</li>
                      @endif
                  </ol>
                </nav>
            </div>
        </div>
        
        <div class="row justify-content-center">
          <div class="col-md-8">
              {{-- Posts --}}
              @foreach ($posts as $post)
                  <div class="card" style="margin-bottom: 15px;">
                      <div class="card-header bg-secondary"> 
                          <a href="{{ route('posts.show' , ['post'=>$post->id]) }}" class="text-white" >
                          {{ $post->title }}
                          </a>
                      </div>
  
                      <div class="card-body" style="text-align:right;">
                          <p style="text-align:left;">{{ $post->description }}</p>
  
                          <small class="badge badge-info">
                              {{ $post->created_at->diffForHumans() }}
                          </small>
                      </div>
                  </div>
              @endforeach
  
              {{-- Pagination --}}
              <div class="pagination justify-content-center">
                  {{ $posts->links() }}
              </div>
              
          </div>
      </div>
        
    </div>
@endsection