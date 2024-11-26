<?php

namespace App\Http\Controllers;

use App\Models\RegistrationForm;
use App\Models\SignIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    
    // Display Dashboard Page Function
    public function dashboard() {
        $data = array();
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }
        $forms = RegistrationForm::all() -> count();
        $registered = RegistrationForm::where('status', 'Submitted') -> count();
        $pending = RegistrationForm::where('status', 'Pending') -> count();
        $approve = RegistrationForm::where('status', 'Approved') -> count();
        return view('pages.dashboard', compact('forms', 'registered', 'pending', 'approve', 'data'));
    }

    //Display Form Page Function
    public function form() {
        $data = array();
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }
        return view('pages.forms', compact('data'));
    }

    public function postForm(Request $request) {
        $saveOfficers = new RegistrationForm();

        $reg_id = 'REGID' . mt_rand(1000, 9999);

        $saveOfficers -> reg_id = $reg_id;

        $saveOfficers -> full_name = $request -> input('full_name');
        $saveOfficers -> govt_pension_no = $request -> input('govt_pension_no');
        $saveOfficers -> prison_svc_no = $request -> input('prison_svc_no');
        $saveOfficers -> residential_address = $request -> input('residential_address');
        $saveOfficers -> postal_address = $request -> input('postal_address');
        $saveOfficers -> branch = $request -> input('branch');
        $saveOfficers -> telephone = $request -> input('telephone');
        $saveOfficers -> ghana_card_no = $request -> input('ghana_card_no');
        $saveOfficers -> sex = $request -> input('sex');
        $saveOfficers -> present_age = $request -> input('present_age');
        $saveOfficers -> date_of_enlistment = $request -> input('date_of_enlistment');
        $saveOfficers -> date_of_retirement = $request -> input('date_of_retirement');
        $saveOfficers -> rank_of_retirement = $request -> input('rank_of_retirement');
        $saveOfficers -> station_retired = $request -> input('station_retired');
        $saveOfficers -> where_to_attend_meeting = $request -> input('where_to_attend_meeting');
        $saveOfficers -> hometown = $request -> input('hometown');
        $saveOfficers -> present_place_of_residence = $request -> input('present_place_of_residence');
        $saveOfficers -> present_occupation = $request -> input('present_occupation');
        $saveOfficers -> marital_status = $request -> input('marital_status');
        $saveOfficers -> next_of_kin = $request -> input('next_of_kin');
        $saveOfficers -> member_signature = $request -> input('member_signature');

        $saveOfficers -> status = "Submitted";
        
        $saveOfficers -> save();

        return redirect('/dashboard');
    }

    // View All Officers Page Function
    public function officer() {
        $data = array();
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }
        $officers = RegistrationForm::all();

        return view('pages.officers', compact('officers', 'data'));
    }

    // View Specified Officer Page Function
    public function viewOfficer($id) {
        $data = array();
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }
        $viewOfficer = RegistrationForm::findOrFail($id);

        return view('pages.view', compact('viewOfficer', 'data'));
    }

    // Delete Officers Function
    public function deleteOfficer($id) {
        $deleteOfficer = RegistrationForm::findOrFail($id);

        $deleteOfficer -> delete();

        return redirect('/officers') -> with('success', 'Data Successfully Deleted');
    }

    // Display Edit Officer Page Function
    public function editOfficer($id) {
        $data = array();
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }
        $editOfficer = RegistrationForm::findOrFail($id);
        
        return view('pages.edit', compact('editOfficer', 'data'));
    }

    // Save Updated Officer Data Function
    public function postEditOfficer(Request $request, $id) {
        $postEditOfficer = RegistrationForm::findOrFail($id);

        $postEditOfficer -> full_name = $request -> input('full_name');
        $postEditOfficer -> govt_pension_no = $request -> input('govt_pension_no');
        $postEditOfficer -> prison_svc_no = $request -> input('prison_svc_no');
        $postEditOfficer -> residential_address = $request -> input('residential_address');
        $postEditOfficer -> postal_address = $request -> input('postal_address');
        $postEditOfficer -> branch = $request -> input('branch');
        $postEditOfficer -> telephone = $request -> input('telephone');
        $postEditOfficer -> ghana_card_no = $request -> input('ghana_card_no');
        $postEditOfficer -> sex = $request -> input('sex');
        $postEditOfficer -> present_age = $request -> input('present_age');
        $postEditOfficer -> date_of_enlistment = $request -> input('date_of_enlistment');
        $postEditOfficer -> date_of_retirement = $request -> input('date_of_retirement');
        $postEditOfficer -> rank_of_retirement = $request -> input('rank_of_retirement');
        $postEditOfficer -> station_retired = $request -> input('station_retired');
        $postEditOfficer -> where_to_attend_meeting = $request -> input('where_to_attend_meeting');
        $postEditOfficer -> hometown = $request -> input('hometown');
        $postEditOfficer -> present_place_of_residence = $request -> input('present_place_of_residence');
        $postEditOfficer -> present_occupation = $request -> input('present_occupation');
        $postEditOfficer -> marital_status = $request -> input('marital_status');
        $postEditOfficer -> next_of_kin = $request -> input('next_of_kin');
        $postEditOfficer -> member_signature = $request -> input('member_signature');

        $postEditOfficer -> update();

        return redirect('/officers') -> with('success', 'Data Updated Successfully');
    } 

    public function approveOfficer($id) {
        $data = array();
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }
        $approveOfficer = RegistrationForm::findOrFail($id);

        return view('pages.approve', compact('approveOfficer', 'data'));
    }

    // Save Approved Officer Data Function
    public function postApproveOfficer(Request $request, $id) {
        $postApproveOfficer = RegistrationForm::findOrFail($id);

        $postApproveOfficer -> full_name = $request -> input('full_name');
        $postApproveOfficer -> govt_pension_no = $request -> input('govt_pension_no');
        $postApproveOfficer -> prison_svc_no = $request -> input('prison_svc_no');
        $postApproveOfficer -> residential_address = $request -> input('residential_address');
        $postApproveOfficer -> postal_address = $request -> input('postal_address');
        $postApproveOfficer -> branch = $request -> input('branch');
        $postApproveOfficer -> telephone = $request -> input('telephone');
        $postApproveOfficer -> ghana_card_no = $request -> input('ghana_card_no');
        $postApproveOfficer -> sex = $request -> input('sex');
        $postApproveOfficer -> present_age = $request -> input('present_age');
        $postApproveOfficer -> date_of_enlistment = $request -> input('date_of_enlistment');
        $postApproveOfficer -> date_of_retirement = $request -> input('date_of_retirement');
        $postApproveOfficer -> rank_of_retirement = $request -> input('rank_of_retirement');
        $postApproveOfficer -> station_retired = $request -> input('station_retired');
        $postApproveOfficer -> where_to_attend_meeting = $request -> input('where_to_attend_meeting');
        $postApproveOfficer -> hometown = $request -> input('hometown');
        $postApproveOfficer -> present_place_of_residence = $request -> input('present_place_of_residence');
        $postApproveOfficer -> present_occupation = $request -> input('present_occupation');
        $postApproveOfficer -> marital_status = $request -> input('marital_status');
        $postApproveOfficer -> next_of_kin = $request -> input('next_of_kin');
        $postApproveOfficer -> member_signature = $request -> input('member_signature');
        $postApproveOfficer -> status = $request -> input('status');

        $postApproveOfficer -> update();

        return redirect('/officers') -> with('success', 'Officer Approved Successfully');
    }
}