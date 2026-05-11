@extends('layouts.app')

@section('content')

<div style="color:red;">
LOGIN: {{ auth()->check() ? 'YES' : 'NO' }} |
ROLE: {{ auth()->user()?->role ?? 'NULL' }}
</div>

<div class="glass-card">

<h2>Daftar Buku</h2>

@if(auth()->user()?->role === 'admin')
<a href="{{ route('buku.create') }}" class="btn btn-glow mb-3">
    Tambah Buku
</a>
@endif

<table class="table text-white">

<thead>
<tr>
<th>Judul</th>
<th>Pengarang</th>
<th>Penerbit</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

@foreach($bukus as $buku)
<tr>
<td>{{ $buku->judul }}</td>
<td>{{ $buku->pengarang }}</td>
<td>{{ $buku->penerbit }}</td>

<td>

@if(auth()->user()?->role === 'admin')

<a href="{{ route('buku.edit',$buku->id) }}" class="btn btn-warning btn-sm">
    Edit
</a>

<form action="{{ route('buku.destroy',$buku->id) }}" method="POST" class="d-inline">
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