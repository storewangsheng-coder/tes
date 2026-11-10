<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    protected $fillable = [
        "id_pemilik",
        "merk",
        "tipe_cc",
        "no_plat",
        "photo",
        "dokumen_kepemilikan",
        "status",
    ]; //

    // BANYAK Motor dimiliki oleh 1 User (pemilik) → Many-to-One
    public function pemilik()
    {
        return $this->belongsTo(User::class, "id_pemilik");
    }

    // 1 Motor memiliki 1 TarifRental → One-to-One
    public function tarifRental()
    {
        return $this->hasOne(TarifRental::class, "id_motor");
    }

    // 1 Motor bisa memiliki BANYAK Penyewaan → One-to-Many
    public function penyewaans()
    {
        return $this->hasMany(Penyewaan::class, "id_motor");
    }
}
