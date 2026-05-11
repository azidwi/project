@extends('layouts.user')

@section('content')

<div class="min-h-[80vh] flex justify-center items-center">

<div class="border border-gray-700 rounded-2xl p-8 w-80 text-center backdrop-blur">

<!-- FOTO -->
@if(auth()->user()->foto)
<img src="{{ asset('storage/'.auth()->user()->foto) }}"
     class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
@else
<img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}"
     class="w-24 h-24 rounded-full mx-auto mb-4">
@endif

<h3 class="text-xl">{{ auth()->user()->name }}</h3>
<p class="text-gray-400">{{ auth()->user()->email }}</p>

<span class="text-sm text-gray-500 block mb-4">
{{ auth()->user()->role }}
</span>

<!-- UPLOAD FOTO -->
<form action="{{ route('profile.photo') }}" method="POST" enctype="multipart/form-data">
@csrf
<input type="file" name="foto" class="text-sm mb-2">
<button class="bg-white text-black px-4 py-1 rounded-full text-sm">
Upload
</button>
</form>

<hr class="my-4 border-gray-700">

<!-- TOGGLE PASSWORD -->
<button onclick="togglePass()" class="border border-gray-600 px-4 py-1 rounded-full text-sm">
Ubah Password
</button>

<div id="passForm" class="mt-4 hidden">

<form action="{{ route('profile.password') }}" method="POST">
@csrf

<input type="password" name="current_password"
class="w-full mb-2 p-2 bg-black border border-gray-700 rounded"
placeholder="Password Lama">

<input type="password" name="new_password"
class="w-full mb-2 p-2 bg-black border border-gray-700 rounded"
placeholder="Password Baru">

<input type="password" name="confirm_password"
class="w-full mb-2 p-2 bg-black border border-gray-700 rounded"
placeholder="Konfirmasi">

<button class="bg-white text-black w-full py-2 rounded">
Simpan
</button>

</form>

</div>

</div>

</div>

<script>
function togglePass(){
    document.getElementById('passForm').classList.toggle('hidden')
}
</script>

@endsection