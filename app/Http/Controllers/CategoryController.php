<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CategoryController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('admin-access');
        $categories = Category::with('creator')->paginate(10);
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        $this->authorize('admin-access');
        $categories = Category::all();
        return view('dashboard.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->authorize('admin-access');

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'parent_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:active,inactive',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'parent_id' => $request->parent_id,
            'status' => $request->status,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('dashboard.categories')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        $this->authorize('admin-access');
        $categories = Category::where('id', '!=', $category->id)->get();
        return view('dashboard.categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category)
    {
        $this->authorize('admin-access');

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'parent_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:active,inactive',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'parent_id' => $request->parent_id,
            'status' => $request->status,
        ]);

        return redirect()->route('dashboard.categories')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $this->authorize('admin-access');
        $category->delete();
        return redirect()->route('dashboard.categories')->with('success', 'Category deleted successfully.');
    }
}
