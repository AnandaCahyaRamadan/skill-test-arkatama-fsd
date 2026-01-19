@extends('layouts.layouts')

@section('title','Data Pemeriksaan')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Data Pemeriksaan</h4>
    <a href="{{ route('checkups.create') }}" class="btn btn-primary">
        Tambah Pemeriksaan
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Hewan</th>
            <th>Jenis Perawatan</th>
            <th>Catatan</th>
            <th width="120">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($checkups as $c)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $c->treatment->pet->nama }}</td>
            <td class="text-uppercase">{{ $c->treatment->jenis_perawatan }}</td>
            <td>{{ $c->catatan_pemeriksaan }}</td>
            <td>
                <a href="{{ route('checkups.edit',$c) }}" class="btn btn-warning btn-sm">
                    Edit
                </a>
                <form action="{{ route('checkups.destroy',$c) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Hapus data?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
