@extends('layouts.app')

@section('content')


<div class="container">
    {{-- <div class="row">
        <div class="col-md-6 my-15">
            <ul class="nav nav-tabs nav-stacked">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link @if($page == "home") active @endif ">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('archive') }}" class="nav-link @if($page == "archive") active @endif ">Archive</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('all') }}" class="nav-link @if($page == "all") active @endif ">All</a>
                </li>
            </ul>
        </div>
    </div> --}}
    
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

