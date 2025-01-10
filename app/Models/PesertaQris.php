<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaQris extends Model
{
    protected $table = 'peserta_qris';
    protected $fillable = [
        'id',
        'nama_pemilik_qris',
        'nama_usaha',
        'verified',
    ];
    public $timestamps = true;
}
