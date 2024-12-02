<?php

namespace App\Http\Controllers;

use App\Models\Others;
use App\Models\PersonalInfo;
use App\Models\ProfessionalInfo;
use App\Models\RegistrationForm;
use App\Models\SignIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\Mails;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    
    // Display Dashboard Page Function
    public function dashboard() {
        $data = array();
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }

        // $forms = RegistrationForm::all() -> count();
        // $registered = RegistrationForm::where('status', 'Submitted') -> count();
        // $pending = RegistrationForm::where('status', 'Pending') -> count();
        // $approve = RegistrationForm::where('status', 'Approved') -> count();
        return view('pages.dashboard', compact( 'data'));
    }

    public function preview() {
        return view('pages.preview');
    }

    // View All Officers Page Function
    public function officer() {
        $data = array();
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }

        $officers = DB::table('personal_infos')
        -> join('others', 'personal_infos.id', '=', 'others.personal_id')
        -> get();

        return view('pages.officers', compact('officers', 'data'));
    }

    // View Specified Officer Page Function
    public function viewOfficer($id) {
        $data = array();
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }

        $viewOfficer = DB::table('personal_infos')
        -> join('professional_infos', 'personal_infos.id', '=', 'professional_infos.personal_id')
        -> join('others', 'personal_infos.id', '=', 'others.personal_id')
        -> where('personal_infos.id', $id)
        -> get();

        // dd($viewOfficer);
        return view('pages.view', compact('viewOfficer', 'data'));
    }

    // Delete Officers Function
    public function deleteOfficer($id) {
        // $deleteOfficer = RegistrationForm::findOrFail($id);

        // $deleteOfficer = DB::table('personal_infos')
        // -> join('professional_infos', 'personal_infos.id', '=', 'professional_infos.personal_id')
        // -> join('others', 'personal_infos.id', '=', 'others.personal_id')
        // -> where('personal_infos.id', $id)
        // -> get();

        // $deleteOfficer -> delete();

        DB::table('personal_infos') -> where('id', $id) -> delete();
        DB::table('professional_infos') -> where('personal_id', $id) -> delete();
        DB::table('others') -> where('personal_id', $id) -> delete();

        return redirect('/officers') -> with('success', 'Data Successfully Deleted');
    }

    // Display Approve Page Function
    public function approveOfficer($id) {
        $data = array();
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }

        $approveOfficer = DB::table('personal_infos')
        -> join('professional_infos', 'personal_infos.id', '=', 'professional_infos.personal_id')
        -> join('others', 'personal_infos.id', '=', 'others.personal_id')
        -> where('personal_infos.id', $id)
        -> get();

        return view('pages.approve', compact('approveOfficer', 'data'));
    }

    // Update Approve Data Function
    public function postApproveOfficer(Request $request, $id) {
        PersonalInfo::where('id', $id)
            -> update([
                'full_name' => $request -> input('full_name'),
                'govt_pension_no' => $request -> input('govt_pension_no'),
                'prison_svc_no' => $request -> input('prison_svc_no'),
                'residential_address' => $request -> input('residential_address'),
                'postal_address' => $request -> input('postal_address'),
                'telephone' => $request -> input('telephone'),
                'ghana_card_no' => $request -> input('ghana_card_no'),
                'sex' => $request -> input('sex'),
                'present_age' => $request -> input('present_age'),
                'hometown' => $request -> input('hometown'),
                'present_place_of_residence' => $request -> input('present_place_of_residence'),
                'marital_status' => $request -> input('marital_status'),
                'email' => $request -> input('email'),
            ]);

            ProfessionalInfo::where('personal_id', $id)
                -> update([
                    'date_of_enlistment' => $request -> input('date_of_enlistment'),
                    'date_of_retirement' => $request -> input('date_of_retirement'),
                    'rank_of_retirement' => $request -> input('rank_of_retirement'),
                    'station_retired' => $request -> input('station_retired'),
                    'branch' => $request -> input('branch'),
                    'where_to_attend_meeting' => $request -> input('where_to_attend_meeting'),
            ]);

            Others::where('personal_id', $id)
                -> update([
                    'present_occupation' => $request -> input('present_occupation'),
                    'next_of_kin' => $request -> input('next_of_kin'),
                    'member_signature' => $request -> input('member_signature'),
                    'status' => $request -> input('status'),
                ]);

                if ($request->input('status') === "Approved") {
                    $personalInfo = PersonalInfo::findOrFail($id);
            
                    // Send email
                    Mail::to($personalInfo -> email)->send(new SendMail($personalInfo));
            
                    return redirect('/officers')->with('success', 'Officer approved and email sent successfully.');
                }
            return redirect('/officers');
    }
}