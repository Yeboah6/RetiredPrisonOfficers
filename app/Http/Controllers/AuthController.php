<?php

namespace App\Http\Controllers;

use App\Models\SignIn;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    
    public function signIn() {
        return view('auth.signin');
    }

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
}
