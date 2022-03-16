<?php


namespace App\Helpers;
use Request;
use App\LogActivity as LogActivityModel;


class LogActivity
{


    public static function addToLog($subject)
    {   

    	$log = [];
    	$log['description'] = $subject.' ip: '. Request::ip();
    	$log['user_id'] = auth()->check() ? auth()->user()->id : 1;
    	$log['date'] = date('Y-m-d H:i:s');
    	LogActivityModel::create($log);
    }


    public static function logActivityLists()
    {
    	return LogActivityModel::latest()->get();
    }

}