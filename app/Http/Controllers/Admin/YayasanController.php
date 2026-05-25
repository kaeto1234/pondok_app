<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\YayasanInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class YayasanController extends Controller
{
    public function index()
    {
        $yayasan = YayasanInfo::first();
        return view('admin.yayasan.index', compact('yayasan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_yayasan' => 'nullable|string|max:200',
            'alamat'       => 'nullable|string',
            'telepon'      => 'nullable|string|max:20',
            'email'        => 'nullable|email|max:100',
            'whatsapp'     => 'nullable|string|max:20',
            'facebook'     => 'nullable|string|max:200',
            'instagram'    => 'nullable|string|max:200',
            'twitter'      => 'nullable|string|max:200',
            'youtube'      => 'nullable|string|max:200',
            'google_maps'  => 'nullable|string',
            'logo'         => 'nullable|image|max:2048|mimes:jpg,jpeg,png,svg,webp',
            'favicon'      => 'nullable|image|max:512|mimes:jpg,jpeg,png,ico',
        ]);

        $yayasan = YayasanInfo::firstOrCreate([]);

        $data = $request->except(['logo', 'favicon', '_token', '_method']);

        // Handle upload logo
        if ($request->hasFile('logo')) {
            if ($yayasan->logo) {
                Storage::disk('public')->delete($yayasan->logo);
            }
            $data['logo'] = $request->file('logo')->store('yayasan', 'public');
        }

        // Handle upload favicon
        if ($request->hasFile('favicon')) {
            if ($yayasan->favicon) {
                Storage::disk('public')->delete($yayasan->favicon);
            }
            $data['favicon'] = $request->file('favicon')->store('yayasan', 'public');
        }

        // Handle hapus logo
        if ($request->hapus_logo) {
            if ($yayasan->logo) {
                Storage::disk('public')->delete($yayasan->logo);
            }
            $data['logo'] = null;
        }

        // Handle hapus favicon
        if ($request->hapus_favicon) {
            if ($yayasan->favicon) {
                Storage::disk('public')->delete($yayasan->favicon);
            }
            $data['favicon'] = null;
        }

        $yayasan->update($data);

        return redirect()->route('admin.yayasan.index')
            ->with('success', 'Informasi yayasan berhasil diperbarui.');
    }
}