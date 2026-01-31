


<!-- PDF VERSION 2026-01-30-TRACK-FIX -->


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            margin: 30px;
            font-size: 14px;
            color: #000;
        }

        .card {
            border: 2px solid #1d4ed8;
            border-radius: 14px;
            padding: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .header img {
            width: 85px;
            height: auto;
            margin-bottom: 10px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 5px;
        }

        .sub {
            font-size: 12px;
            margin-top: 3px;
        }

        hr {
            margin: 15px 0;
            border: none;
            border-top: 1px solid #000;
        }

        .section-title {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin: 10px 0;
        }

        .row {
            margin: 7px 0;
        }

        .label {
            font-weight: bold;
        }

        /* ✅ OFFICIAL BOX STYLE */
        .official-box {
            border: 1px solid #999;
            padding: 12px;
            margin-top: 15px;
            border-radius: 8px;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            background: #f9fafb;
        }

        /* ✅ TRACKING ID BOX (same style but blue text) */
        .tracking-box {
            border: 1px solid #1d4ed8;
            padding: 12px;
            margin-top: 10px;
            border-radius: 8px;
            text-align: center;
            font-size: 15px;
            font-weight: bold;
            background: #eff6ff;
            color: #1d4ed8;
        }

        .qr {
            text-align: center;
            margin-top: 18px;
        }

        .qr img {
            width: 130px;
            height: 130px;
            margin-top: 10px;
        }

        .link {
            font-size: 10px;
            margin-top: 10px;
            word-break: break-all;
        }

        .footer {
            margin-top: 15px;
            font-size: 10px;
            text-align: center;
            color: #444;
        }
    </style>
</head>

<body>



<div class="card">

    {{-- ✅ HEADER WITH LOGO --}}
    <div class="header">
        <img src="{{ public_path('uc3-logo.png') }}" alt="UC3 Logo">

        <div class="title">University of Constantine 3 – Salah Boubnider</div>
        <div class="sub">Vice-Rectorate for Higher Education</div>
        <div class="sub">Certificates and Equivalency Office</div>
    </div>

    <hr>

    <div class="section-title">Student File Receipt</div>

    {{-- ✅ STUDENT INFO --}}
    <div class="row"><span class="label">First Name:</span> {{ $file->first_name }}</div>
    <div class="row"><span class="label">Last Name:</span> {{ $file->last_name }}</div>
    <div class="row"><span class="label">Degree Type:</span> {{ $file->diploma_type }}</div>
    <div class="row"><span class="label">Submission Date:</span> {{ \Carbon\Carbon::parse($file->submitted_at)->format('Y-m-d') }}</div>

    <hr>

    {{-- ✅ RECEIPT NUMBER --}}
    <div class="official-box">
        Receipt Number: {{ $receiptNumber }}
    </div>

    {{-- ✅ TRACKING ID --}}
    <div class="tracking-box">
        Tracking ID: {{ $file->tracking_id }}
    </div>

    {{-- ✅ QR --}}
    <div class="qr">
        <div style="font-weight:bold;">Scan QR Code to Track Your File</div>
        <img src="data:image/svg+xml;base64,{{ $qrCode }}" alt="QR Code">
        <h1 style="color:red"> <div class="link">{{ $trackUrl }}</div></h1>
    </div>

    <div class="footer">
        This receipt allows the applicant to track the file online via the official UC3 platform.
    </div>

</div>

</body>
</html>
