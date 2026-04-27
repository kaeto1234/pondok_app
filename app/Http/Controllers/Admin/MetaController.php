<?php

// app/Http/Controllers/Admin/MetaController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meta;
use Illuminate\Http\Request;

class MetaController extends Controller
{
    public function index($group)
    {
        $metas = Meta::where('meta_group', $group)->orderBy('order')->get();

        $title = $group == 'profil' ? 'Profil Pondok' : 'Kontak';

        return view('admin.meta.index', compact('metas', 'title', 'group'));
    }

    public function create($group)
    {
        $title = $group == 'profil' ? 'Profil Pondok' : 'Kontak';

        return view('admin.meta.create', compact('group', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'meta_key' => 'required|string',
            'meta_value' => 'nullable',
            'meta_group' => 'required|string',
            'order' => 'integer',
        ]);

        Meta::create([
            'meta_key' => $request->meta_key,
            'meta_value' => $request->meta_value,
            'meta_group' => $request->meta_group,
            'order' => $request->order ?? 0,
            'is_active' => true,
        ]);

        return redirect(url('/admin/meta/'.$request->meta_group))
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $meta = Meta::findOrFail($id);
        $group = $meta->meta_group;

        return view('admin.meta.edit', compact('meta', 'group'));
    }

    public function update(Request $request, $id)
    {
        $meta = Meta::findOrFail($id);
        $meta->update(['meta_value' => $request->meta_value]);

        return redirect()->route('admin.meta.index', $meta->meta_group)
            ->with('success', 'Data berhasil diperbarui');
    }
}
