<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->orderBy('created_at', 'desc')->get();

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = PostCategory::all();

        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:200',
            'content' => 'nullable',
            'post_category_id' => 'required|exists:post_categories,id',
            'post_type' => 'required|in:post,page',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        // Generate slug unik
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug.'-'.$count;
            $count++;
        }

        // Upload gambar
        $featuredImage = null;
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $featuredImage = $file->store('posts', 'public');
        }

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'post_type' => $request->post_type,
            'post_category_id' => $request->post_category_id,
            'author_id' => Auth::id() ?? 1, // ← default 1 jika tidak login
            'published_at' => $request->published_at ?? now(),
            'slug' => $slug,
            'featured_image' => $featuredImage,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil ditambahkan');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = PostCategory::all();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $featuredImage = $post->featured_image;
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $featuredImage = $file->store('posts', 'public');
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'post_type' => $request->post_type,
            'post_category_id' => $request->post_category_id,
            'author_id' => Auth::id() ?? 1, // ← default 1 jika tidak login
            'published_at' => $request->published_at ?? now(),
            'featured_image' => $featuredImage,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil diupdate');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dihapus');
    }
}
