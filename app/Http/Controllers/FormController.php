<?php

namespace App\Http\Controllers;

use App\Models\Others;
use App\Models\PersonalInfo;
use App\Models\ProfessionalInfo;
use Illuminate\Http\Request;

use App\Models\SignIn;
use Illuminate\Support\Facades\Session;

class FormController extends Controller
{
    //Display Personal Info Page Function
    public function personalInfo() {
        $data = array();
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }
        return view('forms.personalInfo', compact('data'));
    }

    // Save Personal Info Data Function 
    public function postPersonalInfo(Request $request) {
        $validatedData = $request->validate([
            'full_name' => 'required|string',
            'govt_pension_no' => 'required|string|max:255',
            'prison_svc_no' => 'required|string|max:255',
            'residential_address' => 'required|string|max:255',
            'postal_address' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'ghana_card_no' => 'required|string|max:255',
            'sex' => 'required|string|max:255',
            'present_age' => 'required|integer|min:60',
            'hometown' => 'required|string|max:255',
            'present_place_of_residence' => 'required|string|max:255',
            'marital_status' => 'required|string|max:255',
            'email' => 'required|email|max:255'
        ],
        [
            'present_age.min' => 'Age must be at least 60 years.'
        ]);
    
        // Generate applicant ID
        $reg_id = 'REGID' . mt_rand(1000, 9999);
    
        // // Create a new PersonalInfo instance
        $personalInfo = new PersonalInfo();
    
        // Fill data into the model
        $personalInfo->fill([
            'full_name' => $validatedData['full_name'],
            'reg_id' => $reg_id,

            'govt_pension_no' => $validatedData['govt_pension_no'],
            'prison_svc_no' => $validatedData['prison_svc_no'],
            'residential_address' => $validatedData['residential_address'],
            'postal_address' => $validatedData['postal_address'],
            'telephone' => $validatedData['telephone'],
            'ghana_card_no' => $validatedData['ghana_card_no'],
            'sex' => $validatedData['sex'],
            'present_age' => $validatedData['present_age'],
            'hometown' => $validatedData['hometown'],
            'present_place_of_residence' => $validatedData['present_place_of_residence'],
            'marital_status' => $validatedData['marital_status'],
            'email' => $validatedData['email'],
        ]);

        // if ($request -> input('present_age') >= 60) {
            // Save the personal information
            if ($personalInfo -> save()) {
                // Store the personal_info_id in the session if save is successful
                session(['personal_info_id' => $personalInfo -> id]);
            
                // Redirect to work experience page with success message
                return redirect('/professional-info')->with('success', 'Personal Information Data saved successfully');
            } else {
                // Redirect back with failure message
                return redirect()->back()->with('fail', 'Data not saved');
            }
        // } 
        // else {
        //     return redirect()->back()->with('fail', 'Age must be 60 or above');
        // }
    }

    // Display Edit Personal Info Page Function
    public function editPersonalInfo($id) {
        $data = array();
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }
        $editPersonalInfo = PersonalInfo::findOrFail($id);

        return view('forms.editPersonalInfo', compact('editPersonalInfo', 'data'));
    }

    // Update Personal Info Page Function
    public function postEditPersonalInfo(Request $request, $id) {
        $validatedData = $request->validate([
            'full_name' => 'required|string',
            'govt_pension_no' => 'required|string|max:255',
            'prison_svc_no' => 'required|string|max:255',
            'residential_address' => 'required|string|max:255',
            'postal_address' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'ghana_card_no' => 'required|string|max:255',
            'sex' => 'required|string|max:255',
            'present_age' => 'required|integer|min:60',
            'hometown' => 'required|string|max:255',
            'present_place_of_residence' => 'required|string|max:255',
            'marital_status' => 'required|string|max:255',
            'email' => 'required|email|max:255'
        ],
        [
            'present_age.min' => 'Age must be at least 60 years.'
        ]);

        $editPersonalInfo = PersonalInfo::findOrFail($id);

        $editPersonalInfo -> fill([
            'full_name' => $validatedData['full_name'],
            'govt_pension_no' => $validatedData['govt_pension_no'],
            'prison_svc_no' => $validatedData['prison_svc_no'],
            'residential_address' => $validatedData['residential_address'],
            'postal_address' => $validatedData['postal_address'],
            'telephone' => $validatedData['telephone'],
            'ghana_card_no' => $validatedData['ghana_card_no'],
            'sex' => $validatedData['sex'],
            'present_age' => $validatedData['present_age'],
            'hometown' => $validatedData['hometown'],
            'present_place_of_residence' => $validatedData['present_place_of_residence'],
            'marital_status' => $validatedData['marital_status'],
            'email' => $validatedData['email'],
        ]);

        $editPersonalInfo -> update();
        return redirect('/edit-professional-info/'.$editPersonalInfo -> id);
    }

    // Display Professional Info Page Function 
    public function professionalInfo() {
        $data = array();
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }

        $personal_id = session('personal_info_id');

        return view('forms.professionalInfo', compact('data', 'personal_id'));

    }

    // Save Professional Info Data Function
    public function postProfessionalInfo(Request $request) {
        $validatedData = $request->validate([
            'personal_id' => 'required|string',
            'date_of_enlistment' => 'required|string',
            'date_of_retirement' => 'nullable|string|max:255',
            'rank_of_retirement' => 'required|string|max:255',
            'station_retired' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'where_to_attend_meeting' => 'required|string|max:255',
        ]);

        $professionalInfo = new ProfessionalInfo();

        $professionalInfo->fill([
            'personal_id' => $validatedData['personal_id'],
            'date_of_enlistment' => $validatedData['date_of_enlistment'],
            'date_of_retirement' => $validatedData['date_of_retirement'],
            'rank_of_retirement' => $validatedData['rank_of_retirement'],
            'station_retired' => $validatedData['station_retired'],
            'branch' => $validatedData['branch'],
            'where_to_attend_meeting' => $validatedData['where_to_attend_meeting']
        ]);

        $professionalInfo -> save();
        return redirect('/others') -> with('success', 'Professional Information Data saved successfully');
    }

    // Display Edit Professional Info Page Function
    public function editProfessionalInfo($id) {
        $data = array();
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }

        $personalInfo = PersonalInfo::all();
        $editProfessionalInfo = ProfessionalInfo::findOrFail($id);

        foreach ($personalInfo as $personalInfo) {
            if ($personalInfo -> id == $editProfessionalInfo -> personal_id) {
                return view('forms.editProfessionalInfo', compact('editProfessionalInfo', 'data'));
            }
        }
    }

        // Update Professional Info Page Function
    public function postEditProfessionalInfo(Request $request, $id) {
        $validatedData = $request->validate([
            'personal_id' => 'required|string',
            'date_of_enlistment' => 'required|string',
            'date_of_retirement' => 'nullable|string|max:255',
            'rank_of_retirement' => 'required|string|max:255',
            'station_retired' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'where_to_attend_meeting' => 'required|string|max:255',
        ]);

        $editProfessionalInfo = ProfessionalInfo::findOrFail($id);

        $editProfessionalInfo->fill([
            'personal_id' => $validatedData['personal_id'],
            'date_of_enlistment' => $validatedData['date_of_enlistment'],
            'date_of_retirement' => $validatedData['date_of_retirement'],
            'rank_of_retirement' => $validatedData['rank_of_retirement'],
            'station_retired' => $validatedData['station_retired'],
            'branch' => $validatedData['branch'],
            'where_to_attend_meeting' => $validatedData['where_to_attend_meeting']
        ]);

        $editProfessionalInfo -> update();
        return redirect('/edit-others/'.$editProfessionalInfo -> id);
    }

    // Display Others Page Function
    public function others() {
        $data = array();
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }

        $personal_id = session('personal_info_id');

        return view('forms.others', compact('data', 'personal_id'));
    }

    // Save Others Data Function
    public function postOthers(Request $request) {
        $validatedData = $request->validate([
            'personal_id' => 'required|string',
            'present_occupation' => 'max:255',
            'next_of_kin' => 'required|string',
            'member_signature' => 'nullable|string|max:255',
        ]);

        $others = new Others();

        $others->fill([
            'personal_id' => $validatedData['personal_id'],
            'present_occupation' => $validatedData['present_occupation'],
            'next_of_kin' => $validatedData['next_of_kin'],
            'member_signature' => $validatedData['member_signature'],
        ]);
        
        $others -> status = "Submitted";

        $others -> save();
        return redirect('/personal-info') -> with('success', 'Other Information Saved Successfully');
    }

// Display Other Edit Page Function
    public function editOther($id) {
        $data = array();
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }

        $personalInfo = PersonalInfo::all();
        $editOther = Others::findOrFail($id);

        foreach ($personalInfo as $personalInfo) {
            if ($personalInfo -> id == $editOther -> personal_id) {
                // dd($editOther -> personal_id);
                return view('forms.editOther', compact('editOther', 'data'));
            }
        }

        return view('forms.editOther', compact('data'));
    }

    // Update Others Page Function
    public function postEditOther(Request $request, $id) {
        $validatedData = $request->validate([
            'personal_id' => 'required|string',
            'present_occupation' => 'max:255',
            'next_of_kin' => 'required|string',
            'member_signature' => 'nullable|string|max:255',
        ]);

        $editOther = Others::findOrFail($id);

        $editOther->fill([
            'personal_id' => $validatedData['personal_id'],
            'present_occupation' => $validatedData['present_occupation'],
            'next_of_kin' => $validatedData['next_of_kin'],
            'member_signature' => $validatedData['member_signature'],
        ]);

        $editOther -> update();
        return redirect('/officers') -> with('success', 'Officer Data Updated Successfully');
    }

}