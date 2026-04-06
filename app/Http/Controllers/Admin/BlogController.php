<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderByDesc('published_at')->paginate(20);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_canonical' => 'nullable|string|max:255',
            'feature_image' => 'nullable|string',
            'content' => 'required|string',
            'is_active' => 'boolean',
            'published_at' => 'nullable|date',
        ]);
        if (empty($data['published_at'])) {
            $data['published_at'] = now();
        }
        if (empty($data['slug'])) {
            $data['slug'] = \Str::slug($data['title']);
            $original = $data['slug'];
            $i = 1;
            while (Blog::where('slug', $data['slug'])->exists()) {
                $data['slug'] = $original.'-'.$i++;
            }
        }
        if ($request->hasFile('feature_image_upload')) {
            $image = $request->file('feature_image_upload');
            $extension = $image->getClientOriginalExtension();
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $sanitizedName = \Illuminate\Support\Str::slug($originalName);
            $imageName = time() . '_' . $sanitizedName . '.' . $extension;
            $image->move(public_path('images/blogs'), $imageName);
            $data['feature_image'] = '/images/blogs/' . $imageName;
        }
        Blog::create($data);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug,' . $blog->id,
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_canonical' => 'nullable|string|max:255',
            'feature_image' => 'nullable|string',
            'content' => 'required|string',
            'is_active' => 'boolean',
            'published_at' => 'nullable|date',
        ]);
        if (empty($data['published_at'])) {
            $data['published_at'] = now();
        }
        if (empty($data['slug'])) {
            $data['slug'] = \Str::slug($data['title']);
            $original = $data['slug'];
            $i = 1;
            while (Blog::where('slug', $data['slug'])->where('id', '!=', $blog->id)->exists()) {
                $data['slug'] = $original.'-'.$i++;
            }
        }
        if ($request->hasFile('feature_image_upload')) {
            $image = $request->file('feature_image_upload');
            $extension = $image->getClientOriginalExtension();
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $sanitizedName = \Illuminate\Support\Str::slug($originalName);
            $imageName = time() . '_' . $sanitizedName . '.' . $extension;
            $image->move(public_path('images/blogs'), $imageName);
            $data['feature_image'] = '/images/blogs/' . $imageName;
        }
        $blog->update($data);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }
}
