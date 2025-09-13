<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class WelcomeController extends Controller
{
    public function index()
    {
        $posts = Post::with(['author', 'category', 'tags'])
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(9);
            
        return view('welcome', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::with(['author', 'category', 'tags'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
            
        // Increment view count
        $post->increment('views');
        
        // Get related posts
        $relatedPosts = Post::with(['author', 'category'])
            ->where('status', 'published')
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->limit(3)
            ->get();
        
        return view('post.show', compact('post', 'relatedPosts'));
    }
}