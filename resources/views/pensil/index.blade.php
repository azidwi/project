@extends('layouts.app')

@section('content')

<div style="color:red;">
LOGIN: {{ auth()->check() ? 'YES' : 'NO' }} |
ROLE: {{ auth()->user()?->role ?? 'NULL' }}
</div>

<div class="glass-card">

<h2>Daftar Pensil</h2>

@if(auth()->user()?->role === 'admin')
<a href="{{ route('pensil.create') }}" class="btn btn-glow mb-3">
    Tambah Pensil
</a>
@endif

<table class="table text-white">

<thead>
<tr>
<th>Nama</th>
<th>Warna</th>
<th>Stok</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

@foreach($pensils as $pensil)
<tr>
<td>{{ $pensil->nama }}</td>
<td>{{ $pensil->warna }}</td>
<td>{{ $pensil->stok }}</td>

<td>

@if(auth()->user()?->role === 'admin')

<a href="{{ route('pensil.edit',$pensil->id) }}" class="btn btn-warning btn-sm">
    Edit
</a>

<form action="{{ route('pensil.destroy',$pensil->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger btn-sm">Hapus</button>
</form>

@else
-
@endif

</td>

</tr>
@endforeach

</tbody>

</table>

</div>

@endsection