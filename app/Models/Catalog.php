<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'price', 'quantity', 'image'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
}
