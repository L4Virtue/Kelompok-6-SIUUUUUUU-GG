<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pengelolaan Event & Workshop - Tiket & Kategori - Daftar Tiket</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">

            <a class="navbar-brand" href="{{ route('tiket.daftar') }}">
                Sistem Pengelolaan Event & Workshop - Tiket & Kategori
            </a>

            <div class="d-flex gap-2 align-items-center">

                <a class="btn btn-outline-light" href="{{ route('tiket.index') }}">
                    Tambah Tiket Baru
                </a>

                @auth
                    <span class="text-white">
                        {{ Auth::user()->username }}
                    </span>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            Logout
                        </button>
                    </form>
                @else
                    <a class="btn btn-success" href="{{ route('login') }}">
                        Login
                    </a>
                @endauth

            </div>
        </div>
    </nav>

    <div class="container">

        <h2 class="mb-3">Daftar Kategori Tiket</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped table-bordered custom-table-spacing">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Tipe Tiket</th>
                    <th>Harga (Rp)</th>
                    <th>Kuota</th>
                    <th>Fasilitas Benefit</th>

                    @auth
                        <th>Aksi</th>
                    @endauth
                </tr>
            </thead>

            <tbody>
                @foreach ($tiket as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <strong>{{ $item->tipe_tiket }}</strong>
                        </td>

                        <td>
                            Rp {{ number_format($item->harga_tiket, 0, ',', '.') }}
                        </td>

                        <td>{{ $item->kuota }}</td>

                        <td>{{ $item->fasilitas }}</td>

                        @auth
                            <td>
                                <a href="{{ route('tiket.edit', $item->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('tiket.destroy', $item->id) }}"
                                    method="POST"
                                    style="display: inline;"
                                    onsubmit="return confirm('Yakin ingin menghapus tiket ini?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        @endauth
                    </tr>
                @endforeach

                @if ($tiket->isEmpty())
                    <tr>
                        <td colspan="{{ auth()->check() ? 6 : 5 }}"
                            class="text-center">
                            Belum ada data tiket.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

    </div>

</body>
</html>
