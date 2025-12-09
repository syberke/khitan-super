<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Print All QR</title>

    <style>
        @page { margin: 25px; }

        body {
            font-family: sans-serif;
        }

        table.page {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        td.card {
            width: 50%;
            padding: 10px;
            vertical-align: top;
        }

        .qr-box {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
        }

        .logo {
            width: 60px;
            margin-bottom: 10px;
        }

        .header {
            font-size: 18px;
            font-weight: bold;
            color: #005bac;
        }

        .qr-img {
            margin: 10px 0;
        }

        .qr-img img {
            width: 150px;
            height: 150px;
        }

        .info-table {
            width: 100%;
            font-size: 12px;
        }

        .info-table td:first-child {
            width: 40%;
            font-weight: bold;
        }

        .footer {
            margin-top: 10px;
            font-size: 10px;
            color: #666;
            border-top: 1px dashed #aaa;
            padding-top: 5px;
        }
    </style>

</head>
<body>

@php
    $chunks = $recipients->chunk(4);
@endphp

@foreach ($chunks as $chunk)
<table class="page">
    <tr>
        @foreach ($chunk->slice(0,2) as $recipient)
        <td class="card">
            <div class="qr-box">

                <img src="{{ public_path('image/logo.png') }}" class="logo">

                <div class="header">Khitanan Ceria</div>

                <div class="qr-img">
                    <img src="data:image/png;base64,{{ base64_encode(QrCode::format('png')->size(150)->generate($recipient->qr_code)) }}">
                </div>

                <table class="info-table">
                    <tr><td>Nama</td><td>{{ $recipient->child_name }}</td></tr>
                    <tr><td>Ayah</td><td>{{ $recipient->Ayah_name }}</td></tr>
                    <tr><td>Ibu</td><td>{{ $recipient->Ibu_name }}</td></tr>
                    <tr>
                        <td>Tgl Lahir</td>
                        <td>
                            @if($recipient->birth_date)
                                {{ \Carbon\Carbon::parse($recipient->birth_date)->format('d-m-Y') }}
                            @else -
                            @endif
                        </td>
                    </tr>
                    <tr><td>WA</td><td>{{ $recipient->whatsapp_number ?? '-' }}</td></tr>
                </table>

                <div class="footer">
                    Scan QR ini saat registrasi penyaluran<br>
                    Program Khitanan Ceria
                </div>
            </div>
        </td>
        @endforeach

        @if ($chunk->count() < 2)
            <td class="card"></td>
        @endif
    </tr>

    <tr>
        @foreach ($chunk->slice(2,2) as $recipient)
        <td class="card">
            <div class="qr-box">

                <img src="{{ public_path('image/logo.png') }}" class="logo">

                <div class="header">Khitanan Ceria</div>

                <div class="qr-img">
                    <img src="data:image/png;base64,{{ base64_encode(QrCode::format('png')->size(150)->generate($recipient->qr_code)) }}">
                </div>

                <table class="info-table">
                    <tr><td>Nama</td><td>{{ $recipient->child_name }}</td></tr>
                    <tr><td>Ayah</td><td>{{ $recipient->Ayah_name }}</td></tr>
                    <tr><td>Ibu</td><td>{{ $recipient->Ibu_name }}</td></tr>
                    <tr>
                        <td>Tgl Lahir</td>
                        <td>
                            @if($recipient->birth_date)
                                {{ \Carbon\Carbon::parse($recipient->birth_date)->format('d-m-Y') }}
                            @else -
                            @endif
                        </td>
                    </tr>
                    <tr><td>WA</td><td>{{ $recipient->whatsapp_number ?? '-' }}</td></tr>
                </table>

                <div class="footer">
                    Scan QR ini saat registrasi penyaluran<br>
                    Program Khitanan Ceria
                </div>
            </div>
        </td>
        @endforeach

        @if ($chunk->count() < 4)
            <td class="card"></td>
        @endif
    </tr>
</table>

@if (!$loop->last)
<div style="page-break-after: always;"></div>
@endif

@endforeach

</body>
</html>
