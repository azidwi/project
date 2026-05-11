@extends('layouts.app')

@section('content')

<div class="glow"></div>

<nav class="navbar-custom d-flex justify-content-between align-items-center">
    <div><strong>MyApp</strong></div>
    <div>
        <a href="{{ route('dashboard') }}">Home</a>
        <a href="{{ route('buku.index') }}">Buku</a>
        <a href="{{ route('pensil.index') }}">Pensil</a>
        <a href="{{ route('profile') }}">Profile</a>
    </div>
    <div>
        <a href="{{ route('login') }}">Logout</a>
    </div>
    <form action="{{ route('search') }}" method="GET" class="d-flex">
<input type="text" name="q" class="form-control me-2" placeholder="Search buku atau pensil">
<button class="btn btn-glow">Search</button>
</form>
</nav>


<div class="glass-card mx-auto" style="max-width:600px;">

    <h2 class="mb-4">Tambah Pensil</h2>

    <form action="{{ route('pensil.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <input type="text" name="nama" class="form-control" placeholder="Nama Pensil">
        </div>

        <div class="mb-3">
            <input type="text" name="warna" class="form-control" placeholder="Warna">
        </div>

        <div class="mb-3">
            <input type="number" name="stok" class="form-control" placeholder="Stok">
        </div>

        <button type="submit" class="btn btn-glow w-100">
            Simpan
        </button>

    </form>

</div>

@endsection