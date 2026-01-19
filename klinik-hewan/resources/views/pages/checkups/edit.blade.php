@extends('layouts.layouts')

@section('title','Edit Pemeriksaan')

@section('content')
<h4>Edit Pemeriksaan</h4>

@if ($errors->any())
<div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

<form method="POST" action="{{ route('checkups.update',$checkup) }}">
@csrf @method('PUT')

<div class="mb-3">
    <label>Hewan</label>
    <input type="text" class="form-control"
        value="{{ $checkup->treatment->pet->nama }}" readonly>
</div>

<div class="mb-3">
    <label>Jenis Perawatan</label>
    <input type="text" class="form-control"
        value="{{ ucfirst($checkup->treatment->jenis_perawatan) }}" readonly>
</div>

<div class="mb-3">
    <label>Catatan Pemeriksaan</label>
    <textarea name="catatan_pemeriksaan"
        class="form-control" rows="4" required>{{ $checkup->catatan_pemeriksaan }}</textarea>
</div>

<button class="btn btn-warning">Update</button>
<a href="{{ route('checkups.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
