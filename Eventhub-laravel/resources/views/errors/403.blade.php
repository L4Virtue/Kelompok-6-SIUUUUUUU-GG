<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
<div class="text-center">
    <h1 class="display-1 fw-bold text-danger">403</h1>
    <h2 class="mb-3">Akses Ditolak</h2>
    <p class="text-muted mb-4">
        {{ $exception->getMessage() ?: 'Anda tidak memiliki hak akses.' }}[cite: 13]
    </p>
    <a href="{{ route('pendaftaran.daftar') }}" class="btn btn-primary px-4 fw-bold">Kembali ke Beranda</a>
</div>
</body>
</html>