<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityMajor extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function University()
    {
        return $this->belongsTo(University::class);
    }

    public function major()
    {
        $major = $this->belongsTo(Major::class);
        return $major;
    }
}
