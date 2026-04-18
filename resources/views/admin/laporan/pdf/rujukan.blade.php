<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Rujukan</title>
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
            color: #1e293b;
            margin-left: 20px;
            margin-right: 20px;
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

        .status {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: 600;
        }

        .status-menunggu {
            background: #fef3c7;
            color: #d97706;
        }

        .status-diproses {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-selesai {
            background: #dcfce7;
            color: #166534;
        }

        .status-dibatalkan {
            background: #fee2e2;
            color: #dc2626;
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
        <h1>LAPORAN RUJUKAN</h1>
        <p>Sistem Informasi Manajemen Bencana</p>
    </div>

    <div class="info-box">
        <p><strong>Periode:</strong> {{ $tanggalRange }}</p>
        <p><strong>Tanggal Cetak:</strong> {{ $tanggalCetak }}</p>
    </div>

    <div class="summary">
        <p><strong>Total Record:</strong> {{ $rujukan->count() }} rujukan</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 18%">Nama Korban</th>
                <th style="width: 20%">Rumah Sakit</th>
                <th style="width: 12%">Status</th>
                <th style="width: 15%">Waktu Rujuk</th>
                <th style="width: 30%">Catatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rujukan as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong>{{ $item->korban->nama ?? '-' }}</strong></td>
                <td>{{ $item->rumahSakit->nama ?? '-' }}</td>
                <td>
                    @php
                    $statusClass = match(strtolower($item->status)) {
                    'menunggu' => 'status-menunggu',
                    'diproses' => 'status-diproses',
                    'selesai' => 'status-selesai',
                    'dibatalkan' => 'status-dibatalkan',
                    default => ''
                    };
                    @endphp
                    <span class="status {{ $statusClass }}">{{ $item->status }}</span>
                </td>
                <td>{{ $item->waktu_rujuk ? $item->waktu_rujuk->format('d/m/Y H:i') : '-' }}</td>
                <td>{{ $item->catatan ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; color: #64748b;">Tidak ada data rujukan</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ $tanggalCetak }}</p>
    </div>
</body>

</html>