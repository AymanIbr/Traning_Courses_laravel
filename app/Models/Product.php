<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $guarded = [];
    use HasFactory;

    public function store(){
        return $this->belongsTo(Store::class);
    }
    public function purchases(){
        return $this->hasMany(Purchase::class);
    }
}
