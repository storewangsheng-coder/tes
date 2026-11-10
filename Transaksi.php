<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        "id_penyewaan",
        "jumlah",
        "metode_pembayaran",
        "tanggal",
    ];

    // 1 Transaksi dimiliki oleh 1 Penyewaan → One-to-One (inverse)
    public function penyewaan()
    {
        return $this->belongsTo(Penyewaan::class, "id_penyewaan");
    }
}
