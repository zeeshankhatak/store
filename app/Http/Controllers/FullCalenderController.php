<?php
   
namespace App\Http\Controllers;
   
use App\Event;
use Illuminate\Http\Request;
use Redirect,Response;
use DB;
use Auth;
   
class FullCalenderController extends Controller
{
 
    public function index()
    {

        // $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
        // $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');


        // $data = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','title','start', 'end']);
        
        // dd('asd a dasd');
       $order_details = DB::table('fps_coach_assign')
        ->join('fps_orders', 'fps_coach_assign.order_id', '=', 'fps_orders.id')
        ->join('fps_users', 'fps_users.id', '=', 'fps_orders.user_id')
        ->select('fps_coach_assign.assign_date as start', 'fps_users.fname as title', 'fps_users.lname')
        ->where('fps_coach_assign.coach_id',Auth::User()->id)
        ->get();
        if(request()->ajax()) 
        {
 
        //  $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
        //  $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
 
        //  $data = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','title','start', 'end']);


        //  $order_details = DB::table('fps_orders')
        //  ->join('fps_games', 'fps_games.id', '=', 'fps_orders.game_id')
        //  ->select('fps_orders.id', 'fps_games.name', 'fps_orders.total_coaches', 'fps_orders.total', 'fps_orders.status')
        //  ->where('user_id',Auth::User()->id)
        //  ->get();


        $order_details = DB::table('fps_coach_assign')
        ->join('fps_orders', 'fps_coach_assign.order_id', '=', 'fps_orders.id')
        ->join('fps_users', 'fps_users.id', '=', 'fps_orders.user_id')
        ->select('fps_coach_assign.assign_date as start', 'fps_users.fname as title', 'fps_users.lname')
        ->where('fps_coach_assign.coach_id',Auth::User()->id)
        ->get();

           // dd($order_details);
         return Response::json($order_details);
        }
 

           // dd($order_details);

       
        return view('instructor.calendar.fullcalender',compact('order_details'));
    }
    
   
    // public function create(Request $request)
    // {  
    //     $insertArr = [ 'title' => $request->title,
    //                    'start' => $request->start,
    //                    'end' => $request->end
    //                 ];

    //                 // dd($insertArr);


    //     $event = Event::insert($insertArr);   
    //     return Response::json($event);
    // }
     
 
    // public function update(Request $request)
    // {   
    //     $where = array('id' => $request->id);
    //     $updateArr = ['title' => $request->title,'start' => $request->start, 'end' => $request->end];
    //     $event  = Event::where($where)->update($updateArr);
 
    //     return Response::json($event);
    // } 
 
 
    // public function destroy(Request $request)
    // {
    //     $event = Event::where('id',$request->id)->delete();
   
    //     return Response::json($event);
    // }    
 
 
}