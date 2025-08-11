<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function __construct()
    {
        // Remove or comment out this line:
        // $this->middleware('auth');

        // OPTIONAL: If you want to explicitly prevent *logged-in* users from seeing the login page,
        // you can use the 'guest' middleware for specific methods or exclude methods from 'auth'.
        // However, the AuthenticatesUsers trait often handles this automatically.
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return redirect()->back()->with([
                'status' => 'error',
                'sms' => 'Username not found.',
            ]);
        }

        if ($user->status == 0) {
            return redirect()->back()->with([
                'status' => 'error',
                'sms' => 'Your account is inactive.',
            ]);
        }

        if (Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
        ], $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended($this->redirectTo)->with([
                'status' => 'success',
                'sms' => 'Login successful.',
            ]);
        }

        return redirect()->back()->with([
            'status' => 'error',
            'sms' => 'Invalid credentials.',
        ]);
    }
}