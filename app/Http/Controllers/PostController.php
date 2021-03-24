<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at','desc')->paginate(10);

        return view('home',['page'=>'index','posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.createpost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $data = $request->only(['title','description']);
        $data['user_id'] = Auth::user()->id;
        $post = Post::create($data);
        
        $request->session()->flash('status','post was created');
        return redirect()->route('mypost');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with('user')->where(['id'=>$id,'user_id'=>Auth::user()->id])->get();
        
        if($post->count() > 0 )
            return view('posts.show',['post'=>$post]);
        else
            return redirect()->route('mypost');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::where(['id'=>$id,'user_id'=>Auth::user()->id])->get();
        if($post->count() > 0 )
            return view('posts.edit',['post'=>$post]);
        else
            return redirect()->route('mypost');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        $post = Post::findorFail($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();

        $request->session()->flash('status','post was updated');
        return redirect()->route('mypost');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id , Request $request)
    {
        Post::destroy($id);

        $request->session()->flash('status','post was deleted');
        return redirect()->route('mypost');
        
    }

    public function archive()
    {
        return view('posts.archive',[
            "posts" => Post::onlyTrashed()->orderBy('updated_at','desc')->paginate(10)
        ]);
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->whereId($id)->first();

        $post->restore();
        return redirect()->back();
    }

    public function forcedelete($id)
    {
        $post = Post::onlyTrashed()->whereId($id)->first();

        $post->forceDelete();
        return redirect()->back();
    }

    public function all()
    {
        return view('posts.all',[
            "posts" => Post::withTrashed()->orderBy('updated_at','desc')->paginate(10)
        ]);
    }

    public function users()
    {
        $users = User::withcount('post')->orderBy('created_at','desc')->paginate(10);
        return view('posts.users',['users'=>$users]);
    }

    public function usersrchive()
    {
        return view('posts.archiveusers',[
            "users" => User::onlyTrashed()->orderBy('updated_at','desc')->paginate(10)
        ]);
    }

    public function restoreuser($id)
    {
        $post = User::onlyTrashed()->whereId($id)->first();

        $post->restore();
        return redirect()->back();
    }

    public function forcedeleteuser($id)
    {
        $post = User::onlyTrashed()->whereId($id)->first();

        $post->forceDelete();
        return redirect()->back();
    }

    public function destroyuser($id , Request $request)
    {
        User::destroy($id);

        $request->session()->flash('status','user was deleted');
        return redirect()->route('users');
    }

    public function mypost()
    {
        $posts = Post::where(['user_id'=>Auth::user()->id])->paginate(5);
        return view('posts.mypost', ['posts'=>$posts]);
    }

    public function filterusers(Request $request)
    {
        
        if($request->date != null)
        {
            // App\Models\User::where('created_at','like','%2021-03-21%')->get()
            $date ='%'.$request->date.'%';
            
                       
            $users = User::withcount('post')->where('created_at','like',$date)->orderBy('updated_at','desc')->paginate(10);
            return view('posts.users',['users'=> $users]);
        }
        else if($request->email != null)
        {
            $users = User::withcount('post')->where('email',$request->email)->orderBy('updated_at','desc')->paginate(10);

            return view('posts.users',['users'=> $users]);
        }
        else if($request->id != null)
        {
            $users = User::withcount('post')->where('id',$request->id)->orderBy('updated_at','desc')->paginate(10);

            return view('posts.users',['users'=> $users]);
        }
        else
        {
            $users = User::withcount('post')->orderBy('created_at','desc')->paginate(10);
            return view('posts.users',['users'=> $users]);
        }
        
    }

    
}
