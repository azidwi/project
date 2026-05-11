@extends('layouts.user')

@section('content')

<div class="text-center mt-10">
<h1 class="text-3xl mb-6">Buku</h1>
</div>

<div class="flex flex-wrap justify-center gap-6">

@foreach($bukus as $buku)
<div class="border border-gray-700 rounded-xl p-5 w-64">

<h5 class="font-semibold">{{ $buku->judul }}</h5>
<p class="text-gray-400">{{ $buku->pengarang }}</p>

</div>
@endforeach

</div>

@endsection