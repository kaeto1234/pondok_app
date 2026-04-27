@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
    <p class="text-gray-500">Selamat datang di panel admin Pondok Pesantren Roudlotut Tullab</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Profil Pondok</p>
                <p class="text-2xl font-bold text-[#1e3a5f]">5</p>
            </div>
            <div class="w-12 h-12 bg-[#1e3a5f]/10 rounded-full flex items-center justify-center">
                <i class="fas fa-building text-[#1e3a5f] text-xl"></i>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Kontak</p>
                <p class="text-2xl font-bold text-[#1e3a5f]">7</p>
            </div>
            <div class="w-12 h-12 bg-[#1e3a5f]/10 rounded-full flex items-center justify-center">
                <i class="fas fa-address-card text-[#1e3a5f] text-xl"></i>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Akademik</p>
                <p class="text-2xl font-bold text-[#1e3a5f]">2</p>
            </div>
            <div class="w-12 h-12 bg-[#1e3a5f]/10 rounded-full flex items-center justify-center">
                <i class="fas fa-graduation-cap text-[#1e3a5f] text-xl"></i>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Fasilitas</p>
                <p class="text-2xl font-bold text-[#1e3a5f]">9</p>
            </div>
            <div class="w-12 h-12 bg-[#1e3a5f]/10 rounded-full flex items-center justify-center">
                <i class="fas fa-building text-[#1e3a5f] text-xl"></i>
            </div>
        </div>
    </div>
</div>
@endsection