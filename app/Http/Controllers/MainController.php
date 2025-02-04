<?php

namespace App\Http\Controllers;

use App\Models\Others;
use App\Models\PersonalInfo;
use App\Models\ProfessionalInfo;
use App\Models\SignIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\Mails;
use App\Mail\SendMail;
use App\Models\Districts;
use App\Models\OfficialUse;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    
    // Display Dashboard Page Function
    public function dashboard() {
        $data = array();
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }

        $forms = DB::table('personal_infos')
        -> join('professional_infos', 'personal_infos.id', '=', 'professional_infos.personal_id')
        -> join('others', 'personal_infos.id', '=', 'others.personal_id')
        -> count();

        $registered = DB::table('personal_infos')
        -> join('professional_infos', 'personal_infos.id', '=', 'professional_infos.personal_id')
        -> join('others', 'personal_infos.id', '=', 'others.personal_id')
        -> where('others.status', "Submitted")
        -> count();

        $pending = DB::table('personal_infos')
        -> join('professional_infos', 'personal_infos.id', '=', 'professional_infos.personal_id')
        -> join('others', 'personal_infos.id', '=', 'others.personal_id')
        -> where('others.status', "Pending")
        -> count();

        $approve = DB::table('personal_infos')
        -> join('professional_infos', 'personal_infos.id', '=', 'professional_infos.personal_id')
        -> join('others', 'personal_infos.id', '=', 'others.personal_id')
        -> where('others.status', "Approved")
        -> count();

        return view('pages.dashboard', compact( 'data', 'forms', 'registered', 'pending', 'approve'));
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
        // -> join('official_uses', 'personal_infos.id', '=', 'official_uses.personal_id')
        -> where('personal_infos.id', $id)
        -> get();

        // dd($viewOfficer);
        return view('pages.view', compact('viewOfficer', 'data'));
    }

    // Delete Officers Function
    public function deleteOfficer($id) { 
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
        -> join('official_uses', 'personal_infos.id', '=', 'official_uses.personal_id')
        -> where('personal_infos.id', $id)
        -> get();

        return view('pages.approve', compact('approveOfficer', 'data'));
    }

    // Update Approve Data Function
    public function postApproveOfficer(Request $request, $id) {

        $validatedData = $request->validate([
            'official_id' => 'required|string',
            'secretary' => 'required|string|max:255',
            'chairman' => 'required|string|max:255',
            'treasury' => 'required|string|max:255',
            'repoag_no' => 'required|string|max:255'
        ]);

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

                $officialUse = new OfficialUse();

                    $officialUse -> fill([
                        'personal_id' => $validatedData['official_id'],
                        'secretary' => $validatedData['secretary'],
                        'chairman' => $validatedData['chairman'],
                        'treasury' => $validatedData['treasury'],
                        'repoag_no' => $validatedData['repoag_no']
                    ]);

                    $officialUse -> save();



                if ($request->input('status') === "Approved") {
                    $personalInfo = PersonalInfo::findOrFail($id);

                    // Send email
                    Mail::to($personalInfo -> email)->send(new SendMail($personalInfo));
            
                    return redirect('/officers')->with('success', 'Officer approved and email sent successfully.');
                }
            return redirect('/officers');
    }

    // Generate Report Function
    public function report(Request $request) {
        $data = array();
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }
    
        $serviceId = PersonalInfo::select('prison_svc_no')->distinct()->get();
        $rankName = ProfessionalInfo::select('rank_of_retirement')->distinct()->get();
    
        $genderInput = $request->input('gender');
        $region = $request->input('region');
        $rank = $request->input('rank');
        // $age = $request->input('age');
        $year = $request->input('year');
        $statInput = $request -> input('stat');
    
        $query = DB::table('personal_infos')
            ->join('professional_infos', 'personal_infos.id', '=', 'professional_infos.personal_id')
            ->join('others', 'personal_infos.id', '=', 'others.personal_id')

            ->when($region, function($query, $region) {
                return $query->where('branch', 'LIKE', "%{$region}%");
            })
            ->when($rank, function($query, $rank) {
                return $query->orWhere('rank_of_retirement', 'LIKE', "%{$rank}%");
            })
            ->when($genderInput, function($query, $genderInput) {
                return $query->orWhere('sex', 'LIKE', "%{$genderInput}%");
            })
            // ->when($genderInput, function ($query, $genderInput) {
            //     return $query->orWhere('sex', '=', strtolower($genderInput) === 'female' ? 'Female' : 'Male');
            // })
            ->when($year, function($query, $year) {
                return $query->orWhereRaw("YEAR(date_of_retirement) = ?", [$year]);
            })
            // ->when($age, function($query, $age) {
            //     return $query->orWhereBetween('present_age', [$age, $age + 10]);
            // })
            // ->when($statInput, function ($query, $statInput) {
            //     return $query->orWhere('stat', '=', strtolower($statInput) === 'dead' ? 'Dead' : 'Alive');
            // })
            ->when($statInput, function($query, $statInput) {
                return $query->orWhere('stat', 'LIKE', "%{$statInput}%");
            })
            ->get();
    
        return view('pages.report', compact('data', 'serviceId', 'rankName', 'query'));
    }
    

    // Display Regions & District Page Function
    public function region() {
        $data = array();
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }

        $region = Districts::all();

        return view('pages.region', compact('data', 'region'));
    }

    // Display Add Region Page Function
    public function addRegion() {
        $data = array();
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }
        return view('pages.add-region', compact('data'));
    }

    // Add Region Function
    public function postAddRegion(Request $request) {

        $validatedData = $request -> validate([
            'region' => 'required|string',
            'district' => 'required|string'
        ]);

        $region = new Districts();

        $region -> fill([
            'region' => $validatedData['region'],
            'district' => $validatedData['district']
        ]);

        $region -> save();

        return redirect('/region') -> with('success', 'Data Added Successfully');
    }

    // Display Region Edit Page Function
    public function editRegion($id) {
        $data = array();
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }

        $region = Districts::findOrFail($id);

        return view('pages.edit-region', compact('data', 'region'));
    }

    // Save Edit Region Function
    public function postEditRegion(Request $request, $id) {
        $validatedData = $request -> validate([
            'region' => 'required|string',
            'district' => 'required|string'
        ]);

        $region = Districts::findOrFail($id);

        $region -> fill([
            'region' => $validatedData['region'],
            'district' => $validatedData['district']
        ]);

        $region -> update();
        return redirect('/region') -> with('success', 'Data Updated Successfully');

    }

    public function deleteRegion($id) {
        $region = Districts::findOrFail($id);

        $region -> delete();
        return redirect('/region') -> with('Data Deleted Successfully');
    }
    
}