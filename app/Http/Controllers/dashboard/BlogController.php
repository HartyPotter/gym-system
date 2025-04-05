<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::paginate(10);  
        return view('dashboard.pages.Blog.index', compact('blogs'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.Blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'publish_date' => 'nullable|date',
            'category' => 'required|string|max:255',
            'status' => 'required|in:draft,published,archived',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->description = $request->description;

        // Handle Image Upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imageName = time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('public/profiles', $imageName); // استخدم التخزين بشكل ديناميكي هنا
            $blog->image = $imageName;
        }

        $blog->publish_date = $request->publish_date;
        $blog->category = $request->category;
        $blog->status = $request->status;
        $blog->create_user_id = auth()->user()->id;
        $blog->update_user_id = null;

        $blog->save();

        return redirect()->route('blogs.index')->with('Created_Blog_Successfully', "The Blog ($blog->title) has been created successfully.");
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('dashboard.pages.Blog.show', compact('blog'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id); // استخدام findOrFail
        return view('dashboard.pages.Blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'publish_date' => 'nullable|date',
            'category' => 'required|string|max:255',
            'status' => 'required|in:draft,published,archived',
        ]);

        $blog = Blog::findOrFail($id); // استخدام findOrFail
        $blog->title = $request->title;
        $blog->description = $request->description;

        // Handle Image Update
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($blog->image) {
                $oldImagePath = storage_path('app/public/profiles/' . $blog->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('public/profiles', $imageName); // استخدم التخزين بشكل ديناميكي هنا
            $blog->image = $imageName;
        }

        $blog->publish_date = $request->publish_date;
        $blog->category = $request->category;
        $blog->status = $request->status;
        $blog->update_user_id = auth()->user()->id;

        $blog->save();

        return redirect()->route('blogs.index')->with('Updated_Blog_Successfully', "The Blog ($blog->title) has been updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id); // استخدام findOrFail
        if ($blog->image) {
            $imagePath = storage_path('app/public/profiles/' . $blog->image);
            unlink($imagePath);
        }

        $blog->delete();
        return redirect()->route('blogs.index')->with('Deleted_Blog_Successfully', "The Blog ($blog->title) has been deleted successfully.");
    }
}
