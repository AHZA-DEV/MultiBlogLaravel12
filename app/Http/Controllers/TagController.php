<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            $tags = Tag::with('creator')->withCount('posts')->paginate(10);
        } else {
            $tags = Tag::where('created_by', $user->id)->withCount('posts')->paginate(10);
        }
        
        return view('dashboard.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('dashboard.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        Tag::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('dashboard.tags')->with('success', 'Tag created successfully.');
    }

    public function edit(Tag $tag)
    {
        $user = Auth::user();
        
        if ($user->role !== 'admin' && $tag->created_by !== $user->id) {
            abort(403, 'Unauthorized access');
        }

        return view('dashboard.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $user = Auth::user();
        
        if ($user->role !== 'admin' && $tag->created_by !== $user->id) {
            abort(403, 'Unauthorized access');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $tag->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard.tags')->with('success', 'Tag updated successfully.');
    }

    public function destroy(Tag $tag)
    {
        $user = Auth::user();
        
        if ($user->role !== 'admin' && $tag->created_by !== $user->id) {
            abort(403, 'Unauthorized access');
        }

        $tag->delete();
        return redirect()->route('dashboard.tags')->with('success', 'Tag deleted successfully.');
    }
}
