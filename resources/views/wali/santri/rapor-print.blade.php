<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Rapor - {{ $santri->nama_lengkap }}</title>
    <style>
        @media print {
            .no-print {
                display: none;
            }

            body {
                margin: 0;
                padding: 0;
            }
        }

        body {
            font-family: 'Arial', 'Times New Roman', sans-serif;
            font-size: 12px;
            padding: 15px;
            direction: rtl;
        }

        .btn-print {
            background-color: #2563eb;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
            direction: ltr;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 22px;
            font-weight: bold;
        }

        .header h3 {
            margin: 5px 0;
            font-size: 14px;
        }

        table.info-santri {
            width: 100%;
            margin-bottom: 20px;
            border: 1px solid #000;
            border-collapse: collapse;
        }

        table.info-santri td {
            border: 1px solid #000;
            padding: 8px;
        }

        table.nilai {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table.nilai th,
        table.nilai td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        table.nilai th {
            background-color: #f0f0f0;
        }

        table.keterangan {
            width: 100%;
            margin-bottom: 20px;
            border: 1px solid #000;
            border-collapse: collapse;
        }

        table.keterangan td {
            border: 1px solid #000;
            padding: 8px;
        }

        table.ttd {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }

        table.ttd td {
            text-align: center;
            padding-top: 40px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
        }

        .text-right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <button class="btn-print no-print" onclick="window.print()">
        🖨️ Cetak / Simpan PDF
    </button>

    <!-- Header -->
    <div class="header">
        <h1>كشف الدرجات</h1>
        <h3>(الامتحان لنصف الدراسي الأول)</h3>
    </div>

    <!-- Info Santri (dari database) -->
    <table class="info-santri">
        <tr>
            <td style="width: 150px;">: الفصل</td>
            <td>{{ $santriTingkat->tingkat->nama_tingkat ?? '-' }}</td>
            <td style="width: 150px;">: الاسم طالب</td>
            <td>{{ $santri->nama_lengkap ?? '-' }}</td>
        </tr>
    </table>

    <!-- Tabel Nilai -->
    <table class="nilai">
        <thead>
            <tr>
                <th rowspan="2">المواد</th>
                <th colspan="2">الدرجة</th>
                <th rowspan="2">اجمالي<br>الامتحان</th>
                <th rowspan="2">نتيجة</th>
                <th rowspan="2">المعدلة للفصل</th>
            </tr>
            <tr>
                <th>التحريري</th>
                <th>الشفهي</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalNilai = 0;
                $jumlahMapel = 0;
            @endphp

            @foreach ($nilaiData as $mapelId => $nilaiPerMapel)
                @php
                    $mapel = $nilaiPerMapel->first()->kurikulum->mataPelajaran;
                    $nilaiTulis = 0;
                    $nilaiLisan = 0;

                    foreach ($jenisUjianList as $ju) {
                        $n = $nilaiPerMapel->where('jenis_ujian_id', $ju->id)->first();
                        if ($n) {
                            if (strpos($ju->nama, 'Tulis') !== false || strpos($ju->nama, 'Harian') !== false) {
                                $nilaiTulis = $n->nilai;
                            } elseif (strpos($ju->nama, 'Lisan') !== false || strpos($ju->nama, 'Praktik') !== false) {
                                $nilaiLisan = $n->nilai;
                            }
                        }
                    }

                    $rataMapel = ($nilaiTulis + $nilaiLisan) / 2;
                    $totalNilai += $rataMapel;
                    $jumlahMapel++;
                @endphp
                <tr>
                    <td>{{ $mapel->nama_mapel }}</td>
                    <td>{{ $nilaiTulis ?: '-' }}</td>
                    <td>{{ $nilaiLisan ?: '-' }}</td>
                    <td>{{ $rataMapel ?: '-' }}</td>
                    <td>{{ $rataMapel >= 70 ? 'ناجح' : ($rataMapel ? 'راسب' : '-') }}</td>
                    <td>{{ $rataMapel ?: '-' }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="background-color: #f0f0f0;">
                <td colspan="5" class="bold">مجموع الدرجات</td>
                <td>{{ $totalNilai }}</td>
            </tr>
            <tr>
                <td colspan="5" class="bold">الترتيب العلمي</td>
                <td>.... من ......... طلاب</td>
            </tr>
        </tfoot>
    </table>

    <!-- Keterangan -->
    <table class="keterangan">
        <tr>
            <td style="width: 50%">
                <strong>الانشطة الاضافية:</strong><br>
                مقبول [ ] &nbsp;&nbsp; جيد [ ] &nbsp;&nbsp; جيد جدا [ ]
            </td>
            <td style="width: 50%">
                <strong>المواظبة:</strong><br>
                مقبول [ ] &nbsp;&nbsp; جيد [ ] &nbsp;&nbsp; جيد جدا [ ]
            </td>
        </tr>
        <tr>
            <td>
                <strong>السلوك :</strong><br>
                مقبول [ ] &nbsp;&nbsp; جيد [ ] &nbsp;&nbsp; جيد جدا [ ]
            </td>
            <td>
                <strong>النظافة:</strong><br>
                مقبول [ ] &nbsp;&nbsp; جيد [ ] &nbsp;&nbsp; جيد جدا [ ]
            </td>
        </tr>
    </table>

    <!-- Kehadiran -->
    <table class="keterangan">
        <tr>
            <td style="width: 25%"><strong>ايام الغياب</strong></td>
            <td style="width: 25%"><strong>استئذان</strong></td>
            <td style="width: 25%"><strong>مرض</strong></td>
            <td style="width: 25%"><strong>غيب</strong></td>
        </tr>
        <tr>
            <td>________</td>
            <td>________</td>
            <td>________</td>
            <td>________</td>
        </tr>
    </table>

    <!-- Tanggal -->
    <div class="text-right" style="margin: 15px 0;">
        تحريرا في : {{ \Carbon\Carbon::now()->format('d/m/Y') }}
    </div>

    <!-- Tanda Tangan -->
    <table class="ttd">
        <tr>
            <td style="width: 33%">
                مدير المدرسة<br><br><br><br>
                (.....................)
            </td>
            <td style="width: 33%">
                ولي الفصل<br><br><br><br>
                (.....................)
            </td>
            <td style="width: 33%">
                ولي الطالب<br><br><br><br>
                (.....................)
            </td>
        </tr>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
    </div>

    <script>
        setTimeout(() => {
            window.print();
        }, 500);
    </script>
</body>

</html>
