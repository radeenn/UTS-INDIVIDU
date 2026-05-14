<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Buku Surat Kelurahan')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-5xl flex-col gap-3 px-4 py-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <a href="{{ route('surats.index') }}" class="text-lg font-semibold tracking-tight text-slate-900 hover:text-emerald-700">
                    Buku Surat Kelurahan
                </a>
                <p class="text-sm text-slate-600">Pencatatan surat administrasi warga (CRUD).</p>
            </div>
            <nav class="flex flex-wrap items-center gap-2 text-sm">
                <a class="rounded-md px-3 py-2 text-slate-700 hover:bg-slate-100" href="{{ route('surats.index') }}">Daftar</a>
                <a class="rounded-md bg-emerald-600 px-3 py-2 font-medium text-white shadow-sm hover:bg-emerald-700" href="{{ route('surats.create') }}">Tambah surat</a>
            </nav>
        </div>
    </header>

    @if (session('ok'))
        <div class="mx-auto max-w-5xl px-4 pt-4">
            <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900">
                {{ session('ok') }}
            </div>
        </div>
    @endif

    <main class="mx-auto max-w-5xl px-4 py-8">
        @yield('content')
    </main>
</body>
</html>
