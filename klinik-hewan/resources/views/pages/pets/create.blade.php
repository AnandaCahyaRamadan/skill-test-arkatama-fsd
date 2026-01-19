@extends('layouts.layouts')

@section('title', 'Input Hewan')

@section('content')
<h4>Input Data Hewan</h4>

@if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('pets.store') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">Data Hewan</label>
        <input type="text" name="hewan"
            class="form-control"
            placeholder="Milo Kucing 2Th 4.5kg"
            value="{{ old('hewan') }}"
            required>
        <small class="text-muted">
            Format: NAMA JENIS USIA BERAT
        </small>
    </div>

    <div class="mb-3">
        <label class="form-label">Pemilik</label>
        <select name="owner_id" class="form-control" required>
            <option value="">-- Pilih Pemilik --</option>
            @foreach ($owners as $owner)
                <option value="{{ $owner->id }}"
                    {{ old('owner_id') == $owner->id ? 'selected' : '' }}>
                    {{ $owner->name }}
                </option>
            @endforeach
        </select>
        <small class="text-muted">
            Hanya pemilik dengan nomor terverifikasi
        </small>
    </div>

    <button class="btn btn-primary">Simpan</button>
</form>
@endsection
