<?php

namespace App\Helpers;
use App\PHPMailer\PHPMailer;
use App\PHPMailer\Exception;

require_once "vendor/autoload.php";
use Request;


class MailActivity
{


    public static function sendmail($subject,$receiver,$body,$name)
    {   

      $details = [
        'title' => $subject,
        'body' => $body,
        'email' => $receiver,
        'name' =>$name
        ];
  
        \Mail::to($receiver)->send(new \App\Mail\forgetpassword($details));
        
    }
    
    public static function approval($subject,$receiver,$body)
    {   

      $details = [
        'title' => $subject,
        'body' => $body,
        'email' => $receiver
        ];
  
        \Mail::to($receiver)->send(new \App\Mail\approval($details));
        
    }
    
    public static function registration($subject,$receiver,$body)
    {   

      $details = [
        'title' => $subject,
        'body' => $body,
        'email' => $receiver
        ];
  
        \Mail::to($receiver)->send(new \App\Mail\approval($details));
        
    }
    
    public static function successfulPayments($subject,$receiver,$body)
    {   

      $details = [
        'title' => $subject,
        'body' => $body,
        'email' => $receiver
        ];
  
        \Mail::to($receiver)->send(new \App\Mail\approval($details));
        
    }
     public static function orderPlaced($subject,$receiver,$body)
    {   

      $details = [
        'title' => $subject,
        'body' => $body,
        'email' => $receiver
        ];
  
        \Mail::to($receiver)->send(new \App\Mail\approval($details));
        
    }


}