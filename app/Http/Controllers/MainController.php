<?php

namespace App\Http\Controllers;

use App\Models\RegistrationForm;
use Illuminate\Http\Request;

class MainController extends Controller
{
    
    // Display Dashboard Page Function
    public function dashboard() {
        return view('pages.dashboard');
    }

    //Display Form Page Function
    public function form() {
        return view('pages.forms');
    }

    public function postForm(Request $request) {
        $saveOfficers = new RegistrationForm();

        $saveOfficers -> full_name = $request -> input('full_name');
        
        $saveOfficers -> save();

        return redirect('/dashboard');
    }
}
