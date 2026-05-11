<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = [
    'judul',
    'penerbit',
    'pengarang',
    'tahun_terbit',
    'gambar_buku'
];
}