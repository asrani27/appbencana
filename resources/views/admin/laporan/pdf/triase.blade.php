<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Triase</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10px;
            line-height: 1.4;
            margin-left: 20px;
            margin-right: 20px;
            color: #1e293b;
        }

        .header {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #3b82f6;
        }

        .header h1 {
            font-size: 18px;
            color: #1e40af;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 11px;
            color: #64748b;
        }

        .info-box {
            margin-bottom: 15px;
            padding: 10px;
            background: #f1f5f9;
            border-radius: 5px;
        }

        .info-box p {
            font-size: 10px;
            color: #475569;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background: #1e40af;
            color: white;
            padding: 8px 6px;
            text-align: left;
            font-size: 9px;
            font-weight: 600;
            text-transform: uppercase;
        }

        td {
            padding: 7px 6px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 9px;
            vertical-align: top;
        }

        tr:nth-child(even) {
            background: #f8fafc;
        }

        tr:hover {
            background: #f1f5f9;
        }

        .kategori {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: 700;
        }

        .kategori-merah {
            background: #fee2e2;
            color: #dc2626;
        }

        .kategori-kuning {
            background: #fef3c7;
            color: #d97706;
        }

        .kategori-hijau {
            background: #dcfce7;
            color: #16a34a;
        }

        .kategori-hitam {
            background: #f1f5f9;
            color: #475569;
        }

        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #e2e8f0;
            text-align: right;
            font-size: 9px;
            color: #64748b;
        }

        .summary {
            margin-top: 15px;
            padding: 10px;
            background: #eff6ff;
            border-radius: 5px;
            border-left: 4px solid #3b82f6;
        }

        .summary p {
            font-size: 10px;
            color: #1e40af;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>LAPORAN DATA TRIASE</h1>
        <p>Sistem Informasi Manajemen Bencana</p>
    </div>

    <div class="info-box">
        <p><strong>Periode:</strong> {{ $tanggalRange }}</p>
        <p><strong>Tanggal Cetak:</strong> {{ $tanggalCetak }}</p>
    </div>

    <div class="summary">
        <p><strong>Total Record:</strong> {{ $triase->count() }} triase</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 16%">Nama Korban</th>
                <th style="width: 14%">Bencana</th>
                <th style="width: 10%">Kategori</th>
                <th style="width: 25%">Keterangan</th>
                <th style="width: 15%">Petugas</th>
                <th style="width: 15%">Waktu</th>
            </tr>
        </thead>
        <tbody>
            @forelse($triase as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong>{{ $item->korban->nama ?? '-' }}</strong></td>
                <td>{{ $item->korban->bencana->nama_bencana ?? '-' }}</td>
                <td>
                    @php
                    $kategoriClass = match(strtolower($item->kategori)) {
                    'merah' => 'kategori-merah',
                    'kuning' => 'kategori-kuning',
                    'hijau' => 'kategori-hijau',
                    'hitam' => 'kategori-hitam',
                    default => ''
                    };
                    @endphp
                    <span class="kategori {{ $kategoriClass }}">{{ $item->kategori }}</span>
                </td>
                <td>{{ $item->keterangan ?? '-' }}</td>
                <td>{{ $item->creator->name ?? '-' }}</td>
                <td>{{ $item->created_at ? $item->created_at->format('d/m/Y H:i') : '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; color: #64748b;">Tidak ada data triase</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ $tanggalCetak }}</p>
    </div>
</body>

</html>