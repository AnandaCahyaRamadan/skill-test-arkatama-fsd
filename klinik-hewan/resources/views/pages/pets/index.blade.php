@extends('layouts.layouts')

@section('title','Data Hewan')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Data Hewan</h4>
    <a href="{{ route('pets.create') }}" class="btn btn-primary">Tambah Hewan</a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Usia</th>
            <th>Berat</th>
            <th>Owner</th>
            <th width="120">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pets as $pet)
        <tr>
            <td>{{ $pet->kode_hewan }}</td>
            <td>{{ $pet->nama }}</td>
            <td>{{ $pet->jenis }}</td>
            <td>{{ $pet->usia }}</td>
            <td>{{ $pet->berat }} Kg</td>
            <td>{{ $pet->owner->name }}</td>
            <td>
                <a href="{{ route('pets.edit',$pet) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('pets.destroy',$pet) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Hapus data?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
