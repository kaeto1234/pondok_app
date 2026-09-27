<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Terjadi Kesalahan</title>
    @if (isset($yayasan) && $yayasan?->logo)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $yayasan->logo) }}">
    @else
        <link rel="icon" type="image/png" href="{{ asset('assets/logo_ponpes.png') }}">
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

        .fade-in-quote {
            animation: fadeInQuote 0.8s ease-in;
        }

        @keyframes fadeInQuote {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">

    <div class="text-center px-4 sm:px-6 max-w-2xl w-full">

        {{-- Ilustrasi --}}
        <div class="mb-6 sm:mb-8">
            <div class="relative inline-block">
                <span
                    class="text-[100px] sm:text-[130px] md:text-[150px] font-black text-gray-200 leading-none select-none">
                    500
                </span>
                <div class="absolute inset-0 flex items-center justify-center">
                    <i class="fas fa-tools text-5xl sm:text-6xl text-orange-500 pulse-slow"></i>
                </div>
            </div>
        </div>

        {{-- Judul --}}
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-3">
            Terjadi Kesalahan Server
        </h1>
        <p class="text-gray-500 mb-4 sm:mb-6 max-w-md mx-auto text-sm sm:text-base">
            Maaf, server sedang mengalami gangguan. Tim kami sedang bekerja untuk memperbaikinya.
        </p>

        {{-- QUOTES RANDOM --}}
        @php
            $quotes = [
                [
                    'arab' => 'إِنَّ مَعَ الْعُسْرِ يُسْرًا',
                    'latin' => 'Sesungguhnya bersama kesulitan ada kemudahan',
                    'sumber' => 'QS. Al-Insyirah: 6',
                ],
                [
                    'arab' => 'وَمَن يَتَوَكَّلْ عَلَى اللَّهِ فَهُوَ حَسْبُهُ',
                    'latin' => 'Barangsiapa bertawakal kepada Allah, niscaya Allah akan mencukupkan kebutuhannya',
                    'sumber' => 'QS. At-Talaq: 3',
                ],
                [
                    'arab' => 'إِنَّ اللَّهَ مَعَ الصَّابِرِينَ',
                    'latin' => 'Sesungguhnya Allah bersama orang-orang yang sabar',
                    'sumber' => 'QS. Al-Baqarah: 153',
                ],
                [
                    'arab' => 'وَاللَّهُ يُحِبُّ الصَّابِرِينَ',
                    'latin' => 'Dan Allah mencintai orang-orang yang sabar',
                    'sumber' => 'QS. Ali Imran: 146',
                ],
                [
                    'arab' => 'لَا يُكَلِّفُ اللَّهُ نَفْسًا إِلَّا وُسْعَهَا',
                    'latin' => 'Allah tidak membebani seseorang melainkan sesuai kesanggupannya',
                    'sumber' => 'QS. Al-Baqarah: 286',
                ],
                [
                    'arab' => 'الصَّبْرُ مِفْتَاحُ الْفَرَجِ',
                    'latin' => 'Kesabaran adalah kunci kelapangan',
                    'sumber' => 'Mahfudzot',
                ],
                [
                    'arab' => 'مَنْ جَدَّ وَجَدَ',
                    'latin' => 'Barangsiapa bersungguh-sungguh, dia akan berhasil',
                    'sumber' => 'Mahfudzot',
                ],
                [
                    'arab' => 'خَيْرُ النَّاسِ أَنْفَعُهُمْ لِلنَّاسِ',
                    'latin' => 'Sebaik-baik manusia adalah yang paling bermanfaat bagi orang lain',
                    'sumber' => 'HR. Ahmad',
                ],
            ];

            $randomQuote = $quotes[array_rand($quotes)];
        @endphp

        <div
            class="fade-in-quote bg-white rounded-xl shadow-sm p-5 sm:p-6 mb-6 sm:mb-8 mx-auto max-w-lg border-l-4 border-orange-500">
            <p class="text-xl sm:text-2xl text-orange-500 leading-relaxed mb-3 font-arabic" dir="rtl">
                {{ $randomQuote['arab'] }}
            </p>
            <p class="text-gray-600 italic text-sm sm:text-base mb-1">
                "{{ $randomQuote['latin'] }}"
            </p>
            <p class="text-gray-400 text-xs">
                — {{ $randomQuote['sumber'] }}
            </p>
        </div>

        {{-- Tombol --}}
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ url('/') }}"
                class="bg-[#166534] text-white px-6 py-2.5 rounded-lg hover:bg-[#14532d] transition font-semibold text-sm sm:text-base">
                <i class="fas fa-home mr-2"></i> Kembali ke Beranda
            </a>
            <button onclick="location.reload()"
                class="bg-orange-500 text-white px-6 py-2.5 rounded-lg hover:bg-orange-600 transition font-semibold text-sm sm:text-base">
                <i class="fas fa-redo mr-2"></i> Coba Lagi
            </button>
        </div>

        {{-- Footer --}}
        <p class="text-gray-400 text-xs mt-8">
            © {{ date('Y') }} {{ $yayasan->nama_yayasan ?? 'Ponpes Roudlotut Tullab' }}
        </p>
    </div>
</body>

</html>
