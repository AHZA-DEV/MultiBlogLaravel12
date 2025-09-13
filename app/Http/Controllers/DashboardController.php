<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        // Pass user data to the dashboard view
        return view('dashboard.index', compact('user'));
    }

    // Admin-only features
    public function users()
    {
        $this->authorize('admin-access');
        $users = \App\Models\User::paginate(10);
        return view('dashboard.users.index', compact('users'));
    }

    public function categories()
    {
        $this->authorize('admin-access');
        // Categories management logic will go here
        return view('dashboard.categories.index');
    }

    // Both admin and user features  
    public function posts()
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            // Admin can see all posts
            $posts = \App\Models\Post::with(['author', 'category'])->paginate(10);
        } else {
            // User can only see their own posts
            $posts = \App\Models\Post::where('author_id', $user->id)->with(['category'])->paginate(10);
        }
        
        return view('dashboard.posts.index', compact('posts'));
    }

    public function tags()
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            // Admin can see all tags
            $tags = \App\Models\Tag::with('creator')->paginate(10);
        } else {
            // User can only see tags they created
            $tags = \App\Models\Tag::where('created_by', $user->id)->paginate(10);
        }
        
        return view('dashboard.tags.index', compact('tags'));
    }
}
