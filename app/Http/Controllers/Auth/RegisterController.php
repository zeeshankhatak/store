<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\fps_wallet;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $req = request();
        $req->session()->put('f_name', $data['fname']);
        $req->session()->put('l_name', $data['lname']);
        $req->session()->put('user_email', $data['email']);
        $req->session()->put('password', $data['password']);
        return Validator::make($data, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:fps_users'],
            'password' => ['required', 'string', 'min:8'],
            'Term&Condition' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $req = request();
        $filename="";
        if($req->hasFile('image')){
            $file = $req->file('image');
            $filename = $file->getClientOriginalName();
            $file->move('images/gamer',$filename);
            // $data->image = $filename;
        }
        
        // $req->session()->put('user_email', $data['email']);

        $user = User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_img' => $filename,
            'user_type' => USER_TYPE_GAMER,
            'language' => null,
            'verified' => 0,
            'status' => 1,
        ]);
        $user_id=$user->id;

        $data = fps_wallet::create([
            'userid' => $user_id,
            'amount' => 0,
            'date' => date('Y-m-d H:i:s'),
            'is_active' => 1,
        ]);

        return $user;
    }
    
      public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        return $this->registered($request, $user)
           // ?: redirect($this->redirectPath());
          ?: redirect('/thankyou')->with('success','You are registered successfully !');
    }
}

