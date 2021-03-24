@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">
                            <a href="{{ route('mypost') }}">
                              My post
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('posts.create') }}">Add post</a></li>
                        @if( Auth::user()->admin  == 1)
                            <li class="breadcrumb-item"><a href="{{ route('archive') }}">Archive</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('all') }}">All</a></li>
                            <li class="breadcrumb-item">Users</li>
                        @endif
                       
                    </ol>
                </nav>
            </div>
        </div>

        <form method="POST" action="{{ route('filterusers') }}" class="form">
            @csrf
            <div class="row justify-content-center" style="margin:10px auto">
                
                <div class="col-md-3 col-sm-12 form-group">
                    <input class="form-control" onchange="validechampe()" type="date" name="date" id="date" placeholder="date search  ">
                </div>
                <div class="col-md-3 col-sm-12 form-group">
                    <input class="form-control" onchange="validechampe()" type="email" name="email" id="email" placeholder="email search ">
                </div>
                <div class="col-md-3 col-sm-12 form-group">
                    <input class="form-control" onchange="validechampe()" type="number" name="id" id="id" placeholder="id search ">
                </div>
                <div class="col-md-3 col-sm-12 form-group">
                    <input class="btn btn-primary btn-block" type="submit" value="Search">
                </div>
                
            </div>
        </form>

        <div class="row justify-content-center">
            <div class="col-md-8">
                {{-- Users --}}
                @foreach ($users as $user)
                    <div class="card" style="margin-bottom: 15px;">
                        <div class="card-header bg-secondary"> 
                            <p class="text-white">
                            {{ $user->name }}
                            </p>
                            <div style="text-align:right;" >
                            <span class="badge bg-success">{{ $user->post_count }} (posts)</span>
                            </div>
                        </div>
    
                        <div class="card-body" style="text-align:right;">
                            <p style="text-align:left;">{{ $user->email }}</p>
                            <form style="text-align:left;" action="{{ route('destroyuser',['user' => $user->id]) }}" method="POST" class="form">
                                @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger btn-sm " value="delete"/></i>
                            </form>
                            
    
                            <small class="badge badge-info">
                                {{ $user->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                @endforeach
    
                {{-- Pagination --}}
                <div class="pagination justify-content-center">
                    {{ $users->links() }}
                </div>
                
            </div>
        </div>
        
    </div>
@endsection

@section('javascript')
    <script>
        function validechampe()
        {
            var date = document.getElementById('date');
            var email = document.getElementById('email');
            var id = document.getElementById('id'); 

            if(date.value!="")
            {
                email.disabled  = true;
                id.disabled  = true;
                
            }
            else if(email.value!="")
            {
                date.disabled  = true;
                id.disabled  = true;
            }
            else if(id.value!="")
            {
                date.disabled  = true;
                email.disabled  = true;
            }
            else
            {
                date.disabled  = false;
                email.disabled  = false;
                id.disabled  = false;
            }
        }
    </script>
@endsection