<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    @if (isset($yayasan) && $yayasan?->favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $yayasan->favicon) }}">
    @else
        <link rel="icon" type="image/png" href="{{ asset('asset/logo_ponpes.png') }}">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .float {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="text-center px-6">

        {{-- Ilustrasi --}}
        <div class="float mb-8">
            <div class="relative inline-block">
                <span class="text-[150px] font-black text-gray-200 leading-none select-none">404</span>
                <div class="absolute inset-0 flex items-center justify-center">
                    <i class="fas fa-mosque text-6xl text-[#166534] opacity-80"></i>
                </div>
            </div>
        </div>

        <h1 class="text-3xl font-bold text-gray-800 mb-3">Halaman Tidak Ditemukan</h1>
        <p class="text-gray-500 mb-2 max-w-md mx-auto">
            Maaf, halaman yang Anda cari tidak ada atau sudah dipindahkan.
        </p>
        <p class="text-gray-400 text-sm mb-8 italic">
            "وَعَسَىٰ أَن تَكْرَهُوا شَيْئًا وَهُوَ خَيْرٌ لَّكُمْ"
        </p>

        <div class="flex gap-3 justify-center flex-wrap">
            <a href="{{ url('/') }}"
                class="bg-[#166534] text-white px-6 py-2.5 rounded-lg hover:bg-[#14532d] transition font-semibold">
                <i class="fas fa-home mr-2"></i> Kembali ke Beranda
            </a>
            <button onclick="history.back()"
                class="bg-gray-200 text-gray-700 px-6 py-2.5 rounded-lg hover:bg-gray-300 transition font-semibold">
                <i class="fas fa-arrow-left mr-2"></i> Halaman Sebelumnya
            </button>
        </div>

        <p class="text-gray-400 text-xs mt-8">
            © {{ date('Y') }} Pondok Pesantren Roudlotut Tullab
        </p>
    </div>
</body>

</html>
