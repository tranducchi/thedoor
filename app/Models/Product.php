<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    use HasFactory;
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'id_customer');
    }
    public function service()
    {
        return $this->belongsTo('App\Models\Service', 'id_service');
    }
    public function details(){
        return $this->hasMany('App\Models\DetailProduct','id_product');
    }
    public function test(){
         return $this->hasManyThrough('App\Models\Customer', 'App\Models\DetailProduct');
    }
}
