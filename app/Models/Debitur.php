<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Debitur extends Model
{
    use HasFactory;

    protected $table = 'debiturs';

    protected $guarded = [
        'id'
    ];

    public $timestamps = false;

    public function dataPembayaran(): HasMany
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function dataTagihan(): HasMany
    {   
        return $this->hasMany(Tagihan::class);
    }
}
