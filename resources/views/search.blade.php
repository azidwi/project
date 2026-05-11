@extends('layouts.app')

@section('content')

<div class="glass-card">

<h2 class="mb-4">Hasil Pencarian: "{{ $q }}"</h2>

<h4>Buku</h4>

<table class="table text-white">

<thead>
<tr>
<th>Judul</th>
<th>Pengarang</th>
<th>Penerbit</th>
</tr>
</thead>

<tbody>

@forelse($bukus as $buku)

<tr>
<td>{{ $buku->judul }}</td>
<td>{{ $buku->pengarang }}</td>
<td>{{ $buku->penerbit }}</td>
</tr>

@empty

<tr>
<td colspan="3">Tidak ada buku ditemukan</td>
</tr>

@endforelse

</tbody>
</table>


<h4 class="mt-5">Pensil</h4>

<table class="table text-white">

<thead>
<tr>
<th>Nama</th>
<th>Warna</th>
<th>Stok</th>
</tr>
</thead>

<tbody>

@forelse($pensils as $pensil)

<tr>
<td>{{ $pensil->nama }}</td>
<td>{{ $pensil->warna }}</td>
<td>{{ $pensil->stok }}</td>
</tr>

@empty

<tr>
<td colspan="3">Tidak ada pensil ditemukan</td>
</tr>

@endforelse

</tbody>

</table>

</div>

@endsection