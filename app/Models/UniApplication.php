<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniApplication extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function university_major()
    {
        return $this->belongsTo(UniversityMajor::class, 'university_major_id', 'id', 'university_majors');
        //dd($major->university_major);
    }
}
