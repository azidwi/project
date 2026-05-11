
@extends('layouts.app')

@section('content')

<section class="hero-section text-center">

<div class="glass-card hero-card mx-auto">

<h1 class="display-4 fw-bold">
One-click for Asset Defense
</h1>

<p class="hero-sub">
Kelola semua aset alat tulis dengan sistem modern.
Buku, Pensil, Stok, dan laporan dalam satu dashboard.
</p>

<div class="mt-4">
<a href="{{ route('dashboard') }}" class="btn btn-glow me-3">
Open Dashboard
</a>

</div>

</div>

</section>


<section class="container mt-5">

<div class="row g-4">

<div class="col-md-4">
<div class="glass-card feature-card">
<h4>Manajemen Buku</h4>
<p>Tambah, edit, dan kelola data buku dengan mudah.</p>
<a href="{{ route('buku.index') }}" class="btn btn-sm btn-glow">Kelola</a>
</div>
</div>

<div class="col-md-4">
<div class="glass-card feature-card">
<h4>Manajemen Pensil</h4>
<p>Kelola stok pensil, warna, dan jumlah.</p>
<a href="{{ route('pensil.index') }}" class="btn btn-sm btn-glow">Kelola</a>
</div>
</div>

<div class="col-md-4">
<div class="glass-card feature-card">
<h4>Statistik Stok</h4>
<p>Pantau jumlah stok alat tulis secara realtime.</p>
<a href="{{ route('dashboard') }}" class="btn btn-sm btn-glow">Lihat</a>
</div>
</div>

</div>

</section>


<section class="container mt-5">

<div class="glass-card text-center p-5">

<h2>Asset Management System</h2>

<p class="hero-sub">
Sistem modern untuk mengelola alat tulis dengan desain futuristik.
Dibuat menggunakan Laravel.
</p>

</div>

</section>

@endsection