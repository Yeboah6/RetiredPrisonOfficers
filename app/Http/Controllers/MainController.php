<?php

namespace App\Http\Controllers;

use PDF; // Using Laravel-DOMPDF
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
use App\Models\UserLoginLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    
    // Display Dashboard Page Function
    public function dashboard() {
        $data = [];
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }

        $regions = Districts::all() -> count();

        $registered = DB::table('personal_infos')
        -> join('professional_infos', 'personal_infos.id', '=', 'professional_infos.personal_id')
        -> join('others', 'personal_infos.id', '=', 'others.personal_id')
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

        return view('pages.dashboard', compact( 'data', 'regions', 'registered', 'pending', 'approve'));
    }

    public function superAdmin() {
        $data = [];
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }

        $regions = Districts::all() -> count();
        $users = SignIn::where('role', 'regional_admin') -> count();

        $registered = DB::table('personal_infos')
        -> join('professional_infos', 'personal_infos.id', '=', 'professional_infos.personal_id')
        -> join('others', 'personal_infos.id', '=', 'others.personal_id')
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

        return view('pages.admin.superior-admin', compact('data', 'registered', 'users', 'pending', 'approve', 'regions'));
    }

    public function manageUsers() {
        $data = [];
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }

        $users = SignIn::where('id', '!=', 1)->get();

        return view('pages.admin.users', compact('data', 'users'));
    }

    public function editUsers($id) {
        $data = [];
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }

        $editUser = SignIn::findOrFail($id);
        $region = Districts::all();

        return view('pages.admin.edit-user', compact('editUser', 'data', 'region'));
    }

    public function postEditUsers(Request $request, $id) {
        $validatedData = $request -> validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|min:8|max:12',
            'region' => 'required|string',
            'role' => 'required|string',
            'status' => 'required|string'
        ]);

        $editUser = SignIn::findOrFail($id);

        $editUser -> fill([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'region' => $validatedData['region'],
            'role' => $validatedData['role'],
            'status' => $validatedData['status'],
        ]);

        // Only update password if provided
        if ($request -> filled('password')) {
            $editUser -> password = Hash::make($request -> password);
        }

        $editUser -> update();
        return redirect('/super-admin/users') -> with('success', 'User Data Updated Successfully');
    }

    public function deleteUsers($id) {
        $deleteUser = SignIn::findOrFail($id);

        $deleteUser -> delete();
        return redirect('/super-admin/users') -> with('success', 'User Data Deleted Successfully');
    }

    public function addUsers() {
        $data = [];
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }

        $region = Districts::all();

        return view('pages.admin.add-user', compact('data', 'region'));
    }

    public function postAddUsers(Request $request) {
        $validatedData = $request -> validate([
            'name' => 'required|string|unique:sign_ins',
            'email' => 'required|email|unique:sign_ins',
            'password' => 'required|min:8|max:12',
            'region' => 'required|string',
            'role' => 'required|string',
            'status' => 'required|string'
        ]);

        $addUser = new SignIn();

        $addUser -> fill([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'region' => $validatedData['region'],
            'role' => $validatedData['role'],
            'status' => $validatedData['status'],
        ]);

        $addUser -> save();
        return redirect('/super-admin/users') -> with('success', 'User Added Successfully');
    }

    public function getUserLogs(Request $request) {
        $data = [];
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }

    // Only super admin can access this
    if (session('userRole') !== 'super_admin') {
        return redirect('/unauthorized');
    }
    
    $logs = DB::table('user_login_logs')
        ->join('sign_ins', 'user_login_logs.user_id', '=', 'sign_ins.id')
        ->select(
            'sign_ins.name',
            'sign_ins.email',
            'sign_ins.role',
            'user_login_logs.login_time',
            'user_login_logs.ip_address',
            'user_login_logs.user_agent'
        )
        ->orderBy('user_login_logs.login_time', 'desc')
        ->paginate(20);
    
    return view('pages.admin.user-logs', compact('logs', 'data'));
}

    public function preview() {
        return view('pages.preview');
    }

    // View All Officers Page Function
    public function officer() {
        $data = [];
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }

        $officers = DB::table('personal_infos')
        -> join('professional_infos', 'personal_infos.id', '=', 'professional_infos.personal_id')
        -> join('others', 'personal_infos.id', '=', 'others.personal_id')
        -> select('personal_infos.id as personal_id', 'personal_infos.*', 'professional_infos.*', 'others.*')
        -> get();

        return view('pages.officers', compact('officers', 'data'));
    }

    // View Specified Officer Page Function

    public function viewOfficer($id) {
        $data = [];
        if (Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId'))->first();
        }
    
        // Retrieve personal info
        $personalInfo = DB::table('personal_infos')->where('id', $id)->first();
    
        if (!$personalInfo) {
            return redirect()->back()->with('error', 'Personal info not found.');
        }
    
        // Retrieve officer details, allowing for cases where official_uses may not exist
        $viewOfficer = DB::table('personal_infos')
            -> leftJoin('professional_infos', 'personal_infos.id', '=', 'professional_infos.personal_id')
            -> leftJoin('others', 'personal_infos.id', '=', 'others.personal_id')
            -> where('personal_infos.id', $id)
            -> get();
    
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
        $data = [];
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }

        $approveOfficer = DB::table('personal_infos')
        -> join('professional_infos', 'personal_infos.id', '=', 'professional_infos.personal_id')
        -> join('others', 'personal_infos.id', '=', 'others.personal_id')
        -> where('personal_infos.id', $id)
        -> get();

        $district = Districts::all();
        $region = Districts::select('region') -> distinct() -> get();

        return view('pages.approve', compact('approveOfficer', 'data', 'district', 'region'));
    }

    // SEND TO KETSI
    // Update Approve Data Function
    public function postApproveOfficer(Request $request, $id) {
        $validatedData = $request->validate([
            'official_id' => 'required|string',
            'secretary' => 'required|string|max:255',
            'chairman' => 'required|string|max:255',
            'treasury' => 'required|string|max:255',
            'repoag_no' => 'required|string|max:255'
        ]);
    
        $personalInfoUpdate = array_filter([
            'full_name' => $request->input('full_name'),
            'govt_pension_no' => $request->input('govt_pension_no'),
            'prison_svc_no' => $request->input('prison_svc_no'),
            'residential_address' => $request->input('residential_address'),
            'postal_address' => $request->input('postal_address'),
            'telephone' => $request->input('telephone'),
            'ghana_card_no' => $request->input('ghana_card_no'),
            'sex' => $request->input('sex'),
            'present_age' => $request->input('present_age'),
            'hometown' => $request->input('hometown'),
            'present_place_of_residence' => $request->input('present_place_of_residence'),
            'marital_status' => $request->input('marital_status'),
            'email' => $request->input('email'),
            'stat' => $request->input('stat'),
        ], fn($value) => !is_null($value));
    
        if (!empty($personalInfoUpdate)) {
            PersonalInfo::where('id', $id)->update($personalInfoUpdate);
        }
    
        $professionalInfoUpdate = array_filter([
            'date_of_enlistment' => $request->input('date_of_enlistment'),
            'date_of_retirement' => $request->input('date_of_retirement'),
            'rank_of_retirement' => $request->input('rank_of_retirement'),
            'station_retired' => $request->input('station_retired'),
            'region' => $request->input('region'),
            'district' => $request->input('district'),
            'where_to_attend_meeting' => $request->input('where_to_attend_meeting'),
        ], fn($value) => !is_null($value));
    
        if (!empty($professionalInfoUpdate)) {
            ProfessionalInfo::where('personal_id', $id)->update($professionalInfoUpdate);
        }
    
        $othersUpdate = array_filter([
            'present_occupation' => $request->input('present_occupation'),
            'next_of_kin' => $request->input('next_of_kin'),
            'member_signature' => $request->input('member_signature'),
            'status' => $request->input('status'),
            'secretary' => $validatedData['secretary'],
            'chairman' => $validatedData['chairman'],
            'treasury' => $validatedData['treasury'],
            'repoag_no' => $validatedData['repoag_no']
        ], fn($value) => !is_null($value));
    
        if (!empty($othersUpdate)) {
            Others::where('personal_id', $id)->update($othersUpdate);
        }
    
        if ($request->input('status') === "Approved") {
            $personalInfo = PersonalInfo::findOrFail($id);
            // Mail::to($personalInfo->email)->send(new SendMail($personalInfo));
            return redirect('/officers')->with('success', 'Officer approved and email sent successfully.');
        }
    
        return redirect('/officers');
    }

    // Generate Report Function
    public function report(Request $request) {
        $data = [];
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }

        // $getYear = ProfessionalInfo::select('date_of_retirement') -> distinct() -> get(date('Y'));
        $getYear = ProfessionalInfo::select(DB::raw('DISTINCT YEAR(date_of_retirement) as retirement_year'))
                ->pluck('retirement_year');
        //  ('year', date('Y'));
    
        $serviceId = PersonalInfo::select('prison_svc_no') -> distinct() -> get();
        $rankName = ProfessionalInfo::select('rank_of_retirement') -> distinct() -> get();
        $regions = Districts::select('region') -> distinct() -> get();
    
        $genderInput = $request->input('gender');
        $region = $request->input('region');
        $rank = $request->input('rank');
        $age = $request->input('age');
        $year = $request->input('year');
        $statInput = $request -> input('stat');
    
        $query = DB::table('personal_infos')
            ->join('professional_infos', 'personal_infos.id', '=', 'professional_infos.personal_id')
            ->join('others', 'personal_infos.id', '=', 'others.personal_id')
            -> select('personal_infos.id as personal_id', 'personal_infos.*', 'professional_infos.*', 'others.*')

            ->when($region, function($query, $region) {
                return $query->where('region', 'LIKE', "%{$region}%");
            })
            ->when($rank, function($query, $rank) {
                return $query->orWhere('rank_of_retirement', 'LIKE', "%{$rank}%");
            })
            // -> when($genderInput, function($query, $gender) {
            //     return $query -> orWhere('sex', 'LIKE', "%{$gender}%");
            // })
            ->when($genderInput, function($query, $genderInput) {
                return $query->orWhere('sex', 'LIKE', "%{$genderInput}%");
            })
            ->when($year, function($query, $year) {
                return $query->orWhereRaw("YEAR(date_of_retirement) = ?", [$year]);
            })
            ->when($statInput, function($query, $statInput) {
                return $query->orWhere('stat', 'LIKE', "%{$statInput}%");
            })
            ->get();
    
        return view('pages.report', compact('data', 'serviceId', 'rankName', 'regions', 'getYear', 'query'));
    }
    

    // Display Regions & District Page Function
    public function region() {
        $data = [];
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }

        $region = Districts::all();

        return view('pages.region', compact('data', 'region'));
    }

    // Display Add Region Page Function
    public function addRegion() {
        $data = [];
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
        $data = [];
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

    // Delete Region Function
    public function deleteRegion($id) {
        $region = Districts::findOrFail($id);

        $region -> delete();
        return redirect('/region') -> with('Data Deleted Successfully');
    }

    public function periodicReport() {
        $data = [];
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }

        return view('pages.periodic-report', compact('data'));
    }


    // Generate Quarterly Report Function
    public function newGenerateQuarterlyReport(Request $request) {
        // Get request parameters (default to current year & quarter)
        $year = $request->input('year', date('Y'));
        $quarter = $request->input('quarter'); // If not provided, yearly report
        $stat = $request->input('stat', 'all'); // Default to "all"

        // Determine start and end date
        if ($quarter) {
            // Quarterly Report
            switch ($quarter) {
                case 1:
                    $startDate = "$year-01-01";
                    $endDate = "$year-03-31";
                    break;
                case 2:
                    $startDate = "$year-04-01";
                    $endDate = "$year-06-30";
                    break;
                case 3:
                    $startDate = "$year-07-01";
                    $endDate = "$year-09-30";
                    break;
                case 4:
                    $startDate = "$year-10-01";
                    $endDate = "$year-12-31";
                    break;
                default:
                    return response()->json(['error' => 'Invalid quarter'], 400);
            }
            $reportTitle = "Quarterly Report - Q$quarter $year";
            $fileName = "quarterly_report_Q{$quarter}_{$year}.pdf";
        } else {
            // Yearly Report
            $startDate = "$year-01-01";
            $endDate = "$year-12-31";
            $reportTitle = "Yearly Report - $year";
            $fileName = "yearly_report_{$year}.pdf";
        }

        // Query data with joins
        $transactions = DB::table('personal_infos')
            ->join('professional_infos', 'personal_infos.id', '=', 'professional_infos.personal_id')
            ->join('others', 'personal_infos.id', '=', 'others.personal_id')
            ->whereBetween('personal_infos.created_at', [$startDate, $endDate]);

        // Apply stat filter if provided and not "all"
        if ($stat !== "all") {
            $transactions->where('personal_infos.stat', $stat);
        }

        $transactions = $transactions->select(
            'personal_infos.*',
            'professional_infos.*',
            'others.*',
            'personal_infos.stat as stat',
            DB::raw("DATE_FORMAT(personal_infos.created_at, '%Y-%m-%d') as formatted_date")
        )->get();

        // Generate PDF
        $pdf = PDF::loadView('pages.quarterly', compact('transactions', 'year', 'quarter', 'reportTitle'));

        // Return PDF download
        return $pdf->download($fileName);
    }

    // public function All() {
    //     $data = [];
    //     if(Session::has('loginId')) {
    //         $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
    //     }
    //     return view('pages.dashboard', compact('data'));
    // }
 
}