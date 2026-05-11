@extends('layouts.app')

@section('content')

<div class="glass-card mx-auto text-center" style="max-width:700px;">

<h2 class="mb-4">Profile</h2>

<form action="{{ route('profile.photo') }}" method="POST" enctype="multipart/form-data" class="text-center">
@csrf

<!-- FOTO -->
<div class="mb-3">
    @if(auth()->user()->foto)
    <img src="{{ asset('storage/' . auth()->user()->foto) }}"
         class="rounded-circle"
         width="120" height="120">
    @else
    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}"
         class="rounded-circle"
         width="120" height="120">
    @endif
</div>

<!-- INPUT -->
<input type="file" id="fotoInput" name="foto" hidden
       accept="image/*" capture="camera"
       onchange="this.form.submit()">

<!-- BUTTON -->
<button type="button" class="btn btn-glow d-block mx-auto"
        onclick="document.getElementById('fotoInput').click()">
    Upload Foto
</button>

</form>

<h4 class="mt-3">{{ auth()->user()->name }}</h4>
<p>{{ auth()->user()->email }}</p>

@if(auth()->user()->role === 'admin')
<span class="badge bg-danger">Admin</span>
@else
<span class="badge bg-primary">User</span>
@endif

<hr>

<!-- BUTTON TOGGLE PASSWORD -->
<button class="btn btn-warning mb-3" onclick="togglePassword()">
Ubah Password
</button>

<!-- FORM PASSWORD (HIDDEN) -->
<div id="passwordForm" style="display:none;">

<form action="{{ route('profile.password') }}" method="POST">
@csrf

<input type="password" name="current_password" class="form-control mb-2" placeholder="Password Lama">
<input type="password" name="new_password" class="form-control mb-2" placeholder="Password Baru">
<input type="password" name="confirm_password" class="form-control mb-2" placeholder="Konfirmasi Password">

<button class="btn btn-glow w-100">Simpan</button>

</form>

</div>

<div class="mt-4">
<a href="{{ route('dashboard') }}" class="btn btn-outline-light">Dashboard</a>
</div>

</div>

<script>
function togglePassword(){
    let form = document.getElementById('passwordForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
</script>

@endsection