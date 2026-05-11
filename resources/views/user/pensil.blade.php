@extends('layouts.user')

@section('content')

<div class="text-center mt-10">
<h1 class="text-3xl mb-6">Pensil</h1>
</div>

<div class="flex flex-wrap justify-center gap-6">

@foreach($pensils as $pensil)
<div class="border border-gray-700 rounded-xl p-5 w-64">

<h5 class="font-semibold">{{ $pensil->nama }}</h5>
<p class="text-gray-400">Warna: {{ $pensil->warna }}</p>
<p>Stok: {{ $pensil->stok }}</p>

</div>
@endforeach

</div>

@endsection