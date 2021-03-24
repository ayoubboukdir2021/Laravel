@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('posts.create') }}">Add post</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('mypost') }}">
                      My post
                    </a>
                    </li>
                      @if( Auth::user()->admin  == 1)
                          <li class="breadcrumb-item"><a href="{{ route('all') }}">All</a></li>
                          <li class="breadcrumb-item"><a href="{{ route('users') }}">Users</a></li>
                          <li class="breadcrumb-item">Archive</li>
                      @endif
                     
                  </ol>
                </nav>
            </div>
            <div id="appselect" class="col-md-6">
                <select id="accesRapide" name="accesRapide" onchange="getaccesRapide()" >
                    <option value="">Select Archive</option>
                    <option value="/posts/archive">Posts</option>
                    <option value="/users/archive">Users</option>
                </select>
            </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-md-8">
              {{-- Posts --}}
              @foreach ($posts as $post)
                  <div class="card" style="margin-bottom: 15px;">
                      <div class="card-header bg-secondary"> 
                          <p class="text-white">
                          {{ $post->title }}
                          </p>
                            <div style="text-align:right;">
                                <form style="display:inline;" action="{{ route('restore',['id' => $post->id]) }}" method="POST" class="form" >
                                    @csrf
                                    @method('PATCH')
                                        <input type="submit" class="btn btn-success btn-sm " value="restore"/></i>
                                </form>

                                <form style="display:inline;" method="POST" action="{{ route('forcedelete',['id'=>$post->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger btn-sm " value="Force delete"/></i>
                                </form>
                            </div>

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


@section('javascript')
    <script>
        function getaccesRapide()
        {
            var select = document.getElementById('accesRapide');
            // alert(select.options[select.selectedIndex].value);
            window.location = select.options[select.selectedIndex].value;
            // alert('salam');
        }
    </script>
@endsection