<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function reviews()
    {
        return $this->hasMany(UniversityReview::class);
    }

    public function majors()
    {
        return $this->hasMany(UniversityMajor::class);
    }

    public function scholerships()
    {
        return $this->hasMany(Scholership::class);
    }
}
