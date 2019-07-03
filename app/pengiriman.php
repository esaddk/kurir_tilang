<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pengiriman extends Model
{
    protected $fillable = [
        'order_id', 
    ];

    public function order()
    {
        return $this->belongsTo(order::class);
    }
}
