<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function index()
    {


        $search_phrase = request()->query('search');
        $search_criteria = request()->query('criteria');



        $search_criterias = [
            "1" => "Name",
            "2" => "Location",
            "3" => "Major",
            "4" => "Admission Requirement",
        ];

        $internal_db_fields = [
            "1" => "name",
            "2" => "address",
        ];

        if ($search_phrase != null && $search_phrase != "" && $search_criteria != 3 && $search_criteria != 4) {
            $universities = University::where($internal_db_fields[$search_criteria], 'LIKE', '%' . $search_phrase . '%')->get();
            //dd($universities);
        } else {
            $universities = University::all();
        }

        if ($search_criteria == 3) {
            $universities = $this->filter_based_major($universities, $search_phrase);
        }
        if ($search_criteria == 4) {
            $universities = $this->filter_based_req($universities, $search_phrase);
        }

        return view('university.index', [
            'universities' => $universities,
            "search_criterias" => $search_criterias
        ]);
    }

    public function filter_based_major($universities, $search_phrase)
    {
        $filtered_university = [];

        foreach ($universities as $university) {
            foreach ($university->majors as $unimajor) {
                //dd($unimajor->major->name);
                if (str_contains(strtolower($unimajor->major->name), strtolower($search_phrase))) {
                    array_push($filtered_university, $university);
                    break;
                }
            }
        }

        return $filtered_university;
    }

    public function filter_based_req($universities, $search_phrase)
    {
        $filtered_university = [];

        foreach ($universities as $university) {
            foreach ($university->majors as $major) {
                if (str_contains(strtolower($major->application_requirements), strtolower($search_phrase))) {
                    array_push($filtered_university, $university);
                    break;
                }
            }
        }

        return $filtered_university;
    }

    public function show(University $university)
    {
        //dd($university);
        return view('university.show', ['university' => $university]);
    }
}
