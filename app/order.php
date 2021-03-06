<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $fillable = [
        'kode_order','alamat', 'penerima', 'nomor_hp',
        'customer_id','admin_id','kurir_id','biaya_kirim','foto','status_data',
        'pengiriman_id',

    ];

    public function pengiriman()
    {
        return $this->belongsTo(pengiriman::class);
    }
}
