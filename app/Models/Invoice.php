<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //
    protected $fillable = ['invoice_number', 'items', 'delivery_address', 'postal_code', 'total_amount'];

    protected $casts = [
        'items' => 'array',
    ];
}
