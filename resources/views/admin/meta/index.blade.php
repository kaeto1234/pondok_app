@extends('layouts.admin')

@section('title', 'Kelola Profil Pondok')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola {{ $title }}</h1>
            <p class="text-gray-500">Mengelola data {{ $title }} pondok pesantren</p>
        </div>
        <a href="{{ url('/admin/meta/create/' . $group) }}"
            class="bg-[#1e3a5f] text-white px-4 py-2 rounded-lg hover:bg-[#2a4a7a] transition">
            <i class="fas fa-plus mr-2"></i> Tambah Data
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr class="border-b">
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Key</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Value</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($metas as $meta)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-3 text-sm text-gray-700 font-medium">
                            {{ ucfirst(str_replace('_', ' ', $meta->meta_key)) }}</td>
                        <td class="px-6 py-3 text-sm text-gray-500">{{ Str::limit($meta->meta_value, 80) }}</td>
                        <td class="px-6 py-3">
                            <a href="{{ url('/admin/meta/edit/' . $meta->id) }}"
                                class="text-[#1e3a5f] hover:underline text-sm">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
