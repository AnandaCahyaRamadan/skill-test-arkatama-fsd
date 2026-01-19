@extends('layouts.layouts')

@section('title','Edit Hewan')

@section('content')
<h4>Edit Hewan</h4>

@if ($errors->any())
<div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

<form method="POST" action="{{ route('pets.update',$pet) }}">
@csrf @method('PUT')

<div class="mb-3">
    <label>Data Hewan</label>
    <input type="text" name="hewan" class="form-control"
        value="{{ old('hewan',$petText) }}">
</div>

<div class="mb-3">
    <label>Pemilik</label>
    <select name="owner_id" class="form-control">
        @foreach($owners as $o)
            <option value="{{ $o->id }}"
                {{ $o->id == $pet->owner_id ? 'selected' : '' }}>
                {{ $o->name }}
            </option>
        @endforeach
    </select>
</div>

<button class="btn btn-warning">Update</button>
<a href="{{ route('pets.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
