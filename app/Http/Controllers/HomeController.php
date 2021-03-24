<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        return view('home',['page'=>'index','posts'=>$posts]);
    }

      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $countUsers = User::all()->count();
        $countPostsParUser = User::whereId(Auth::user()->id)->count();
        $countallUsers = User::withTrashed()->count();
        $countPosts = Post::all()->count();
        $countTrashedPosts = User::onlyTrashed()->count();
        return view('posts.dashboard',
            [
                'users'=>$countUsers ,
                'postsuser'=>$countPostsParUser, 
                'allusers'=>$countallUsers,
                'posts'=>$countPosts,
                'suspended'=>$countTrashedPosts

            ]
        );
    }

    
}
