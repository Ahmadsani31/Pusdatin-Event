<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefEvent extends Model
{
    protected $table = 'ref_event';
    protected $fillable = [
        'id',
        'nama_event',
        'jadwal_pelaksanaan_mulai',
        'jadwal_pelaksanaan_selesai',
    ];
    public $timestamps = true;
}
