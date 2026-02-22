<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'tanggal' => 'datetime:d-m-Y'
    ];

    public function tagihan(): BelongsTo 
    {
        return $this->belongsTo(Debitur::class);
    }

}
