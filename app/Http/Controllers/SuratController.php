<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SuratController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q', ''));
        $surats = Surat::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('nomor_surat', 'like', '%'.$q.'%')
                        ->orWhere('nama_warga', 'like', '%'.$q.'%')
                        ->orWhere('jenis_surat', 'like', '%'.$q.'%');
                });
            })
            ->orderByDesc('tanggal_surat')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('surats.index', compact('surats', 'q'));
    }

    public function create(): View
    {
        return view('surats.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nomor_surat' => ['required', 'string', 'max:50', 'unique:surats,nomor_surat'],
            'jenis_surat' => ['required', 'string', 'max:120'],
            'nama_warga' => ['required', 'string', 'max:150'],
            'nik' => ['nullable', 'string', 'max:20'],
            'keperluan' => ['required', 'string', 'max:2000'],
            'status' => ['required', 'in:diajukan,diproses,selesai,ditolak'],
            'tanggal_surat' => ['required', 'date'],
            'catatan_admin' => ['nullable', 'string', 'max:2000'],
        ]);

        Surat::create($data);

        return redirect()
            ->route('surats.index')
            ->with('ok', 'Surat berhasil ditambahkan.');
    }

    public function show(Surat $surat): View
    {
        return view('surats.show', compact('surat'));
    }

    public function edit(Surat $surat): View
    {
        return view('surats.edit', compact('surat'));
    }

    public function update(Request $request, Surat $surat): RedirectResponse
    {
        $data = $request->validate([
            'nomor_surat' => ['required', 'string', 'max:50', 'unique:surats,nomor_surat,'.$surat->id],
            'jenis_surat' => ['required', 'string', 'max:120'],
            'nama_warga' => ['required', 'string', 'max:150'],
            'nik' => ['nullable', 'string', 'max:20'],
            'keperluan' => ['required', 'string', 'max:2000'],
            'status' => ['required', 'in:diajukan,diproses,selesai,ditolak'],
            'tanggal_surat' => ['required', 'date'],
            'catatan_admin' => ['nullable', 'string', 'max:2000'],
        ]);

        $surat->update($data);

        return redirect()
            ->route('surats.show', $surat)
            ->with('ok', 'Data surat diperbarui.');
    }

    public function destroy(Surat $surat): RedirectResponse
    {
        $surat->delete();

        return redirect()
            ->route('surats.index')
            ->with('ok', 'Surat dihapus.');
    }
}
