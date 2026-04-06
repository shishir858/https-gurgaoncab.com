<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function archive(Request $request)
    {
        $query = Blog::where('is_active', true);
        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where('title', 'like', "%$q%")
                  ->orWhere('content', 'like', "%$q%")
                  ->orWhere('meta_keywords', 'like', "%$q%")
                  ->orWhere('meta_description', 'like', "%$q%") ;
        }
        $blogs = $query->orderByDesc('published_at')->paginate(12);
        $recentBlogs = Blog::where('is_active', true)->orderByDesc('published_at')->limit(5)->get();
        $meta_title = 'Blog Archive';
        $meta_description = 'Read our latest travel blogs, tips, and updates.';
        $meta_keywords = 'travel blog, gurgaoncab, tips, news';
        return view('blog.archive', compact('blogs', 'recentBlogs', 'meta_title', 'meta_description', 'meta_keywords'));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $recentBlogs = Blog::where('is_active', true)->where('id', '!=', $blog->id)->orderByDesc('published_at')->limit(5)->get();
        $meta_title = $blog->meta_title ?? $blog->title;
        $meta_description = $blog->meta_description;
        $meta_keywords = $blog->meta_keywords;
        $canonical = $blog->meta_canonical;
        return view('blog.show', compact('blog', 'recentBlogs', 'meta_title', 'meta_description', 'meta_keywords', 'canonical'));
    }
}
