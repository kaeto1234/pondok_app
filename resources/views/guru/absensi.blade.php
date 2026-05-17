@extends('layouts.admin')

@section('title', 'Absensi Santri')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Absensi Santri</h1>
            <div class="text-sm text-gray-500">
                Hari: {{ date('d F Y') }}
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-gray-50 px-6 py-3 flex justify-between items-center">
                <div class="flex gap-4">
                    <select class="border rounded-lg px-3 py-1">
                        <option>Kelas 1 Ula</option>
                        <option>Kelas 2 Ula</option>
                        <option>Kelas 3 Ula</option>
                        <option>Kelas 4 Ula</option>
                        <option>Kelas 5 Wustha</option>
                        <option>Kelas 6 Wustha</option>
                    </select>
                    <select class="border rounded-lg px-3 py-1">
                        <option>Tauhid</option>
                        <option>Fiqih</option>
                        <option>Nahwu</option>
                        <option>Al-Qur'an</option>
                    </select>
                </div>
                <button class="bg-[#1e3a5f] text-white px-4 py-1 rounded-lg hover:bg-[#2a4a7a] transition">Simpan</button>
            </div>

            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr class="border-b">
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">NIS</th>
                        <th class="px-4 py-3 text-left">Nama Santri</th>
                        <th class="px-4 py-3 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">1</td>
                        <td class="px-4 py-3">2025001</td>
                        <td class="px-4 py-3">Ahmad Faiz</td>
                        <td class="px-4 py-3 text-center">
                            <select class="border rounded px-2 py-1 text-sm">
                                <option>Hadir</option>
                                <option>Sakit</option>
                                <option>Izin</option>
                                <option>Alfa</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">2</td>
                        <td class="px-4 py-3">2025002</td>
                        <td class="px-4 py-3">Muhammad Rizki</td>
                        <td class="px-4 py-3 text-center">
                            <select class="border rounded px-2 py-1 text-sm">
                                <option>Hadir</option>
                                <option>Sakit</option>
                                <option>Izin</option>
                                <option>Alfa</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">3</td>
                        <td class="px-4 py-3">2025003</td>
                        <td class="px-4 py-3">Fatimah Azzahra</td>
                        <td class="px-4 py-3 text-center">
                            <select class="border rounded px-2 py-1 text-sm">
                                <option>Hadir</option>
                                <option>Sakit</option>
                                <option>Izin</option>
                                <option>Alfa</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">4</td>
                        <td class="px-4 py-3">2025004</td>
                        <td class="px-4 py-3">Aisyah Putri</td>
                        <td class="px-4 py-3 text-center">
                            <select class="border rounded px-2 py-1 text-sm">
                                <option>Hadir</option>
                                <option>Sakit</option>
                                <option>Izin</option>
                                <option>Alfa</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection