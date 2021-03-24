@extends('layouts/app')

@section('content')
    <div class="container">
        @if(session()->has('status'))
            <h3 style="color:green;">
                {{ session()->get('status') }}
            </h3>
        @endif

        <div class="row">
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      @if( Auth::user()->admin  == 1)
                          <li class="breadcrumb-item"><a href="{{ route('archive') }}">Archive</a></li>
                          <li class="breadcrumb-item"><a href="{{ route('all') }}">All</a></li>
                          <li class="breadcrumb-item"><a href="{{ route('users') }}">Users</a></li>
                      @endif
                      <li class="breadcrumb-item"><a href="{{ route('posts.create') }}">Add post</a></li>
                      <li class="breadcrumb-item active">
                          My post
                      </li>
                  </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($posts as $post)
                        <tr>
                          <td nowrap="nowrap">{{ $post->title }}</td>
                          <td>{{ $post->description }}</td>
                          <td nowrap="nowrap">{{ $post->updated_at->diffForHumans() }}</td>
                          <td>
                              <td>
                              <a href="{{ route('posts.edit',['post' => $post->id]) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                              </td>
                              <td>
                               <a href="{{ route('posts.show',['post' => $post->id]) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                              </td>
                          </td>
                        </tr>
                      @empty
                          <td>No Data</td>
                          <td>No Data</td>
                          <td>No Data</td>
                      @endforelse
                      
                    </tbody>
                </table>

                 {{-- Pagination --}}
                <div class="pagination justify-content-center">
                  {{ $posts->links() }}
              </div>
            </div>
        </div>
        
    </div>
@endsection