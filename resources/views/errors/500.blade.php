<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Terjadi Kesalahan</title>
    @if (isset($yayasan) && $yayasan?->favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $yayasan->favicon) }}">
    @else
        <link rel="icon" type="image/png" href="{{ asset('asset/logo_ponpes.png') }}">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @keyframes pulse-slow {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .pulse-slow {
            animation: pulse-slow 2s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="text-center px-6">

        {{-- Ilustrasi --}}
        <div class="mb-8">
            <div class="relative inline-block">
                <span class="text-[150px] font-black text-gray-200 leading-none select-none">500</span>
                <div class="absolute inset-0 flex items-center justify-center">
                    <i class="fas fa-tools text-6xl text-orange-500 pulse-slow"></i>
                </div>
            </div>
        </div>

        <h1 class="text-3xl font-bold text-gray-800 mb-3">Terjadi Kesalahan Server</h1>
        <p class="text-gray-500 mb-2 max-w-md mx-auto">
            Maaf, server sedang mengalami gangguan. Tim kami sedang bekerja untuk memperbaikinya.
        </p>
        <p class="text-gray-400 text-sm mb-8 italic">
            "إِنَّ مَعَ الْعُسْرِ يُسْرًا" — Sesungguhnya bersama kesulitan ada kemudahan.
        </p>

        <div class="flex gap-3 justify-center flex-wrap">
            <a href="{{ url('/') }}"
                class="bg-[#166534] text-white px-6 py-2.5 rounded-lg hover:bg-[#14532d] transition font-semibold">
                <i class="fas fa-home mr-2"></i> Kembali ke Beranda
            </a>
            <button onclick="location.reload()"
                class="bg-orange-500 text-white px-6 py-2.5 rounded-lg hover:bg-orange-600 transition font-semibold">
                <i class="fas fa-redo mr-2"></i> Coba Lagi
            </button>
        </div>

        <p class="text-gray-400 text-xs mt-8">
            © {{ date('Y') }} Pondok Pesantren Roudlotut Tullab
        </p>
    </div>
</body>

</html>
