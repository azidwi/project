@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto bg-gray-800 p-6 rounded-2xl shadow">
    <h2 class="text-2xl font-bold mb-6">Edit Pensil</h2>

    <form action="{{ route('pensil.update',$pensil->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" name="nama" value="{{ $pensil->nama }}"
               class="w-full bg-gray-700 p-3 rounded-lg mb-4">

        <input type="text" name="warna" value="{{ $pensil->warna }}"
               class="w-full bg-gray-700 p-3 rounded-lg mb-4">

        <input type="text" name="stok" value="{{ $pensil->stok }}"
               class="w-full bg-gray-700 p-3 rounded-lg mb-4">

        <button class="w-full bg-blue-600 p-3 rounded-lg">
            Update
        </button>
    </form>
</div>
@endsection