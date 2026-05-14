@extends('layouts.app')

@section('title', 'Daftar surat')

@section('content')
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">Daftar surat</h1>
            <p class="mt-1 text-sm text-slate-600">Cari berdasarkan nomor, nama, atau jenis surat.</p>
        </div>
        <a href="{{ route('surats.create') }}" class="inline-flex items-center justify-center rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white shadow hover:bg-emerald-700">
            Tambah surat baru
        </a>
    </div>

    <form method="get" action="{{ route('surats.index') }}" class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-center">
        <input
            type="search"
            name="q"
            value="{{ $q }}"
            placeholder="Contoh: SK-2026, domisili, Budi..."
            class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-200 sm:max-w-md"
        >
        <div class="flex gap-2">
            <button type="submit" class="rounded-md bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">Cari</button>
            @if ($q !== '')
                <a href="{{ route('surats.index') }}" class="rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-800 hover:bg-slate-50">Reset</a>
            @endif
        </div>
    </form>

    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">
                <tr>
                    <th class="px-4 py-3">Nomor</th>
                    <th class="px-4 py-3">Jenis</th>
                    <th class="px-4 py-3">Nama warga</th>
                    <th class="px-4 py-3">Tanggal</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($surats as $surat)
                    <tr class="hover:bg-slate-50/80">
                        <td class="px-4 py-3 font-medium text-slate-900">{{ $surat->nomor_surat }}</td>
                        <td class="px-4 py-3 text-slate-700">{{ $surat->jenis_surat }}</td>
                        <td class="px-4 py-3 text-slate-700">{{ $surat->nama_warga }}</td>
                        <td class="px-4 py-3 text-slate-600">{{ $surat->tanggal_surat->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">
                            @php
                                $badge = match ($surat->status) {
                                    'selesai' => 'bg-emerald-100 text-emerald-900 ring-emerald-600/20',
                                    'diproses' => 'bg-amber-100 text-amber-900 ring-amber-600/20',
                                    'ditolak' => 'bg-rose-100 text-rose-900 ring-rose-600/20',
                                    default => 'bg-slate-100 text-slate-800 ring-slate-600/15',
                                };
                            @endphp
                            <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium ring-1 ring-inset {{ $badge }}">
                                {{ ucfirst(str_replace('_', ' ', $surat->status)) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a class="text-emerald-700 hover:underline" href="{{ route('surats.show', $surat) }}">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-10 text-center text-slate-600">Belum ada data surat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $surats->links() }}
    </div>
@endsection
