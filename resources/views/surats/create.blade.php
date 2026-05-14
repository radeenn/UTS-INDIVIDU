@extends('layouts.app')

@section('title', 'Tambah surat')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Tambah surat baru</h1>
        <p class="mt-1 text-sm text-slate-600">Lengkapi data administrasi surat kelurahan.</p>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        @include('surats._form', ['surat' => null])
    </div>
@endsection
