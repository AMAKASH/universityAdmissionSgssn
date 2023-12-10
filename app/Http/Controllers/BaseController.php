<?php

namespace App\Http\Controllers;

use App\Mail\EmailOTP;
use Illuminate\Support\Facades\Mail;
use App\Models\Scholership;
use Illuminate\Http\Request;
use App\Models\University;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class BaseController extends Controller
{
    public function index()
    {

        $top_universities = University::all();
        $scholerships = Scholership::limit(4)->get();

        return view('landing', [
            'top_universities' => $top_universities,
            'scholerships' => $scholerships
        ]);
    }

    public function dashboard()
    {
        $user = auth()->user();

        if ($user->email_verified_at == null) {
            $otp = rand(111111, 999999);
            session(['verify_otp' => $otp]);
            Mail::to($user)->send(new EmailOTP(session('verify_otp')));
            return redirect()->route('email.verify');
        }

        return view('dashboard2', ['user' => $user]);
    }

    public function emailverify_create()
    {
        $user = auth()->user();
        if ($user->email_verified_at != null) {
            return redirect()->route('dashboard');
        }
        return view('verify.create', ['email' => $user->email]);
    }

    public function emailverify_confirm()
    {
        request()->validate([
            'otp' => ['required', 'digits:6'],
        ]);

        if (request('otp') != session('verify_otp')) {
            return back()->withErrors(['otp' => "Invalid OTP. Try Again!!"]);
        } else {
            $user = auth()->user();
            $user->email_verified_at = now();
            $user->save();
            return redirect()->route('dashboard');
        }
    }

    public function upload_image()
    {
        $user = auth()->user();
        if (request()->file('img')->isValid()) {
            //dd(request()->file('img'));
            $img = request()->file('img');
            $return_path = $img->store('img/users', ['disk' => 'public']);
            $user->image_path = $return_path;
            $user->save();
            return redirect()->route('dashboard');
        }
    }

    public function update_info()
    {
        $user = auth()->user();

        $user->name = request('name') ?? $user->name;
        $user->contact = request('contact') ?? $user->contact;
        $user->ssc_group = request('ssc_group') ?? $user->ssc_group;
        $user->ssc_passing_year = request('ssc_year') ?? $user->ssc_passing_year;
        $user->ssc_roll_no = request('ssc_roll') ?? $user->ssc_roll_no;
        $user->ssc_result = request('ssc_result') ?? $user->ssc_result;
        $user->hsc_group = request('hsc_group') ?? $user->hsc_group;
        $user->hsc_passing_year = request('hsc_year') ?? $user->hsc_passing_year;
        $user->hsc_roll_no = request('hsc_roll') ?? $user->hsc_roll_no;
        $user->hsc_result = request('hsc_result') ?? $user->hsc_result;
        $user->address = request('address') ?? $user->address;
        if (request('public_profile') != null) {
            $user->public_profile = true;
        } else {
            $user->public_profile = false;
        }
        $user->save();
        return redirect()->route('dashboard');
    }

    public function reset_user_password_show()
    {
        return view('verify.password-reset');
    }


    public function reset_user_password_commit()
    {
        $user = auth()->user();
        request()->validate(['password' => ['required', 'confirmed', Rules\Password::defaults()],]);
        $user->password = Hash::make(request('password'));
        $user->save();
        return redirect()->route('dashboard')->with('success-msg', 'Password Updated successfully');
    }

    public function cost_calculate()
    {
        $universities = University::all();

        return view('cost-calculate', ['universities' => $universities]);
    }

    public function view_profile(User $user)
    {
        return view('profile.show', ['user' => $user]);
    }
}
