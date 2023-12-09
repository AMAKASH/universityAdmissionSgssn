<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholership extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
