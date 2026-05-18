<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pondok Pesantren Roudlotut Tullab</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <p class="text-4xl mb-2">🕌</p>
            <h1 class="text-2xl font-bold text-gray-800">Pondok Pesantren</h1>
            <p class="text-gray-500 text-sm">Roudlotut Tullab</p>
        </div>

        <div class="bg-white rounded-xl shadow-md p-8">
            <h2 class="text-xl font-bold text-gray-800 mb-6 text-center">Masuk ke Sistem</h2>

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email / Username</label>
                    <input type="text" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        placeholder="Masukkan email atau username">
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            placeholder="Masukkan password">
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye" id="eye-icon"></i>
                        </button>
                    </div>
                </div>
                <button type="submit"
                    class="w-full bg-green-700 text-white py-2 rounded-lg font-semibold hover:bg-green-800 transition">
                    Masuk
                </button>
            </form>
        </div>

        <p class="text-center text-sm text-gray-400 mt-6">
            <a href="{{ url('/') }}" class="hover:text-gray-600">← Kembali ke Beranda</a>
        </p>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>