<?php

namespace App\Http\Controllers;

use App\Models\Scholership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScholershipController extends Controller
{
    public function index()
    {
        $search_phrase = request()->query('search');
        $search_criteria = request()->query('criteria');



        $search_criterias = [
            "1" => "Name",
            "2" => "Eligibility Criteria",
            "3" => "Deadlines",
            "4" => "Application Requirement",
        ];

        $internal_db_fields = [
            "1" => "name",
            "2" => "criteria",
            "4" => "requirements"
        ];

        if ($search_phrase != null && $search_phrase != "" && $search_criteria != 3) {
            $scholerships = Scholership::where($internal_db_fields[$search_criteria], 'LIKE', '%' . $search_phrase . '%')->get();
            //dd($universities);
        } else {
            $scholerships = Scholership::all();
        }

        if ($search_criteria == 3) {
            $scholerships = $this->filter_based_deadline($scholerships, $search_phrase);
        }

        return view('scholership.index', [
            "scholerships" => $scholerships,
            "search_criterias" => $search_criterias,
        ]);
    }

    public function filter_based_deadline($scholerships, $search_phrase)
    {
        $filtered_scholerships = [];

        foreach ($scholerships as $scholership) {
            //dd(date("y-m-d", strtotime($search_phrase)), date("y-m-d", strtotime($scholership->deadline)), date("y-m-d", strtotime($search_phrase)) <= date("y-m-d", strtotime($scholership->deadline)));
            if (strtotime($search_phrase) <= strtotime($scholership->deadline)) {
                array_push($filtered_scholerships, $scholership);
            }
        }

        return $filtered_scholerships;
    }

    public function show(Scholership $scholership)
    {
        return view('scholership.show', [
            "scholership" => $scholership,

        ]);
    }

    public function track(Scholership $scholership)
    {
        $user = auth()->user();
        foreach ($user->scholerships as $user_scholership) {
            if ($user_scholership->id == $scholership->id) {
                return redirect()->route('dashboard')->with('success-msg', 'Scholership is already tracked');
            }
        }
        $user->scholerships()->attach($scholership->id);
        return redirect()->route('dashboard')->with('success-msg', 'Scholership is being tracked');
    }

    public function untrack(Scholership $scholership)
    {
        $user = auth()->user();
        $user->scholerships()->detach($scholership->id);
        return redirect()->route('dashboard')->with('success-msg', 'Scholership untracked');
    }
}
