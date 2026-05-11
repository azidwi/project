<form method="POST" action="{{ route('buku.update',$buku->id) }}">
@csrf
@method('PUT')
<input name="judul" value="{{ $buku->judul }}" class="form-control mb-2">
<input name="penulis" value="{{ $buku->penulis }}" class="form-control mb-2">
<input name="tahun" value="{{ $buku->tahun }}" class="form-control mb-2">
<button class="btn btn-primary">Update</button>
</form>