@extends('layouts.user')

@section('content')

<div class="min-h-[80vh] flex flex-col justify-center items-center">

<h1 class="text-3xl mb-8">Dashboard</h1>

<div class="flex gap-6">

<div class="border border-gray-700 rounded-xl p-6 text-center">
<h2 class="text-2xl">{{ $totalBuku }}</h2>
<p class="text-gray-400">Buku</p>
</div>

<div class="border border-gray-700 rounded-xl p-6 text-center">
<h2 class="text-2xl">{{ $totalPensil }}</h2>
<p class="text-gray-400">Pensil</p>
</div>

</div>

</div>

@endsection