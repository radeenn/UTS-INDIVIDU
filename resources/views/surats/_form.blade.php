@php
    /** @var \App\Models\Surat|null $surat */
    $editing = $surat;
@endphp

@if ($errors->any())
    <div class="mb-6 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-900">
        <p class="font-semibold">Periksa kembali input:</p>
        <ul class="mt-2 list-disc space-y-1 pl-5">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post" action="{{ $editing ? route('surats.update', $editing) : route('surats.store') }}" class="space-y-6">
    @csrf
    @if ($editing)
        @method('PUT')
    @endif

    <div class="grid gap-6 sm:grid-cols-2">
        <div class="sm:col-span-2">
            <label class="block text-sm font-medium text-slate-800" for="nomor_surat">Nomor surat</label>
            <input id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat', $editing?->nomor_surat) }}"
                class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-200"
                required>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-800" for="jenis_surat">Jenis surat</label>
            <input id="jenis_surat" name="jenis_surat" list="jenis-list" value="{{ old('jenis_surat', $editing?->jenis_surat) }}"
                class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-200"
                required>
            <datalist id="jenis-list">
                <option value="Keterangan domisili"></option>
                <option value="Pengantar nikah"></option>
                <option value="Keterangan tidak mampu"></option>
                <option value="Izin keramaian"></option>
                <option value="Keterangan usaha (SKU)"></option>
            </datalist>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-800" for="tanggal_surat">Tanggal surat</label>
            <input id="tanggal_surat" type="date" name="tanggal_surat" value="{{ old('tanggal_surat', $editing?->tanggal_surat?->format('Y-m-d') ?? now()->format('Y-m-d')) }}"
                class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-200"
                required>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-800" for="nama_warga">Nama warga</label>
            <input id="nama_warga" name="nama_warga" value="{{ old('nama_warga', $editing?->nama_warga) }}"
                class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-200"
                required>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-800" for="nik">NIK (opsional)</label>
            <input id="nik" name="nik" value="{{ old('nik', $editing?->nik) }}"
                class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-200">
        </div>

        <div class="sm:col-span-2">
            <label class="block text-sm font-medium text-slate-800" for="keperluan">Keperluan / isi ringkas</label>
            <textarea id="keperluan" name="keperluan" rows="4"
                class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-200"
                required>{{ old('keperluan', $editing?->keperluan) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-800" for="status">Status</label>
            <select id="status" name="status"
                class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-200"
                required>
                @foreach (['diajukan', 'diproses', 'selesai', 'ditolak'] as $st)
                    <option value="{{ $st }}" @selected(old('status', $editing?->status ?? 'diajukan') === $st)>
                        {{ ucfirst($st) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="sm:col-span-2">
            <label class="block text-sm font-medium text-slate-800" for="catatan_admin">Catatan admin (opsional)</label>
            <textarea id="catatan_admin" name="catatan_admin" rows="3"
                class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-200">{{ old('catatan_admin', $editing?->catatan_admin) }}</textarea>
        </div>
    </div>

    <div class="flex flex-col-reverse gap-2 sm:flex-row sm:items-center sm:justify-between">
        <a href="{{ route('surats.index') }}" class="inline-flex justify-center rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-800 hover:bg-slate-50">Batal</a>
        <button type="submit" class="inline-flex justify-center rounded-md bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-emerald-700">
            {{ $editing ? 'Simpan perubahan' : 'Simpan surat' }}
        </button>
    </div>
</form>
