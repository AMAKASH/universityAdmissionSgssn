<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Models\UniversityMajor;
use Illuminate\Http\Request;

class UniversityMajorController extends Controller
{
    public function get_majors_by_university(University $university)
    {
        $majors = [];

        foreach ($university->majors as $uni_major) {
            $major = [$uni_major->id, $uni_major->major->name];
            array_push($majors, $major);
        }

        return response()->json(['majors' => $majors]);
    }

    public function get_data_by_major(UniversityMajor $major)
    {



        return response()->json([
            'total_credit' => $major->total_credit,
            'credit_fee' => $major->credit_fee
        ]);
    }
}
