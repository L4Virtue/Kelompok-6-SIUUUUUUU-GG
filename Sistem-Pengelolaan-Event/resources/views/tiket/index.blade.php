
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistem Event - Tambah Tiket</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('tiket.daftar') }}">
                Modul Tiket & Kategori
            </a>

            <a class="btn btn-outline-light" href="{{ route('tiket.daftar') }}">
                Kembali ke Daftar
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="form-box">

            <h2 class="mb-4">Formulir Tambah Tiket</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Periksa kembali data yang diisi:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('tiket.store') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label for="tipeTiket" class="form-label">
                        Tipe Tiket
                    </label>

                    <select
                        class="form-select"
                        id="tipeTiket"
                        name="tipe_tiket"
                        required
                    >
                        <option value="">Pilih Tipe Tiket...</option>

                        <option value="Early Bird" {{ old('tipe_tiket') == 'Early Bird' ? 'selected' : '' }}>
                            Early Bird
                        </option>

                        <option value="VIP" {{ old('tipe_tiket') == 'VIP' ? 'selected' : '' }}>
                            VIP
                        </option>

                        <option value="Regular" {{ old('tipe_tiket') == 'Regular' ? 'selected' : '' }}>
                            Regular
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="hargaTiket" class="form-label">
                        Harga Tiket (Rp)
                    </label>

                    <input
                        type="number"
                        class="form-control"
                        id="hargaTiket"
                        name="harga_tiket"
                        value="{{ old('harga_tiket') }}"
                        min="0"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="kuotaTiket" class="form-label">
                        Kuota
                    </label>

                    <input
                        type="number"
                        class="form-control"
                        id="kuotaTiket"
                        name="kuota"
                        value="{{ old('kuota') }}"
                        min="1"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="fasilitasBenefit" class="form-label">
                        Fasilitas Benefit
                    </label>

                    <textarea
                        class="form-control"
                        id="fasilitasBenefit"
                        name="fasilitas"
                        rows="3"
                        required
                    >{{ old('fasilitas') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Simpan Data Tiket
                </button>

            </form>

        </div>
    </div>

</body>
</html>
