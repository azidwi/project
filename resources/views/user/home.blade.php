@extends('layouts.user')

@section('content')

<div class="min-h-[80vh] flex flex-col justify-center items-center text-center">

<h1 class="text-5xl font-bold leading-tight">
All your AI,<br>unified in one system.
</h1>

<p class="text-gray-400 mt-4 max-w-xl">
Kelola buku dan pensil dalam satu tempat dengan tampilan clean.
</p>

<div class="mt-6 flex gap-4">
<a href="/user/buku" class="bg-white text-black px-6 py-2 rounded-full">
Start
</a>

<a href="/user/dashboard" class="border border-gray-600 px-6 py-2 rounded-full">
Dashboard
</a>
</div>

</div>

@endsection