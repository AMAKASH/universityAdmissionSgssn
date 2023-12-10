<?php

namespace App\Http\Controllers;

use App\Models\UniApplication;
use App\Models\University;
use Illuminate\Http\Request;

class UniApplicationController extends Controller
{
    public function create(University $university)
    {
        $user = auth()->user();
        return view('application.create', [
            'university' => $university,
            'user' => $user
        ]);
    }

    public function store(University $university)
    {
        $user = auth()->user();

        request()->validate([
            'major' => ['required', 'numeric'],
            'nid' => ['required', 'numeric',]
        ]);

        $application = new UniApplication();
        $application->user_id = $user->id;
        $application->university_id = $university->id;
        $application->university_major_id  = request('major');
        $application->status = "Pending";
        $application->nid = request('nid');
        $application->admission_decision = "Application Submitted";

        $application->save();
        return redirect()->route('dashboard')->with('success-msg', 'Application submitted successfully');
    }

    public function destroy(UniApplication $application)
    {
        if ($application->user->id != auth()->user()->id) {
            abort(403, 'The Requested resource is not authorised');
        }
        $application->delete();
        return redirect()->route('dashboard')->with('success-msg', 'Application deleted successfully');
    }
}
