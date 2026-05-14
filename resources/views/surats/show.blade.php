@extends('layouts.app')

@section('title', 'Detail surat')

@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">Detail surat</h1>
            <p class="mt-1 text-sm text-slate-600">{{ $surat->nomor_surat }} — {{ $surat->jenis_surat }}</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('surats.edit', $surat) }}" class="inline-flex items-center justify-center rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-900 hover:bg-slate-50">Ubah</a>
            <form method="post" action="{{ route('surats.destroy', $surat) }}" onsubmit="return confirm('Hapus surat ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center justify-center rounded-md bg-rose-600 px-4 py-2 text-sm font-medium text-white hover:bg-rose-700">Hapus</button>
            </form>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-4 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Nama warga</p>
                <p class="mt-1 text-base text-slate-900">{{ $surat->nama_warga }}</p>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">NIK</p>
                    <p class="mt-1 text-base text-slate-900">{{ $surat->nik ?: '—' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Tanggal surat</p>
                    <p class="mt-1 text-base text-slate-900">{{ $surat->tanggal_surat->format('d/m/Y') }}</p>
                </div>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Keperluan</p>
                <p class="mt-1 whitespace-pre-line text-sm leading-relaxed text-slate-800">{{ $surat->keperluan }}</p>
            </div>
        </div>

        <div class="space-y-4 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Status</p>
                @php
                    $badge = match ($surat->status) {
                        'selesai' => 'bg-emerald-100 text-emerald-900 ring-emerald-600/20',
                        'diproses' => 'bg-amber-100 text-amber-900 ring-amber-600/20',
                        'ditolak' => 'bg-rose-100 text-rose-900 ring-rose-600/20',
                        default => 'bg-slate-100 text-slate-800 ring-slate-600/15',
                    };
                @endphp
                <p class="mt-2">
                    <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-medium ring-1 ring-inset {{ $badge }}">
                        {{ ucfirst($surat->status) }}
                    </span>
                </p>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Catatan admin</p>
                <p class="mt-1 whitespace-pre-line text-sm text-slate-800">{{ $surat->catatan_admin ?: '—' }}</p>
            </div>
            <div class="border-t border-slate-100 pt-4 text-xs text-slate-500">
                Dibuat: {{ $surat->created_at?->format('d/m/Y H:i') }}<br>
                Diperbarui: {{ $surat->updated_at?->format('d/m/Y H:i') }}
            </div>
            <a href="{{ route('surats.index') }}" class="inline-flex w-full justify-center rounded-md bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">Kembali ke daftar</a>
        </div>
    </div>
@endsection
