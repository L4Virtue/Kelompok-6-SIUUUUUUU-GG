<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-slate { background-color: #0f172a !important; }
        .navbar-slate .navbar-brand { color: #ffffff !important; }
        .custom-card-slate {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 32px;
            max-width: 460px;
            width: 100%;
        }
        .btn-blue {
            background-color: #2563eb;
            color: #ffffff;
            border: none;
        }
        .btn-blue:hover {
            background-color: #1d4ed8;
            color: #ffffff;
        }
    </style>
</head>
<body style="background-color: #f8fafc;" class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-slate shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('speaker.index') }}">SpeakerHub</a>
        </div>
    </nav>

    <main class="flex-grow-1 d-flex align-items-center justify-content-center p-3">
        <div class="custom-card-slate text-center">
            <h1 class="display-4 fw-bold text-danger mb-2">403</h1>
            <h5 class="fw-bold mb-3" style="color: #1e293b;">Akses Ditolak</h5>
            <p class="text-muted mb-4">
                {{ $exception->getMessage() ?: 'Anda tidak memiliki hak akses.' }}
            </p>
            <a href="{{ route('speaker.index') }}" class="btn btn-blue px-4 py-2 fw-semibold">
                Kembali ke Daftar Pembicara
            </a>
        </div>
    </main>
</body>
</html>