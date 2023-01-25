<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class AuthController extends Controller
{
    public function loginPage()
    {
        return view('login');
    }

    public function registerPage()
    {
        return view('register');
    }

    public function dashboard()
    {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('category#list');
        } else {
            return redirect()->route('user#home');
        }
    }
    // change password UI
    public function changepassword()
    {
        return view('admin.password.change');
    }

    // password Change
    public function passwordChange(Request $request)
    {
        /*1. all field must be fill
          2. new password and confirm password length must be greather than 6 and less than 10
          3. new password and confirm password must be same
          4. db password and client password must be same
          5. changed password success
        */
        $this->passwordValidationCheck($request);

        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbHashValue = $user->password;

        if (Hash::check($request->oldpassword, $dbHashValue)) {
            $data = [
                'password' => Hash::make($request->newpassword)
            ];

            User::where('id',Auth::user()->id)->update($data);

            return back()->with(['changesuccess'=>'Password Changed Successfully...']);
        }

        return back()->with(['notMatch' => 'Your old Password is not match. Try again!']);
    }

    // passwordValidationCheck

    private function passwordValidationCheck($request)
    {
        Validator::make($request->all(), [
            'oldpassword' => 'required',
            'newpassword' => 'required|min:6|max:10',
            'confirmpassword' => 'required|min:6|max:10|same:newpassword'
        ])->validate();
    }
}
