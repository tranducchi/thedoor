<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HirePage extends Model
{
    use HasFactory;
    public function service(){
        return $this->belongsTo('App\Models\Service', 'service_id');
    }
}
