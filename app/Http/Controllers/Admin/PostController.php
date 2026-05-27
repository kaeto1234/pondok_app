<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // Daftar post (tipe: post)
    public function index(Request $request)
    {
        $posts = Post::with('category')
            ->where('post_type', 'post')
            ->when($request->search, fn ($q) => $q
                ->where('title', 'like', '%'.$request->search.'%')
            )
            ->when($request->category_id, fn ($q) => $q
                ->where('post_category_id', $request->category_id)
            )
            ->when($request->status, fn ($q) => $request->status == 'published'
                ? $q->whereNotNull('published_at')
                : $q->whereNull('published_at')
            )
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        $categories = PostCategory::all();

        return view('admin.posts.index', compact('posts', 'categories'));
    }

    // Daftar page (tipe: page)
    public function pages(Request $request)
    {
        $posts = Post::with('category')
            ->where('post_type', 'page')
            ->when($request->search, fn ($q) => $q
                ->where('title', 'like', '%'.$request->search.'%')
            )
            ->when($request->status, fn ($q) => $request->status == 'published'
                ? $q->whereNotNull('published_at')
                : $q->whereNull('published_at')
            )
            ->orderBy('menu_order')
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('admin.posts.pages', compact('posts'));
    }

    public function create()
    {
        $categories = PostCategory::all();
        $type = request('type', 'post'); // default post

        return view('admin.posts.create', compact('categories', 'type'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:200',
            'content' => 'nullable',
            'post_category_id' => 'nullable|exists:post_categories,id',
            'post_type' => 'required|in:post,page',
            'featured_image' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug.'-'.$count++;
        }

        $featuredImage = null;
        if ($request->hasFile('featured_image')) {
            $featuredImage = $request->file('featured_image')->store('posts', 'public');
        }

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'post_type' => $request->post_type,
            'post_category_id' => $request->post_category_id,
            'author_id' => session('user_id'),
            'published_at' => $request->published_at,
            'slug' => $slug,
            'menu_order' => $request->menu_order ?? 0,
            'featured_image' => $featuredImage,
        ]);

        // Redirect ke halaman yang sesuai
        $route = $request->post_type == 'page' ? 'admin.posts.pages' : 'admin.posts.index';

        return redirect()->route($route)->with('success', ucfirst($request->post_type).' berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = PostCategory::all();
        $type = $post->post_type;

        return view('admin.posts.edit', compact('post', 'categories', 'type'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:200',
            'content' => 'nullable',
            'post_category_id' => 'nullable|exists:post_categories,id',
            'post_type' => 'required|in:post,page',
            'featured_image' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $featuredImage = $post->featured_image;

        // Hapus gambar jika dicentang
        if ($request->hapus_gambar) {
            if ($featuredImage) {
                \Storage::disk('public')->delete($featuredImage);
            }
            $featuredImage = null;
        }

        // Ganti gambar jika ada upload baru
        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                \Storage::disk('public')->delete($post->featured_image);
            }
            $featuredImage = $request->file('featured_image')->store('posts', 'public');
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'post_type' => $request->post_type,
            'post_category_id' => $request->post_category_id,
            'author_id' => session('user_id'),
            'published_at' => $request->published_at,
            'menu_order' => $request->menu_order ?? 0,
            'featured_image' => $featuredImage,
        ]);

        $route = $post->post_type == 'page' ? 'admin.posts.pages' : 'admin.posts.index';

        return redirect()->route($route)->with('success', 'Berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $type = $post->post_type;
        $post->delete();

        $route = $type == 'page' ? 'admin.posts.pages' : 'admin.posts.index';

        return redirect()->route($route)->with('success', 'Berhasil dihapus.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate(['file' => 'required|image|max:2048']);
        $path = $request->file('file')->store('posts/content', 'public');

        return asset('storage/'.$path);
    }
}
