<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Dotenv\Parser\Value;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // change password UI
    public function changepassword()
    {
        return view('admin.account.change');
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

        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashValue = $user->password;

        if (Hash::check($request->oldpassword, $dbHashValue)) {
            $data = [
                'password' => Hash::make($request->newpassword)
            ];

            User::where('id', Auth::user()->id)->update($data);

            return back()->with(['changesuccess' => 'Password Changed Successfully...']);
        }

        return back()->with(['notMatch' => 'Your old Password is not match. Try again!']);
    }

    //  adminaccountdetail

    public function detail()
    {
        return view('admin.account.detail');
    }

    // admin Account edit
    public function edit()
    {
        return view('admin.account.edit');
    }


    // admin account update
    public function update($id, Request $request)
    {
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        // upload image
        if ($request->hasFile('image')) {
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;
            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        User::where('id', $id)->update($data);
        return redirect()->route('adminAccount#detail')->with(['updateAccount' => 'Account Updated Successfully']);
    }

    // adminlist
    public function list()
    {
        $admin = User::when(request('key'), function ($q) {
            $q->orWhere('name', 'like', '%' . request('key') . '%')
                ->orWhere('email', 'like', '%' . request('key') . '%')
                ->orWhere('gender', 'like', '%' . request('key') . '%')
                ->orWhere('phone', 'like', '%' . request('key') . '%')
                ->orWhere('address', 'like', '%' . request('key') . '%');
        })->where('role', 'admin')->paginate(3);
        $admin->appends(request()->all());
        return view('admin.account.list', compact('admin'));
    }

    // adminlist delete
    public function delete($id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('adminAccount#list')->with(['deleteSuccess' => 'Account Deleted Successfully...']);
    }

    // userdata
    private function getUserData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'updated_at' => Carbon::now()
        ];
    }

    // account Validation check

    private function accountValidationCheck($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'image' => 'mimes:png,jpg,jpeg|file',
            'address' => 'required'
        ])->validate();
    }

    // passwordValidationCheck

    private function passwordValidationCheck($request)
    {
        Validator::make($request->all(), [
            'oldpassword' => 'required',
            'newpassword' => 'required|min:6|max:20',
            'confirmpassword' => 'required|min:6|max:20|same:newpassword'
        ])->validate();
    }
}
