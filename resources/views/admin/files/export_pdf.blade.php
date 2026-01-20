<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .header img {
            width: 70px;
            height: auto;
            margin-bottom: 8px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
        }

        .header p {
            margin: 2px 0;
            font-size: 11px;
            color: #333;
        }

        .print-date {
            text-align: right;
            font-size: 11px;
            margin-bottom: 10px;
            color: #444;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #cfe8f7;
            font-weight: bold;
        }

        /* ✅ Footer Page Number */
        @page {
            margin: 25px 20px;
        }

        footer {
            position: fixed;
            bottom: -10px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        @page {
    margin: 25px 20px 40px 20px; /* مساحة أسفل للترقيم */
}

    </style>
</head>

<body>

    {{-- ✅ HEADER WITH LOGO --}}
    <div class="header">
        <img src="{{ public_path('uc3-logo.png') }}" alt="UC3 Logo">

        <h2>University of Constantine 3 – Salah Boubnider</h2>
        <p>Certificates and Equivalency Office</p>
        <p>Student Files Report</p>
    </div>

    {{-- ✅ PRINT DATE --}}
    <div class="print-date">
        Printed on: {{ now()->format('Y-m-d H:i') }}
    </div>

    {{-- ✅ TABLE --}}
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Degree Type</th>
                <th>Submission Date</th>
                <th>Tracking ID</th>
                <th>Status</th>
                <th>Reception Date</th>

            </tr>
        </thead>

        <tbody>
            @foreach($files as $file)
                <tr>
                    <td>{{ $file->id }}</td>
                    <td>{{ $file->last_name }}</td>
                    <td>{{ $file->first_name }}</td>
                    <td>{{ $file->diploma_type }}</td>
                    <td>{{ \Carbon\Carbon::parse($file->submitted_at)->format('Y-m-d') }}</td>
                    <td>{{ $file->tracking_id }}</td>
                    <td>
                        @if($file->status == 'processed')
                            Verified
                        @elseif($file->status == 'pending')
                            Pending
                        @else
                            Rejected
                        @endif
                    </td>
                    <td>{{ $file->received_at ? \Carbon\Carbon::parse($file->received_at)->format('Y-m-d') : '-' }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>

    

    {{-- ✅ DOMPDF PAGE NUMBER SCRIPT --}}
    <script type="text/php">
        if ( isset($pdf) ) {
            $x = 520;
            $y = 820;
            $text = "Page {PAGE_NUM} / {PAGE_COUNT}";
            $font = $fontMetrics->get_font("DejaVu Sans", "normal");
            $size = 9;
            $pdf->page_text($x, $y, $text, $font, $size, array(0,0,0));
        }
    </script>
<script type="text/php">
    if (isset($pdf)) {
        $text = "Page {PAGE_NUM} / {PAGE_COUNT}";
        $size = 9;
        $font = $fontMetrics->getFont("DejaVu Sans", "normal");

        // ✅ حساب الوسط تلقائياً
        $width = $fontMetrics->getTextWidth($text, $font, $size);
        $x = (595.28 - $width) / 2; // 595.28 عرض A4 بالنقاط
        $y = 820; // أسفل الصفحة

        $pdf->page_text($x, $y, $text, $font, $size, array(0,0,0));
    }
</script>


</body>
</html>
