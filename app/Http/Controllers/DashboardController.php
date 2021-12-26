<?php

namespace App\Http\Controllers;

use App\Models\CustomerEntry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user');
        auth()->shouldUse('user');
    }

    public function index(Request $request)
    {
        return view('frontend.home');
    }


    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'password_confirmation' => 'required|same:newpassword',
        ], [
            'oldpassword.required' => 'Please enter current password',
            'newpassword.required' => 'Please enter new password',
            'password_confirmation.required' => 'Please enter confirm password',
        ]);

        if (Hash::check($request->oldpassword, Auth::guard('user')->user()->password)) {
            $data['password'] = bcrypt($request->newpassword);
            $message = 'Password updated successfully.';
            Auth::guard('user')->user()->update($data);
            return redirect()->intended('user/dashboard')
                ->with('flash_success', $message);
        } else {
            $message = 'Old password is incorrect';
            return redirect()->intended('user/dashboard')
                ->with('flash_error', $message);
        }
    }
}
