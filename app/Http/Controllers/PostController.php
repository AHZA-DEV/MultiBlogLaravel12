<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $posts = Post::with(['author', 'category'])->paginate(10);
        } else {
            $posts = Post::where('author_id', $user->id)->with(['category'])->paginate(10);
        }

        return view('dashboard.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::where('status', 'active')->get();
        $tags = Tag::all();
        return view('dashboard.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'author_id' => Auth::id(),
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'published_at' => $request->status === 'published' ? now() : null,
        ]);

        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('postImage', 'public');
            $post->featured_image = $imagePath;
            $post->save();
        }

        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('dashboard.posts')->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        $user = Auth::user();

        if ($user->role !== 'admin' && $post->author_id !== $user->id) {
            abort(403, 'Unauthorized access');
        }

        $categories = Category::where('status', 'active')->get();
        $tags = Tag::all();
        return view('dashboard.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        $user = Auth::user();

        if ($user->role !== 'admin' && $post->author_id !== $user->id) {
            abort(403, 'Unauthorized access');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'published_at' => $request->status === 'published' && !$post->published_at ? now() : $post->published_at,
        ]);

        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('postImage', 'public');
            $post->featured_image = $imagePath;
            $post->save();
        }

        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('dashboard.posts')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $user = Auth::user();

        if ($user->role !== 'admin' && $post->author_id !== $user->id) {
            abort(403, 'Unauthorized access');
        }

        $post->delete();
        return redirect()->route('dashboard.posts')->with('success', 'Post deleted successfully.');
    }
}