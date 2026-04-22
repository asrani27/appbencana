<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Invoice ERZEN</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f6f9;
        }

        .invoice-box {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #2E86C1;
            padding-bottom: 10px;
        }

        .header img {
            height: 60px;
        }

        .title {
            font-size: 28px;
            color: #2E86C1;
            font-weight: bold;
        }

        .info {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .info div {
            width: 48%;
        }

        .info strong {
            display: block;
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table thead {
            background: #2E86C1;
            color: white;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        table td {
            text-align: right;
        }

        table td.desc {
            text-align: left;
        }

        .summary {
            margin-top: 20px;
            width: 100%;
        }

        .summary td {
            padding: 8px;
        }

        .total {
            background: #D6EAF8;
            font-weight: bold;
        }

        .payment {
            margin-top: 30px;
        }

        .footer {
            margin-top: 40px;
            font-size: 13px;
            color: #555;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>

<body>

    <div class="invoice-box">

        <!-- HEADER -->
        <div class="header">
            <img src="/logo/ERZEN.png" alt="Logo">
            <div style="text-align: center;font-size:24px; font-weight:bold">CV. ERZEN DIGITAL TEKNOLOGI
            </div>
            <div class="title">INVOICE</div>
        </div>

        <!-- INFO -->
        <div class="info">
            <div>
                <strong>Invoice To:</strong>
                Hastin Atas Asih<br>
                +62811 5565 569
            </div>

            <div style="text-align:right;">
                <strong>Invoice No:</strong> INV/ERZEN/IV/2026/001<br>
                <strong>Date:</strong> 22 April 2026
            </div>
        </div>

        <!-- TABLE -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th style="text-align:left;">Item Description</th>
                    <th>Qty</th>
                    <th>Satuan</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td class="desc">Analisis & Perencanaan Sistem</td>
                    <td>1</td>
                    <td>Paket</td>
                    <td>800.000</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td class="desc">Pembuatan Aplikasi Web SRMB</td>
                    <td>1</td>
                    <td>Aplikasi Web</td>
                    <td>8.000.000</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td class="desc">Pembuatan Aplikasi Android SRMB</td>
                    <td>1</td>
                    <td>Aplikasi Android</td>
                    <td>6.000.000</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td class="desc">Publish Playstore</td>
                    <td>1</td>
                    <td>Paket</td>
                    <td>700.000</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td class="desc">Server untuk 2 tahun</td>
                    <td>2</td>
                    <td>tahun</td>
                    <td>5.330.000</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td class="desc">Maintenance & Support (2 Tahun)</td>
                    <td>2</td>
                    <td>tahun</td>
                    <td>1.500.000</td>
                </tr>
            </tbody>
        </table>

        <!-- SUMMARY -->
        <table class="summary">
            <tr>
                <td style="text-align:right;">Subtotal</td>
                <td style="text-align:right; width:150px;">22.330.000</td>
            </tr>
            <tr>
                <td style="text-align:right;">PPN 12%</td>
                <td style="text-align:right;">2.679.600</td>
            </tr>
            <tr class="total">
                <td style="text-align:right;">TOTAL</td>
                <td style="text-align:right;">25.009.600</td>
            </tr>
        </table>

        <!-- PAYMENT -->
        <div class="payment">
            <strong>Payment Information:</strong><br>
            Bank BCA<br>
            No Rekening: 7820894213<br>
            Atas Nama: Asrani
        </div>

        <!-- FOOTER -->
        <div class="footer">
            Terima kasih atas kepercayaan Anda.<br>
            CV. ERZEN DIGITAL TEKNOLOGI - Professional IT Solutions
        </div>

    </div>

</body>

</html>