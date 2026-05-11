@extends('layouts.app')

@section('content')

<div style="color:red;">
LOGIN: {{ auth()->check() ? 'YES' : 'NO' }} |
ROLE: {{ auth()->user()?->role ?? 'NULL' }}
</div>

<div class="container-fluid">

<div class="row">

<!-- SIDEBAR -->

<div class="col-md-2 p-3" style="background:rgba(255,255,255,0.03);min-height:100vh">

<h4 class="mb-4">MyApp</h4>

<ul class="nav flex-column">

<li class="nav-item mb-2">
<a class="nav-link text-white" href="{{ route('dashboard') }}">Dashboard</a>
</li>

<li class="nav-item mb-2">
<a class="nav-link text-white" href="{{ route('buku.index') }}">Buku</a>
</li>

<li class="nav-item mb-2">
<a class="nav-link text-white" href="{{ route('pensil.index') }}">Pensil</a>
</li>

<li class="nav-item mb-2">
<a class="nav-link text-white" href="{{ route('profile') }}">Profile</a>
</li>

</ul>

</div>

<!-- MAIN -->

<div class="col-md-10 p-4">

<h2 class="mb-4">Dashboard</h2>

<div class="row g-4">

<div class="col-md-3">
<div class="glass-card text-center">
<h3>{{ \App\Models\Buku::count() }}</h3>
<p>Total Buku</p>
</div>
</div>

<div class="col-md-3">
<div class="glass-card text-center">
<h3>{{ \App\Models\Pensil::count() }}</h3>
<p>Total Pensil</p>
</div>
</div>

<div class="col-md-3">
<div class="glass-card text-center">
<h3>{{ \App\Models\Pensil::sum('stok') }}</h3>
<p>Total Stok</p>
</div>
</div>

<div class="col-md-3">
<div class="glass-card text-center">
<h3>{{ auth()->user()->name ?? 'User' }}</h3>
<p>User</p>
</div>
</div>

</div>

<div class="row mt-5">

<div class="col-md-6">

<div class="glass-card">

<h5>Recent Buku</h5>

<table class="table text-white">

@foreach(\App\Models\Buku::latest()->take(5)->get() as $b)

<tr>
<td>{{ $b->judul }}</td>
<td>{{ $b->pengarang }}</td>
</tr>

@endforeach

</table>

</div>

</div>

<div class="col-md-6">

<div class="glass-card">

<h5>Recent Pensil</h5>

<table class="table text-white">

@foreach(\App\Models\Pensil::latest()->take(5)->get() as $p)

<tr>
<td>{{ $p->nama }}</td>
<td>{{ $p->warna }}</td>
<td>{{ $p->stok }}</td>
</tr>

<div style="color:yellow;">
User: {{ auth()->user()?->email ?? 'NULL' }} |
Role: {{ auth()->user()?->role ?? 'NULL' }}
</div>

@endforeach

</table>

</div>

</div>

</div>

</div>

</div>

</div>

@endsection