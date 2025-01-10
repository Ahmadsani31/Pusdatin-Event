<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrisTransaction extends Model
{
    protected $table = 'qris_transaction';
    protected $fillable = [
        'id',
        'peserta_id',
        'tanggal_transaksi',
        'nama_produk',
        'nominal',
    ];
    public $timestamps = true;

    public function peserta(): BelongsTo
    {
        return $this->belongsTo(PesertaQris::class, 'peserta_id', 'id');
    }
}
