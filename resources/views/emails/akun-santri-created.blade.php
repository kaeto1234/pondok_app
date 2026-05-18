<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Akun Santri Telah Dibuat</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
        <div style="text-align: center; margin-bottom: 20px;">
            <p style="font-size: 40px;">🕌</p>
            <h2 style="color: #166534;">Pondok Pesantren Roudlotut Tullab</h2>
        </div>

        <p>Assalamu'alaikum Warahmatullahi Wabarakatuh,</p>

        <p>Selamat! Pendaftaran santri atas nama <strong>{{ $santri->nama_lengkap }}</strong> telah <strong
                style="color: green;">DIVERIFIKASI</strong>.</p>

        <p>Berikut adalah informasi akun untuk mengakses sistem monitoring santri:</p>

        <div style="background-color: #f3f4f6; padding: 15px; border-radius: 8px; margin: 20px 0;">
            <p><strong>Username (Email):</strong> {{ $user->email }}</p>
            <p><strong>Password:</strong> {{ $passwordPlain }}</p>
        </div>

        <p>Anda dapat login melalui website pondok di menu <strong>Login</strong> menggunakan email dan password di
            atas.</p>

        <p>Setelah login, Anda dapat:</p>
        <ul>
            <li>Melihat nilai dan absensi santri</li>
            <li>Mendownload materi pembelajaran</li>
            <li>Memantau perkembangan putra/putri Anda</li>
        </ul>

        <p style="margin-top: 20px;">Wassalamu'alaikum Warahmatullahi Wabarakatuh.</p>

        <hr style="margin: 20px 0;">
        <p style="font-size: 12px; color: #999; text-align: center;">
            © {{ date('Y') }} Pondok Pesantren Roudlotut Tullab. All rights reserved.
        </p>
    </div>
</body>

</html>
