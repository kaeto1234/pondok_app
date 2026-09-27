<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    @if (isset($yayasan) && $yayasan?->logo)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $yayasan->logo) }}">
    @else
        <link rel="icon" type="image/png" href="{{ asset('assets/logo_ponpes.png') }}">
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
        <div class="float mb-6 sm:mb-8">
            <div class="relative inline-block">
                <span
                    class="text-[100px] sm:text-[130px] md:text-[150px] font-black text-gray-200 leading-none select-none">
                    404
                </span>
                <div class="absolute inset-0 flex items-center justify-center">
                    <i class="fas fa-mosque text-5xl sm:text-6xl text-[#166534] opacity-80"></i>
                </div>
            </div>
        </div>

        {{-- Judul --}}
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-3">
            Halaman Tidak Ditemukan
        </h1>
        <p class="text-gray-500 mb-4 sm:mb-6 max-w-md mx-auto text-sm sm:text-base">
            Maaf, halaman yang Anda cari tidak ada atau sudah dipindahkan.
        </p>

        {{-- QUOTES RANDOM --}}
        @php
            $quotes = [
                [
                    'arab' => 'إِنَّ اللَّهَ مَعَ الصَّابِرِينَ',
                    'latin' => 'Sesungguhnya Allah bersama orang-orang yang sabar',
                    'sumber' => 'QS. Al-Baqarah: 153',
                ],
                [
                    'arab' => 'وَمَن يَتَوَكَّلْ عَلَى اللَّهِ فَهُوَ حَسْبُهُ',
                    'latin' => 'Barangsiapa bertawakal kepada Allah, niscaya Allah akan mencukupkan kebutuhannya',
                    'sumber' => 'QS. At-Talaq: 3',
                ],
                [
                    'arab' => 'إِنَّ مَعَ الْعُسْرِ يُسْرًا',
                    'latin' => 'Sesungguhnya bersama kesulitan ada kemudahan',
                    'sumber' => 'QS. Al-Insyirah: 6',
                ],
                [
                    'arab' => 'وَاللَّهُ يُحِبُّ الصَّابِرِينَ',
                    'latin' => 'Dan Allah mencintai orang-orang yang sabar',
                    'sumber' => 'QS. Ali Imran: 146',
                ],
                [
                    'arab' => 'خَيْرُ النَّاسِ أَنْفَعُهُمْ لِلنَّاسِ',
                    'latin' => 'Sebaik-baik manusia adalah yang paling bermanfaat bagi orang lain',
                    'sumber' => 'HR. Ahmad',
                ],
                [
                    'arab' => 'الْعِلْمُ نُورٌ',
                    'latin' => 'Ilmu adalah cahaya',
                    'sumber' => 'Mahfudzot',
                ],
                [
                    'arab' => 'مَنْ جَدَّ وَجَدَ',
                    'latin' => 'Barangsiapa bersungguh-sungguh, dia akan berhasil',
                    'sumber' => 'Mahfudzot',
                ],
                [
                    'arab' => 'الصَّبْرُ مِفْتَاحُ الْفَرَجِ',
                    'latin' => 'Kesabaran adalah kunci kelapangan',
                    'sumber' => 'Mahfudzot',
                ],
            ];

            $randomQuote = $quotes[array_rand($quotes)];
        @endphp

        <div
            class="fade-in-quote bg-white rounded-xl shadow-sm p-5 sm:p-6 mb-6 sm:mb-8 mx-auto max-w-lg border-l-4 border-[#166534]">
            <p class="text-xl sm:text-2xl text-[#166534] leading-relaxed mb-3 font-arabic" dir="rtl">
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
            <button onclick="history.back()"
                class="bg-gray-200 text-gray-700 px-6 py-2.5 rounded-lg hover:bg-gray-300 transition font-semibold text-sm sm:text-base">
                <i class="fas fa-arrow-left mr-2"></i> Halaman Sebelumnya
            </button>
        </div>

        {{-- Footer --}}
        <p class="text-gray-400 text-xs mt-8">
            © {{ date('Y') }} {{ $yayasan->nama_yayasan ?? 'Ponpes Roudlotut Tullab' }}
        </p>
    </div>
</body>

</html>
