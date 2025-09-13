<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DashboardController extends Controller
{
    use AuthorizesRequests;
    // Middleware is already applied in routes/web.php

    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            // Admin sees system-wide statistics
            $totalUsers = \App\Models\User::count();
            $totalPosts = \App\Models\Post::count();
            $totalCategories = \App\Models\Category::count();
            $totalTags = \App\Models\Tag::count();
            
            return view('dashboard.app', compact('totalUsers', 'totalPosts', 'totalCategories', 'totalTags'));
        } else {
            // Regular users see their own statistics
            $myPosts = \App\Models\Post::where('author_id', $user->id)->count();
            $myTags = \App\Models\Tag::where('created_by', $user->id)->count();
            $draftPosts = \App\Models\Post::where('author_id', $user->id)->where('status', 'draft')->count();
            $publishedPosts = \App\Models\Post::where('author_id', $user->id)->where('status', 'published')->count();
            
            return view('dashboard.app', compact('myPosts', 'myTags', 'draftPosts', 'publishedPosts'));
        }
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
