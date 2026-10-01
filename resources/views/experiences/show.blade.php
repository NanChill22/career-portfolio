<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengalaman</title>
</head>
<body>

    <h1>{{ $experience->position }}</h1>

    <h2>{{ $experience->company }}</h2>

    <p>
        <strong>Periode:</strong>

        {{ $experience->start_date->format('M Y') }}

        -

        @if ($experience->is_current)
            Sekarang
        @elseif ($experience->end_date)
            {{ $experience->end_date->format('M Y') }}
        @else
            -
        @endif
    </p>

    <p>
        <strong>Deskripsi:</strong>
    </p>

    <p>
        {{ $experience->description ?: 'Tidak ada deskripsi.' }}
    </p>

    <br>

    <a href="{{ route('experiences.edit', $experience) }}">
        Edit
    </a>

    |

    <a href="{{ route('experiences.index') }}">
        Kembali
    </a>

</body>
</html>