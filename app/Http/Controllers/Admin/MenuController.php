<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuLink;
use App\Models\MenuPost;
use App\Models\Post;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with(['children', 'post', 'link'])
            ->whereNull('parent_id')
            ->orderBy('order')
            ->get();

        $menusList = Menu::all(); // untuk dropdown parent
        $posts = Post::orderBy('title')->get(); // untuk dropdown post

        return view('admin.menus.index', compact('menus', 'menusList', 'posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:100',
            'type' => 'required|in:post,link',
            'post_id' => 'required_if:type,post|nullable|exists:posts,id',
            'url' => 'required_if:type,link|nullable|string|max:255',
        ]);

        $menu = Menu::create([
            'label' => $request->label,
            'parent_id' => $request->parent_id ?? null,
            'order' => $request->order ?? 0,
            'is_active' => $request->is_active ?? true,
        ]);

        if ($request->type == 'post') {
            MenuPost::create([
                'menu_id' => $menu->id,
                'post_id' => $request->post_id,
            ]);
        } else {
            MenuLink::create([
                'menu_id' => $menu->id,
                'url' => $request->url,
            ]);
        }

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan');
    }

    public function edit($id)
    {
        $menu = Menu::with(['post', 'link'])->findOrFail($id);
        $menus = Menu::all();
        $posts = Post::orderBy('title')->get();

        return view('admin.menus.edit', compact('menu', 'menus', 'posts'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'label' => 'required|string|max:100',
            'type' => 'required|in:post,link',
            'post_id' => 'required_if:type,post|nullable|exists:posts,id',
            'url' => 'required_if:type,link|nullable|string|max:255',
        ]);

        $menu->update([
            'label' => $request->label,
            'parent_id' => $request->parent_id ?? null,
            'order' => $request->order ?? 0,
            'is_active' => $request->is_active ?? true,
        ]);

        if ($request->type == 'post') {
            MenuPost::updateOrCreate(
                ['menu_id' => $menu->id],
                ['post_id' => $request->post_id]
            );
            MenuLink::where('menu_id', $menu->id)->delete();
        } else {
            MenuLink::updateOrCreate(
                ['menu_id' => $menu->id],
                ['url' => $request->url]
            );
            MenuPost::where('menu_id', $menu->id)->delete();
        }

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diupdate');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        MenuPost::where('menu_id', $id)->delete();
        MenuLink::where('menu_id', $id)->delete();
        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus');
    }
}
