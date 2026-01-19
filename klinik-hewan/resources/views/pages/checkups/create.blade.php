@extends('layouts.layouts')

@section('title','Tambah Pemeriksaan')

@section('content')
<h4>Tambah Pemeriksaan</h4>

@if ($errors->any())
<div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

<form method="POST" action="{{ route('checkups.store') }}">
@csrf

<div class="mb-3">
    <label>Perawatan</label>
    <select name="tratement_id" class="form-control" required>
        <option value="">-- Pilih Perawatan --</option>
        @foreach($treatements as $t)
        <option value="{{ $t->id }}">
            {{ $t->pet->nama }} - {{ ucfirst($t->jenis_perawatan) }}
        </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Catatan Pemeriksaan</label>
    <textarea name="catatan_pemeriksaan"
        class="form-control" rows="4" required></textarea>
</div>

<button class="btn btn-primary">Simpan</button>
<a href="{{ route('checkups.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
