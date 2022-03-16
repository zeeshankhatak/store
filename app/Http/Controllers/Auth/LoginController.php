<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;
use App\Helpers\LogActivity;
use App\Helpers\MailActivity;
use App\Mail\forgetpassword;
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

    protected function authenticated()
    {

        if (Auth::User()->status == 1)
        {

            if ( Auth::User()->user_type == 2)
            {
                LogActivity::addToLog('Coach Logged In');
                return redirect()->route('coach.index');
            }
            elseif ( Auth::User()->user_type == 3)
            {
                LogActivity::addToLog('Gamer Logged In');
                return redirect('/home');

            }
            else
            {


                LogActivity::addToLog('Admin Logged In');
                return redirect()->route('admin.index');
            }
        }
        else{

            Auth::logout();
            return redirect()->route('login')->with('delete','You are deactivated !');
        }
    }
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
