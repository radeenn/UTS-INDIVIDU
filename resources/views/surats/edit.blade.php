@extends('layouts.app')

@section('title', 'Ubah surat')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Ubah surat</h1>
        <p class="mt-1 text-sm text-slate-600">Nomor: <span class="font-medium text-slate-900">{{ $surat->nomor_surat }}</span></p>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        @include('surats._form', ['surat' => $surat])
    </div>
@endsection
