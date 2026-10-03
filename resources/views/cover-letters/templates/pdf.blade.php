<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $coverLetter->title }} - {{ $user->name }}</title>
    <style>
        @page {
            size: a4 portrait;
            margin: 20mm 20mm 20mm 20mm;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DejaVu Sans', Helvetica, Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.6;
            color: #1a1a1a;
            background-color: #ffffff;
        }

        /* Sender Header */
        .sender-header {
            margin-bottom: 24px;
            padding-bottom: 12px;
            border-bottom: 1.5pt solid #222222;
        }

        .sender-name {
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #111111;
            margin-bottom: 4px;
        }

        .sender-contact {
            font-size: 9pt;
            color: #444444;
        }

        /* Letter Meta */
        .letter-date {
            font-size: 9.5pt;
            color: #333333;
            margin-bottom: 16px;
        }

        .recipient-info {
            font-size: 9.5pt;
            line-height: 1.4;
            color: #222222;
            margin-bottom: 20px;
        }

        .recipient-info .company {
            font-weight: bold;
        }

        /* Subject */
        .subject-line {
            font-size: 10pt;
            font-weight: bold;
            color: #111111;
            margin-bottom: 16px;
            text-decoration: underline;
        }

        /* Letter Body */
        .letter-body {
            font-size: 9.5pt;
            line-height: 1.65;
            color: #2b2b2b;
            text-align: justify;
            margin-bottom: 28px;
            white-space: pre-line;
        }

        /* Sign-off */
        .sign-off {
            page-break-inside: avoid;
            margin-top: 20px;
        }

        .sign-off p {
            margin-bottom: 40px;
            font-size: 9.5pt;
        }

        .signature-name {
            font-weight: bold;
            font-size: 10pt;
            color: #111111;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    {{-- SENDER HEADER --}}
    <div class="sender-header">
        <div class="sender-name">{{ $user->name }}</div>
        <div class="sender-contact">
            Email: {{ $user->email }}
        </div>
    </div>

    {{-- DATE --}}
    <div class="letter-date">
        {{ now()->format('d F Y') }}
    </div>

    {{-- RECIPIENT --}}
    <div class="recipient-info">
        <p>Kepada Yth.</p>
        <p><strong>HRD / Perekrut {{ $coverLetter->company ?: 'Perusahaan' }}</strong></p>
        @if ($coverLetter->company)
            <p>{{ $coverLetter->company }}</p>
        @endif
        <p>Di Tempat</p>
    </div>

    {{-- SUBJECT --}}
    @if ($coverLetter->position)
        <div class="subject-line">
            Perihal: Lamaran Pekerjaan - {{ $coverLetter->position }}
        </div>
    @endif

    {{-- CONTENT --}}
    <div class="letter-body">
{{ trim($coverLetter->content) }}
    </div>

    {{-- SIGN OFF --}}
    <div class="sign-off">
        <p>Hormat saya,</p>
        <div class="signature-name">{{ $user->name }}</div>
    </div>

</body>
</html>
