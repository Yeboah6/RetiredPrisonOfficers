<?php

namespace App\Http\Controllers;

use App\Models\RegistrationForm;
use Illuminate\Http\Request;

class MainController extends Controller
{
    
    // Display Dashboard Page Function
    public function dashboard() {
        $registered = RegistrationForm::where('status', 'Submitted') -> count();
        return view('pages.dashboard', compact('registered'));
    }

    //Display Form Page Function
    public function form() {
        return view('pages.forms');
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
        $officers = RegistrationForm::all();

        return view('pages.officers', compact('officers'));
    }

    // View Specified Officer Page Function
    public function viewOfficer($id) {
        $viewOfficer = RegistrationForm::findOrFail($id);

        return view('pages.view', compact('viewOfficer'));
    }

    // Delete Officers Function
    public function deleteOfficer($id) {
        $deleteOfficer = RegistrationForm::findOrFail($id);

        $deleteOfficer -> delete();

        return redirect('/officers') -> with('success', 'Data Successfully Deleted');
    }

    // Display Edit Officer Page Function
    public function editOfficer($id) {
        $editOfficer = RegistrationForm::findOrFail($id);
        
        return view('pages.edit', compact('editOfficer'));
    }

    public function postEditOfficer(Request $request, $id) {
        $postEditOfficer = RegistrationForm::findOrFail($id);

        $postEditOfficer -> full_name = $request -> input('full_name');
        $postEditOfficer -> govt_pension_no = $request -> input('govt_pension_no');
        $postEditOfficer -> prison_svc_no = $request -> input('prison_svc_no');
        $postEditOfficer -> residential_address = $request -> input('residential_address');
        $postEditOfficer -> postal_address = $request -> input('postal_address');
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
}