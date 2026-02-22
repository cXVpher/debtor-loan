<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tagihan extends Model
{
    use HasFactory;

    protected $table = 'tagihans';

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal' => 'datetime:d-m-Y',
        'jumlah' => 'integer',
    ];

    public function debitur(): BelongsTo
    {
        return $this->belongsTo(Debitur::class);
    }

    public function dataPembayaran(): HasMany
    {
        return $this->hasMany(Pembayaran::class);
    }
}
