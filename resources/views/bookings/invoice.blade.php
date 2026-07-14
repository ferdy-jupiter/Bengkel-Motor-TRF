<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 12px;
            color: #1e293b;
            margin: 0;
            padding: 0;
        }

        .header {
            border-bottom: 3px solid #c2410c;
            padding-bottom: 12px;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .header h1 {
            font-size: 22px;
            margin: 0;
            color: #1e293b;
        }

        .header p {
            margin: 2px 0 0;
            color: #64748b;
            font-size: 11px;
        }

        .header .meta {
            float: right;
            text-align: right;
        }

        .section-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94a3b8;
            margin: 18px 0 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 3px 0;
            vertical-align: top;
        }

        .info-table td.label {
            color: #64748b;
            width: 110px;
        }

        .item-table {
            margin-top: 8px;
        }

        .item-table th {
            background: #1e293b;
            color: #fff;
            text-align: left;
            padding: 8px;
            font-size: 11px;
        }

        .item-table td {
            padding: 8px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 11px;
        }

        .item-table .right {
            text-align: right;
        }

        .total-row td {
            font-weight: bold;
            font-size: 13px;
            border-top: 2px solid #1e293b;
            border-bottom: none;
            padding-top: 10px;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 10px;
            font-size: 10px;
            background: #dcfce7;
            color: #166534;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            color: #94a3b8;
            font-size: 10px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>TRF</h1>
        <p>Bengkel Resmi Tim Balap</p>
        <div class="meta">
            <p><strong>NOTA SERVIS</strong></p>
            <p>No: INV-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</p>
            <p>Tanggal cetak: {{ now()->translatedFormat('d M Y') }}</p>
        </div>
    </div>

    <div class="section-title">Informasi Pelanggan</div>
    <table class="info-table">
        <tr>
            <td class="label">Nama</td>
            <td>: {{ $booking->user->name }}</td>
        </tr>
        <tr>
            <td class="label">Motor</td>
            <td>: {{ $booking->motor->merk }} {{ $booking->motor->tipe }} ({{ $booking->motor->no_plat }})</td>
        </tr>
        <tr>
            <td class="label">Jadwal Servis</td>
            <td>: {{ \Carbon\Carbon::parse($booking->tanggal_servis)->translatedFormat('d M Y') }},
                {{ \Carbon\Carbon::parse($booking->jam_servis)->format('H:i') }}</td>
        </tr>
        <tr>
            <td class="label">Mekanik</td>
            <td>: {{ $booking->mekanik->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Status</td>
            <td>: <span class="status-badge">{{ ucfirst($booking->status) }}</span></td>
        </tr>
    </table>

    <div class="section-title">Rincian Biaya</div>
    <table class="item-table">
        <thead>
            <tr>
                <th>Item</th>
                <th class="right">Qty</th>
                <th class="right">Harga Satuan</th>
                <th class="right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $booking->layanan->nama }} (Jasa Layanan)</td>
                <td class="right">1</td>
                <td class="right">Rp {{ number_format($booking->layanan->harga, 0, ',', '.') }}</td>
                <td class="right">Rp {{ number_format($booking->layanan->harga, 0, ',', '.') }}</td>
            </tr>
            @foreach($booking->spareparts as $sp)
                <tr>
                    <td>{{ $sp->nama }}</td>
                    <td class="right">{{ $sp->pivot->qty }}</td>
                    <td class="right">Rp {{ number_format($sp->pivot->harga_saat_itu, 0, ',', '.') }}</td>
                    <td class="right">Rp {{ number_format($sp->pivot->qty * $sp->pivot->harga_saat_itu, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="3">Total</td>
                <td class="right">Rp {{ number_format($booking->totalBiaya(), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    @if($booking->catatan)
        <div class="section-title">Catatan</div>
        <p>{{ $booking->catatan }}</p>
    @endif

    <div class="footer">
        <p>Terima kasih telah mempercayakan servis motor Anda kepada TRF.</p>
        <p>Nota ini dicetak otomatis oleh sistem dan sah tanpa tanda tangan basah.</p>
    </div>

</body>

</html>