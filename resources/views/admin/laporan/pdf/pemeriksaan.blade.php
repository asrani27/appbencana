<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Pemeriksaan Medis</title>
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

        .vital-signs {
            font-size: 8px;
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
        <h1>LAPORAN PEMERIKSAAN MEDIS</h1>
        <p>Sistem Informasi Manajemen Bencana</p>
    </div>

    <div class="info-box">
        <p><strong>Periode:</strong> {{ $tanggalRange }}</p>
        <p><strong>Tanggal Cetak:</strong> {{ $tanggalCetak }}</p>
    </div>

    <div class="summary">
        <p><strong>Total Record:</strong> {{ $pemeriksaan->count() }} pemeriksaan</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 4%">No</th>
                <th style="width: 14%">Nama Korban</th>
                <th style="width: 8%">TD (mmHg)</th>
                <th style="width: 7%">Nadi</th>
                <th style="width: 7%">RR</th>
                <th style="width: 7%">Suhu</th>
                <th style="width: 18%">Keluhan</th>
                <th style="width: 18%">Diagnosa</th>
                <th style="width: 17%">Petugas</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pemeriksaan as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong>{{ $item->korban->nama ?? '-' }}</strong></td>
                <td class="vital-signs">{{ $item->tekanan_darah ?? '-' }}</td>
                <td class="vital-signs">{{ $item->nadi ?? '-' }}/min</td>
                <td class="vital-signs">{{ $item->respirasi ?? '-' }}/min</td>
                <td class="vital-signs">{{ $item->suhu ?? '-' }}°C</td>
                <td>{{ Str::limit($item->keluhan ?? '-', 40) }}</td>
                <td>{{ Str::limit($item->diagnosa_awal ?? '-', 40) }}</td>
                <td>{{ $item->petugas->name ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="9" style="text-align: center; color: #64748b;">Tidak ada data pemeriksaan</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ $tanggalCetak }}</p>
    </div>
</body>

</html>