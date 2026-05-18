<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\YayasanInfo;
use Illuminate\Http\Request;

class YayasanController extends Controller
{
    public function index()
    {
        $yayasan = YayasanInfo::first();
        return view('admin.yayasan.index', compact('yayasan'));
    }

    public function update(Request $request)
    {
        $yayasan = YayasanInfo::first();
        
        $request->validate([
            'nama_yayasan' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'whatsapp' => 'nullable|string|max:20',
            'facebook' => 'nullable|url|max:100',
            'instagram' => 'nullable|url|max:100',
            'twitter' => 'nullable|url|max:100',
            'youtube' => 'nullable|url|max:100',
            'google_maps' => 'nullable|string',
        ]);

        if (!$yayasan) {
            YayasanInfo::create($request->all());
        } else {
            $yayasan->update($request->all());
        }

        return redirect()->back()->with('success', 'Data yayasan berhasil diperbarui');
    }
}