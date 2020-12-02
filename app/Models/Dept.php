<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Dept extends Model
{
    use HasFactory;
    public function leader()
    {
        return $this->belongsTo('App\Models\Staff', 'leader_id');
    }
}
