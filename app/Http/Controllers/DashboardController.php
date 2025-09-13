<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DashboardController extends Controller
{
    use AuthorizesRequests;

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
}
