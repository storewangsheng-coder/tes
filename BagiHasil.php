<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BagiHasil extends Model
{
    protected $fillable = [
        "id_penyewaan",
        "bagi_hasil_pemilik",
        "bagi_hasil_admin",
        "settled_at",
    ];

    // 1 BagiHasil dimiliki oleh 1 Penyewaan → One-to-One (inverse)
    public function penyewaan()
    {
        return $this->belongsTo(Penyewaan::class, "id_penyewaan");
    }
}
