<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SpeakerHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-slate { background-color: #0f172a !important; }
        .navbar-slate .navbar-brand { color: #ffffff !important; }
        .form-card {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 50px;
        }
        .btn-primary-custom {
            background-color: #2563eb;
            color: white;
            border: none;
        }
        .btn-primary-custom:hover {
            background-color: #1d4ed8;
            color: white;
        }
    </style>
</head>
<body style="background-color: #f8fafc;">

    <nav class="navbar navbar-expand-lg navbar-slate shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">SpeakerHub</a>
        </div>
    </nav>

    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="form-card">
                        <h2 class="h4 fw-bold mb-3 border-bottom pb-2" style="color: #1e293b;">Login SpeakerHub</h2>

                        @if ($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('login.proses') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="username" class="form-label fw-semibold">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Ingat saya</label>
                            </div>

                            <button type="submit" class="btn btn-primary-custom w-100 py-2 fw-semibold">Masuk</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>