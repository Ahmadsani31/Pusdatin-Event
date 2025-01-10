<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaEvent extends Model
{
    protected $table = 'peserta_event';
    protected $fillable = [
        'id',
        'peserta_id',
        'nama',
        'jenis_kelamin',
        'event_id',
    ];
    public $timestamps = true;

    public function peserta(): BelongsTo
    {
        return $this->belongsTo(PesertaQris::class, 'peserta_id', 'id');
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(RefEvent::class, 'event_id', 'id');
    }
}
