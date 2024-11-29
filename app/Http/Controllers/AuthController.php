<?php

namespace App\Http\Controllers;

use App\Models\SignIn;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    
    // Display Log In Page Function
    public function signIn() {
        return view('auth.signin');
    }

    // Log In function
    public function login(Request $request) {
        $request -> validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:12'
        ]);

        $user = SignIn::where('email', '=', $request -> email) -> first();
        if($user) {
            if(Hash::check($request -> password, $user -> password)) {
                $request -> session() -> put('loginId', $user -> id);
                return redirect('/dashboard') -> with('success', 'Logged In Successfull!!');
            } else {
                return back() -> with('fail', 'Incorrect Credentials!!');
            } 
        } else {
            return back() -> with('fail', 'You do not access to this portal!!');
        }
    }

    // Log out Function
    public function logout() {
        if(Session::has('loginId')) {
            Session::pull('loginId');
            return redirect('/');
        }
    }

    // Dsiplay Profile Page Function
    public function profile() {
        $data = array();
        if(Session::has('loginId')) {
            $data = SignIn::where('id', '=', Session::get('loginId')) -> first();
        }

        return view('pages.profile', compact('data'));
    }

    public function postProfile(Request $request) {
        $request -> validate([
            'email' => 'required|email',
            'new_email' => 'required|email|unique:sign_ins,email,' . SignIn::where('email', $request->email)->value('id'),
            'new_password' => 'required|min:8|max:12',
            'confirm_password' => 'required|min:8|max:12',
        ]);

           // Check if passwords match
        if ($request->input('new_password') !== $request->input('confirm_password')) {
            return back()->with('fail', "Passwords don't match!!");
        }

        $profile = SignIn::where('email', '=', $request -> email) -> first();

        if($profile) {
             // Update email and password if valid
            $profile -> email = $request->input('new_email');
            $profile -> password = Hash::make($request->input('new_password'));
            $profile -> save();
            return back() -> with('success', 'Admin Info Updated Successfully');
        } else {
            return back() -> with('fail', 'Incorrect Credentials!!');
        }
    }
}
