<?php

namespace App\Http\Controllers;

use App\Models\SignIn;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
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
             // Check if account is active
            if($user->status !== 'active') {
                return back()->with('fail', 'Your account is inactive. Please contact administrator!');
            }

            if(Hash::check($request -> password, $user -> password)) {

                if(isset($user -> role) && !empty($user -> role)) {
                    $allowedRoles = ['super_admin', 'regional_admin'];

                    if(in_array($user -> role, $allowedRoles)) {
                         // Log the login activity for super admin tracking
                        $this->logUserActivity($user->id, $request);

                        $request -> session() -> put('loginId', $user -> id);
                        $request -> session() -> put('userRole', $user -> role);

                        switch($user -> role) {
                            case 'super_admin':
                                return redirect('/super-admin/dashboard') ->with ('success', 'Welcome Super Admin!');
                            case 'regional_admin':
                                return redirect('/dashboard') -> with('success', 'Welcome Regional Admin!');
                        }
                    } else {
                        return back()->with('fail', 'Your account role is not authorized to access this portal!');
                    }
                } else {
                    return back()->with('fail', 'No role assigned to your account. Please contact administrator!');
                }
            } else {
                return back()->with('fail', 'Incorrect Credentials!');
            } 
        } else {
            return back() -> with('fail', 'You do not access to this portal!!');
        }
    }

    // Log user login activity for super admin tracking
private function logUserActivity($userId, $request) {
    DB::table('user_login_logs')->insert([
        'user_id' => $userId,
        'login_time' => now(),
        'ip_address' => $request->ip(),
        'user_agent' => $request->userAgent(),
        'created_at' => now(),
        'updated_at' => now()
    ]);
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

    // Save Profile Data Function
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
