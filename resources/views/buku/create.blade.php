@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="glass-card mx-auto" style="max-width:600px;">

        <h2 class="mb-4">Tambah Buku</h2>

        <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <input type="text" name="judul" class="form-control" placeholder="Judul Buku">
            </div>

            <div class="mb-3">
                <input type="text" name="penerbit" class="form-control" placeholder="Penerbit">
            </div>

            <div class="mb-3">
                <input type="text" name="pengarang" class="form-control" placeholder="Pengarang">
            </div>

            <div class="mb-3">
                <input type="text" name="tahun_terbit" class="form-control" placeholder="Tahun Terbit">
            </div>

            <!-- UPLOAD FOTO -->
            <div class="mb-3">

                <label class="form-label text-light mb-2">
                    Upload Cover Buku
                </label>

                <input type="file"
                       name="gambar_buku"
                       class="form-control"
                       accept="image/*">

            </div>

            <button type="submit" class="btn btn-glow w-100">
                Simpan Buku
            </button>

        </form>

    </div>
</div>

@endsection