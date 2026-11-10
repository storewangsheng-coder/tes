<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    protected $fillable = [
        "id_penyewa",
        "id_motor",
        "tanggal_mulai",
        "tanggal_selesai",
        "id_tipe_durasi",
        "harga",
        "status",
    ];

    // BANYAK Penyewaan dilakukan oleh 1 User (penyewa) → Many-to-One
    public function penyewa()
    {
        return $this->belongsTo(User::class, "id_penyewa");
    }

    // BANYAK Penyewaan mengacu pada 1 Motor → Many-to-One
    public function motor()
    {
        return $this->belongsTo(Motor::class, "id_motor");
    }

    // BANYAK Penyewaan menggunakan 1 TarifRental → Many-to-One
    public function tarifRental()
    {
        return $this->belongsTo(TarifRental::class, "id_tipe_durasi");
    }

    // 1 Penyewaan memiliki 1 Transaksi → One-to-One
    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, "id_penyewaan");
    }

    // 1 Penyewaan memiliki 1 BagiHasil → One-to-One
    public function bagiHasil()
    {
        return $this->hasOne(BagiHasil::class, "id_penyewaan");
    }
}
