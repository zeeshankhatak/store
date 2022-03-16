<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\MailActivity;
use App\Mail\forgetpassword;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
    return view('home');
  
} 

//   public function sendmail(Request $request)
//     {
        
        
       
        
//     MailActivity::sendmail('Welcome','huzaifa.shahzadts@gmail.com','Welcome to Find Pro Squad');
  
// } 


        
    
}
