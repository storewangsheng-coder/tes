<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TarifRental extends Model
{
    protected $fillable = [
        "id_motor",
        "tarif_harian",
        "tarif_mingguan",
        "tarif_bulanan",
    ];

    // 1 TarifRental dimiliki oleh 1 Motor → One-to-One (inverse)
    public function motor()
    {
        return $this->belongsTo(Motor::class, "id_motor");
    }

    // 1 TarifRental (tipe durasi) bisa dipakai di BANYAK Penyewaan → One-to-Many
    public function penyewaans()
    {
        return $this->hasMany(Penyewaan::class, "id_tipe_durasi");
    }
}
