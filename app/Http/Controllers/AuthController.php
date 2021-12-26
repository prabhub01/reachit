<?php

namespace App\Http\Controllers;

use App\Helper\MediaHelper;
use App\Models\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use RedirectsUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';


    /**
     * The User repository implementation.
     *
     * @var UserRepository
     */
    protected $user;

    /**
     * Create a new authentication controller instance.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
        $this->middleware('guest:user', ['except' => 'getLogout']);
        auth()->shouldUse('user');
    }

    public function redirectLogin()
    {
        return redirect()->route('user.login');
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (auth()->guard('user')->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'is_active' => 1
        ], $request->remember)) {
            $user = Auth::user();
            $user->update(['last_login_at' => Carbon::now()]);
            return redirect()->intended('user/dashboard')
                ->with('flash_notice', 'You have successfully logged in.');
        }
        return redirect()->back()
            ->withInput($request->only('email_address', 'remember'))
            ->with('flash_error', 'These credentials do not match our records.');
    }


    public function postRegister(Request $request)
    {
        $request->validate(
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'password_confirmation' => 'required|same:password',
                'date_of_birth' => 'required|date',
                'nationality' => 'required',
                'mobile_number' => 'required',
                'gender' => 'required',
            ],
            [
                'password_confirmation.same' => 'Retype Password',
                'term_and_condition.required' => 'Please accept the terms and conditions'
            ]
        );
        if (User::where('email', $request->email)->first()) {
            return redirect()->back()
                ->withInput($request->only('email_address'))
                ->with('flash_error', 'Already register .Please try another email.');
        }
        if ($request->hasFile('document')) {
            $fileLocation = MediaHelper::upload($request->file('document'), 'document', false);
            $data['document'] = $fileLocation['storage'];
        }
        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['email'] = $request->email;
        $data['card_number'] = time();
        $data['password'] = Hash::make($request->password);
        $data['date_of_birth'] = $request->date_of_birth;
        $data['nationality'] = $request->nationality;
        $data['mobile_number'] = $request->mobile_number;
        $data['gender'] = $request->gender;
        $success = User::create($data);
        if (isset($success)) {
            return redirect()->intended('user/login')
                ->with('flash_notice', 'Thank you for registration. Your account has been forwarded for approval');
        }
        return redirect()->back()
            ->withInput($request->only('email_address', 'remember'))
            ->with('flash_error', 'These credentials do not match our records.');
    }

    public function getLogout()
    {
        auth()->logout();
        return redirect()->route('user.login')
            ->with('flash_notice', 'You are successfully logged out.');
    }


    public function register()
    {
        return view('auth.register');
    }
}
