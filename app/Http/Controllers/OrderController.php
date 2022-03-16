<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\fps_orders;
use DB;
use App\Setting;
use App\Course;
use App\User;
use Auth;
use Redirect;
use PDF;
use App\Currency;
use App\fps_wallet;
use App\fps_wallet_records;
use App\BundleCourse;
use Illuminate\Support\Facades\File;
use Session;
use Carbon\Carbon;

class OrderController extends Controller
{  

    //Items functions
      public function index(Request $request)
    {
        // dd($request->all());
        $country = DB::table('country')
                ->select('*')
                ->get();

        $sub_cat = DB::table('sub_categories')
                ->select('*')
                ->get();

        $price = DB::table('items')
                ->select('price','item_ID')
                ->get();
        
        
        $items = DB::table('items')
                             ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_cat_id')
                            ->join('country', 'country.id', '=', 'items.city_id')
                            ->join('area', 'area.id', '=', 'items.area_id')
                            ->select('items.price', 'items.new_Price', 'items.stock', 'items.status', 'items.item_ID', 'sub_categories.title', 'sub_categories.image', 'country.name', 'area.area_name')                         
                            ->orderBy('items.item_ID', 'desc');
                            // ->groupBy('fps_orders.id')
                            // ->get();

        if($request->country != "")
        {
            $items->where("items.city_id", $request->country );
        }

        if($request->sub_cat != "")
        {
            $items->where("items.sub_cat_id", $request->sub_cat );
        }

        if($request->to != "")
        {
            $items->where("items.price",">=", $request->to );
        }

        if($request->from != "")
        {
            $items->where("items.price","<=", $request->from );
        }

        if($request->stock != "")
        {
            $items->where("items.stock","=", $request->stock );
        }

        if($request->status != "")
        {
            $items->where("items.status","=", $request->status );
        }

        $result = $items->get();
            
        return view('store.items.index', compact('result','country','price', 'sub_cat'));
   
    }

    public function addItems()
    {
        $sub_cats = DB::table('sub_categories')
                    ->select('*')
                    ->get();

        $country = DB::table('country')
                ->select('*')
                ->get();

        $areas = DB::table('area')
            ->select('*')
            ->get();

        

        return view('store.items.add', compact('sub_cats','country','areas'));
    }

    public function storeItems(Request $request)
    {
        // dd($request->all());
        if ($request->status == 'on')
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }
        DB::table('items')->insert([
            'price' => $request->to,
            // 'new_Price' => $request->from,
            'sub_cat_id' => $request->sub_cat,
            'city_id' => $request->city,
            'area_id' => $request->area,
            'stock' => $request->stock,
            'status' => $status,
        ]);
        Session::flash('success','New Item has been Saved');
        return redirect()->route('items.index');
    }

    public function editItems($id)
    {
        $items = DB::table('items')
                         ->select('*')
                         ->where('item_ID', $id)
                         ->first();

        $sub_cats = DB::table('sub_categories')
                         ->select('*')
                         ->get();
     
        $country = DB::table('country')
                     ->select('*')
                     ->get();
     
        $areas = DB::table('area')
                 ->select('*')
                 ->get();

        return view('store.items.edit', compact('items','sub_cats','country','areas'));
    }

    public function updateItems(Request $request, $id)
    {
        // dd($request->all());
        if ($request->status == 'on')
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }
        DB::table('items')
            ->where('item_ID',$id)
            ->update([
            'price' => $request->to,
            'sub_cat_id' => $request->sub_cat,
            'city_id' => $request->city,
            'area_id' => $request->area,
            'stock' => $request->stock,
            'status' => $status,
        ]);
        Session::flash('success','Item Has Been Updated Successfully !');
        return redirect()->route('items.index');
    }

    public function destroyItems($id)
    {
        DB::table('items')->where('item_ID',$id)->delete();
        return back();
    }



    public function storee()
    {
            return view('store.store.index');
    }
    
    
    //  public function unpaidOrders()
    // {
    //     if(Auth::User()->user_type != 3){

    //     $order_details = DB::table('fps_orders')
    //                     ->join('fps_coach_assign', 'fps_coach_assign.order_id', '=', 'fps_orders.id')
    //                     ->join('fps_users', 'fps_users.id', '=', 'fps_coach_assign.coach_id')
    //                     ->join('fps_games', 'fps_games.id', '=', 'fps_orders.game_id')
    //                     ->select('fps_orders.id as order_id', 'fps_orders.pacakage_id as pkg_name', 'fps_orders.total_coaches as coaches', 'fps_orders.total as total_amount', 'fps_orders.status as order_status', 'fps_orders.coach_status as coach_status', 'fps_orders.assing_date as assign_date', 'fps_orders.date as date', 'fps_users.fname as c-fname', 'fps_users.lname as c-lname','fps_games.name as game_name','fps_coach_assign.assign_date as coaching_date', 'fps_coach_assign.coach_status as coaching_status',DB::raw("( select GROUP_CONCAT( CONCAT(fname,' ', lname) SEPARATOR ' | ') from fps_coach_assign JOIN fps_users on fps_users.id = fps_coach_assign.coach_id WHERE fps_coach_assign.order_id = fps_orders.id) as coaches_name"))
    //                     ->where("fps_orders.status", 0)
    //                     ->orderBy('fps_orders.id', 'desc')
    //                     ->groupBy('fps_orders.id')
    //                     ->get();
    //                     // dd($order_details);
    //     return view('admin.order.unpaid', compact('order_details'));
    //     }
    //     else{

    //         abort(404, 'Page Not Found.');
    //     }



    // }
    
    
    //  public function datafetch(Request $request, $id)
    // {
    //         // $orders = fps_orders::where('coaches', Auth::User()->id)->where("status", 1)->orderByDesc('id')->get();

    //         $details = DB::table('fps_coach_assign')
    //                         ->join('fps_users', 'fps_users.id', '=', 'fps_coach_assign.coach_id')
    //                         ->join('fps_coach_gaming_details', 'fps_coach_gaming_details.coach_id', '=', 'fps_coach_assign.coach_id')
    //                         ->select('fps_users.fname', 'fps_users.lname', 'fps_coach_assign.assign_date', 'fps_coach_assign.coach_status', 'fps_coach_assign.coach_id', 'fps_coach_gaming_details.gamer_tag')
    //                         ->where("fps_coach_assign.order_id", $id)
    //                         ->get();
    //         // dd($details);
    //         // return view('instructor.order.index', compact('orders'));

    //         return response()->json([
    //             'data'=>$details,
    //         ]);


    // }
    
    // public function CoachDataFetch(Request $request, $id)
    // {
    //         // $orders = fps_orders::where('coaches', Auth::User()->id)->where("status", 1)->orderByDesc('id')->get();

    //         $coach_details = DB::table('fps_users')
    //                         ->join('fps_coach_gaming_details', 'fps_coach_gaming_details.coach_id', '=', 'fps_users.id')
    //                         ->select('fps_users.fname', 'fps_users.lname','fps_users.user_img', 'fps_users.email','fps_users.language', 'fps_coach_gaming_details.k_d_ratio', 'fps_coach_gaming_details.win_rate', 'fps_coach_gaming_details.gamer_tag')
    //                         ->where("fps_users.id", $id)
    //                         ->first();
    //         // dd($coach_details);
    //         // return view('instructor.order.index', compact('orders'));

    //         return response()->json([
    //             'data'=>$coach_details,
    //         ]);


    // }
    
    // public function TipAcoach(Request $request)
    // {

    //     $tip = $request->amount;

    //         $gamer_id = Auth::user()->id;
    //         $wallet_amnt = DB::table('fps_wallets')->select('*')->join('fps_wallet_records','fps_wallet_records.wallet_id','fps_wallets.id')->where('fps_wallets.userid', $gamer_id)->where('fps_wallets.is_active',1)->orderBy('fps_wallet_records.id', 'desc')->first();
    //         $user_id = Auth::User()->id;
    //         // dd($wallet_amnt);

    //         if($wallet_amnt->total >= $tip){

    //         $balance_amnt = $wallet_amnt->total - $tip;

    //                       DB::table('fps_wallet_records')->insert([
    //                           'wallet_id' => $wallet_amnt->wallet_id,
    //                         // 'credit_amount' => $paid_amnt,
    //                           'debit_amount' => $tip,
    //                           'total' => $balance_amnt,
    //                           'date' => date('Y-m-d h:i:s'),
    //                           ]);


    //                         DB::table('fps_tip_a_coach')->insert([
    //                             'gamer_id' => $user_id,
    //                             'coach_id' => $request->coach_id,
    //                             'description' => $request->description,
    //                             'amount' => $request->amount,
    //                             'date' => Carbon::now(),
    //                         ]);

    //                         return response()->json([
    //                             'status' => 200,
    //                             'message' => 'Your Tip $'.$tip.' has been sent successfully.'
    //                         ]);
    //         }
    //         else{
    //             return response()->json([
    //                 'status' => 404,
    //                 'message' => 'You dont have enough amount in a wallet.'
    //             ]);
    //         }



    // }
    
    // ---------------All tips record for admin---------------
    // public function allTips()
    // {
    //     $Tips_records = DB::table('fps_tip_a_coach')
    //                     ->join('fps_users', 'fps_users.id', '=', 'fps_tip_a_coach.coach_id')
    //                     ->join('fps_coach_gaming_details', 'fps_coach_gaming_details.coach_id', '=', 'fps_tip_a_coach.coach_id')
    //                     ->select('fps_tip_a_coach.description', 'fps_tip_a_coach.amount', 'fps_tip_a_coach.date','fps_tip_a_coach.gamer_id', 'fps_users.fname', 'fps_users.lname', 'fps_coach_gaming_details.gamer_tag' )
    //                     // ->where("gamer_id", Auth::User()->id)
    //                     ->orderByDesc('fps_tip_a_coach.id')
    //                     ->get();

    //                         // dd($Tips_records);
    //     return view('admin.tips.index', compact('Tips_records'));
    // }
    
    // ---------------All payout records for admin---------------
    //  public function allPayouts()
    //  {
    //      $payouts = DB::table('fps_coach_payouts')
    //                     ->join('fps_coach_gaming_details', 'fps_coach_gaming_details.coach_id', '=', 'fps_coach_payouts.coach_id')
    //                      ->select('fps_coach_payouts.id', 'fps_coach_payouts.coach_id', 'fps_coach_payouts.order_id', 'fps_coach_payouts.amount', 'fps_coach_payouts.status','fps_coach_payouts.trans_id', 'fps_coach_gaming_details.gamer_tag')
    //                      // ->where("gamer_id", Auth::User()->id)
    //                      ->orderByDesc('fps_coach_payouts.id')
    //                      ->get();

    //      return view('admin.pay_outs.index', compact('payouts'));
    //  }

    // Attribute Functions
    public function attributes()
    {
        $attributes = DB::table('attributes')
                            ->select('*')
                            ->orderBy('id', 'desc')
                            ->get();
            return view('store.attributes.index', compact('attributes'));
   
    }

     public function addAttr()
    {
        return view('store.attributes.add');
    }

    public function storeAttributes(Request $request)
    {
        DB::table('attributes')->insert([
            'title_English' => $request->title,
            'title_Author' => $request->title_author,
        ]);
        Session::flash('success','New Attribute has been Saved');
        return redirect()->route('attributes');
    }

    public function editAttribute($id)
    {
        $attribute = DB::table('attributes')
                         ->select('*')
                         ->where('ID', $id)
                         ->first();

                         return view('store.attributes.edit', compact('attribute'));
    }

    public function updateAttribute(Request $request, $id)
    {
        DB::table('attributes')
            ->where('ID',$id)
            ->update([
            'title_English' => $request->title,
            'title_Author' => $request->title_author
        ]);
        Session::flash('success','Attribute Has Been Updated Successfully !');
        return redirect()->route('attributes');
    }

    public function destroy($id)
    {
        DB::table('attributes')->where('ID',$id)->delete();
        return back();
    }
    

    //Categories Functions
    public function categories()
    {
        $categories = DB::table('categories')
                            ->select('*')
                            ->orderBy('id', 'desc')
                            ->get();
            return view('store.categories.index', compact('categories'));
   
    }

    public function addCategories()
    {
        return view('store.categories.add');
    }

    public function storeCategories(Request $request)
    {
        DB::table('categories')->insert([
            'title' => $request->title,
            'author' => $request->title_author,
        ]);
        Session::flash('success','New Category has been Saved');
        return redirect()->route('categories');
    }

    public function editCategories($id)
    {
        $categories = DB::table('categories')
                         ->select('*')
                         ->where('id', $id)
                         ->first();

                         return view('store.categories.edit', compact('categories'));
    }

    public function updateCategories(Request $request, $id)
    {
        DB::table('categories')
            ->where('id',$id)
            ->update([
            'title' => $request->title,
            'author' => $request->title_author
        ]);
        Session::flash('success','Category Has Been Updated Successfully !');
        return redirect()->route('categories');
    }

    public function destroyCategories($id)
    {
        DB::table('categories')->where('id',$id)->delete();
        return back();
    }

    //Sub_Categories Functions
    public function sub_categories()
    {
        $sub_categories = DB::table('sub_categories')
                            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
                            ->select('sub_categories.id', 'sub_categories.title', 'sub_categories.author', 'sub_categories.image', 'categories.title as mct')
                            ->orderBy('id', 'desc')
                            ->get();
            return view('store.sub_categories.index', compact('sub_categories'));
   
    }

    public function addSubCategories()
    {
        $categories = DB::table('categories')
                            ->select('*')
                            ->orderBy('id', 'desc')
                            ->get();

        return view('store.sub_categories.add', compact('categories'));
    }

    public function storeSubCategories(Request $request)
    {
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(('images/gamer/'), $imageName);

        DB::table('sub_categories')->insert([
            'category_id' => $request->category,
            'title' => $request->title,
            'author' => $request->title_author,
            'image' => $imageName
        ]);
        Session::flash('success','New Sub-Category has been Saved');
        return redirect()->route('sub_categories');
    }

    public function editSubCategories($id)
    {
        $sub_category = DB::table('sub_categories')
                            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
                            ->select('sub_categories.id', 'sub_categories.title', 'sub_categories.author', 'sub_categories.image', 'sub_categories.category_id', 'categories.title as mct', 'categories.id as mct_id')
                            ->orderBy('sub_categories.id', 'desc')
                            ->where('sub_categories.id',$id)
                            ->first();

        $categories = DB::table('categories')
                    ->select('*')
                    ->orderBy('id', 'desc')
                    ->get();

        return view('store.sub_categories.edit', compact('sub_category','categories'));
    }

    public function updateSubCategories(Request $request, $id)
    {
        $image = DB::table('sub_categories')
                ->select('*')
                ->where('id', $id)
                ->first();

         $filename = "";
          if($request->hasFile('image')){
              $destination = 'images/gamer/'.$image->image;
              if(File::exists($destination)){
                  File::delete($destination);
              }
              $file = $request->file('image');
              $extention = $file->getClientOriginalName();
              $filename = time().".".$extention;
              $file->move('images/gamer/',$filename);
            //   $input['image'] = $filename;
          }

        DB::table('sub_categories')
            ->where('id',$id)
            ->update([
            'category_id' => $request->category,
            'title' => $request->title,
            'author' => $request->title_author,
            'image' => $filename
        ]);
        Session::flash('success','Sub-Category Has Been Updated Successfully !');
        return redirect()->route('sub_categories');
    }

    public function destroySubCategories($id)
    {
        DB::table('sub_categories')->where('id',$id)->delete();
        return back();
    }
    

    //Countries Functions
    public function countries()
    {
        $countries = DB::table('country')
                            ->select('*')
                            ->orderBy('id', 'desc')
                            ->get();
            return view('store.countries.index', compact('countries'));
   
    }

    public function addCountries()
    {
        return view('store.countries.add');
    }

    public function storeCountries(Request $request)
    {

        DB::table('country')->insert([
            'name' => $request->name
        ]);
        Session::flash('success','New Country has been Saved');
        return redirect()->route('countries');
    }

    public function editCountries($id)
    {

        $countries = DB::table('country')
                    ->select('*')
                    ->where('id',$id)
                    ->orderBy('id', 'desc')
                    ->first();

        return view('store.countries.edit', compact('countries'));
    }

    public function updateCountries(Request $request, $id)
    {
        // dd($request->all() ,$id);
        DB::table('country')
            ->where('id',$id)
            ->update([
            'name' => $request->name
        ]);
        Session::flash('success','Country Has Been Updated Successfully !');
        return redirect()->route('countries');
    }

    public function destroyCountries($id)
    {
        DB::table('country')->where('id',$id)->delete();
        return back();
    }


    //Areas Functions
    public function areas()
    {
        $areas = DB::table('area')
                            ->join('country', 'country.id', '=', 'area.country_id')
                            ->select('area.id', 'area.area_name', 'country.name as country_name')
                            ->orderBy('id', 'desc')
                            ->get();
            return view('store.areas.index', compact('areas'));
   
    }

    public function addAreas()
    {
        $country = DB::table('country')
                            ->select('*')
                            ->orderBy('id', 'desc')
                            ->get();

        return view('store.areas.add', compact('country'));
    }

    public function storeAreas(Request $request)
    {
        DB::table('area')->insert([
            'area_name' => $request->name,
            'country_id' => $request->country
        ]);
        Session::flash('success','New Area has been Saved');
        return redirect()->route('areas');
    }

    public function editAreas($id)
    {
        $areas = DB::table('area')
                            ->join('country', 'country.id', '=', 'area.country_id')
                            ->select('area.id', 'area.area_name', 'country.name as country_name', 'country.id as country_id')
                            ->orderBy('id', 'desc')
                            ->where('area.id',$id)
                            ->first();

                            $country = DB::table('country')
                            ->select('*')
                            ->orderBy('id', 'desc')
                            ->get();

        return view('store.areas.edit', compact('areas','country'));
    }

    public function updateArea(Request $request, $id)
    {
        DB::table('area')
            ->where('id',$id)
            ->update([
            'area_name' => $request->name,
            'country_id' => $request->country
        ]);
        Session::flash('success','Area Has Been Updated Successfully !');
        return redirect()->route('areas');
    }

    public function destroyArea($id)
    {
        DB::table('area')->where('id',$id)->delete();
        return back();
    }
    
     // ---------------All chats record for admin---------------
    //   public function allChats()
    //   {

    //     $chats = DB::select(DB::raw("SELECT from_id,to_id,created_at FROM ( SELECT *, CASE WHEN from_id < to_id THEN CONCAT(from_id,'&', to_id)
    //             ELSE CONCAT(to_id,'&', from_id) END AS fromto FROM ch_messages) AS a GROUP BY fromto ORDER BY created_at DESC") );
    //                 // dd($chats);
    //                 // $chats = DB::table('ch_messages')
    //                 // ->join('fps_users', 'fps_users.id', '=', 'ch_messages.from_id')
    //                 // ->select('fps_users.fname', 'fps_users.lname',  DB::raw("SELECT from_id,to_id,body FROM ( SELECT *, CASE WHEN from_id < to_id THEN CONCAT(from_id,'&', to_id)
    //                 //          ELSE CONCAT(to_id,'&', from_id) END AS fromto FROM ch_messages) AS a GROUP BY fromto") );
    //                 // dd($chats);
    //       return view('admin.chats.index', compact('chats'));
    //   }
      
    //   public function chatHistory(Request $request)
    //   {
    //       $from_id = $request->from;
    //       $to_id = $request->to;

    //     //   $chat_history = DB::select(DB::raw("SELECT body,from_id FROM `ch_messages` where (from_id = $from_id AND to_id = $to_id) OR (from_id = $to_id AND to_id = $from_id)") );
    //     $chat_history = DB::select(DB::raw("SELECT ch_messages.body, ch_messages.from_id, fps_users.fname, fps_users.lname FROM `ch_messages` LEFT JOIN `fps_users` ON ch_messages.from_id = fps_users.id where (ch_messages.from_id = $from_id AND ch_messages.to_id = $to_id) OR (ch_messages.from_id = $to_id AND ch_messages.to_id = $from_id) ORDER BY ch_messages.created_at ASC") );
    //     // dd($chat_history);

    //     return response()->json([
    //     'from'=>$from_id,
    //     'to'=>$to_id,
    //     'data'=>$chat_history,
    //     'message'=>'success'
    //     ]);


    //   }
    
    // public function wallet()
    // {
    //     $wallet = fps_wallet::select("*")->where("userid", Auth::User()->id)->first();

    //     $current_bal = fps_wallet_records::select("*")
    //     ->where("wallet_id", $wallet->id)
    //     ->orderByDesc('id')
    //     ->first();
    //     // $total = $current_bal->total;
    //     // dd($total);

    //     $wallet_infos = fps_wallet_records::select("*")
    //     ->where("wallet_id", $wallet->id)
    //     ->orderByDesc('id')
    //     ->get();
    //     // dd($wallet_infos);
    //     return view('gamer.wallet.index', compact('wallet_infos', 'current_bal'));

    // }
    
    // public function tips()
    // {
    //     $tips = DB::table('fps_tip_a_coach')
    //             ->join('fps_coach_gaming_details', 'fps_coach_gaming_details.coach_id', '=', 'fps_tip_a_coach.coach_id')
    //             ->select('fps_tip_a_coach.description', 'fps_tip_a_coach.amount', 'fps_tip_a_coach.date', 'fps_coach_gaming_details.gamer_tag' )
    //             ->where("gamer_id", Auth::User()->id)
    //             ->orderByDesc('fps_tip_a_coach.id')
    //             ->get();
    //     // dd($tips);
    //     return view('gamer.tips.index', compact('tips'));

    // }

    // public function create()
    // {
    //     $users = User::all();
    //     $courses = Course::all();
    //     return view('admin.order.create', compact('users', 'courses'));
    // }

    // public function store(Request $request)
    // {
    //     $created_order = Order::create([
    //         'course_id' => $request->course_id,
    //         'user_id' => $request->user_id,
    //         'instructor_id' => $request->user_id,
    //         'payment_method' => 'Admin Enroll',
    //         'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
    //         ]
    //     );

    //     Session::flash('success','Enrolled Successfully !');
    //     return redirect('order');
    // }

   

    // public function vieworder($id)
    // {
    //     $setting = Setting::first();
    //     $show = Order::where('id', $id)->first();
    //     return view('admin.order.view', compact('show', 'setting'));
    // }

    // public function purchasehistory()
    // {
    //     $course = Course::all();
    //     $orders = Order::all();
    //     if(Auth::check())
    //     {
    //         return view('front.purchase_history.purchase',compact('orders', 'course'));
    //     }
    //     return Redirect::route('login')->withInput()->with('delete', 'Please Login to access restricted area.');
    // }

    // public function invoice($id)
    // {
    //     $course = Course::all();
    //     $Bundle = BundleCourse::all();
    //     $orders = Order::where('id', $id)->first();

    //     $bundle_order = BundleCourse::where('id', $orders->bundle_id)->first();

    //     if(Auth::check())
    //     {
    //         return view('front.purchase_history.invoice',compact('orders', 'course', 'Bundle', 'bundle_order'));
    //     }

    //     return Redirect::route('login')->withInput()->with('delete', 'Please Login to access restricted area.');
    // }

    // public function pdfdownload($id){
    //     $course = Course::all();
    //     $orders = Order::where('id', $id)->first();

    //     $bundle_order = BundleCourse::where('id', $orders->bundle_id)->first();

    //     $pdf = PDF::loadView('front.purchase_history.download', compact('orders','course', 'bundle_order'))->setPaper('a4', 'landscape');
    //     return $pdf->download('invoice.pdf');
    //     // return $pdf->stream();

    // }
    
    //  public function email(){
    //     return view('email.email');

    // }
    
    //   public function chatwithcoach($id){
    //     // dd($id);
    //     $coaches = DB::table('fps_orders')
    //                         ->join('fps_coach_assign', 'fps_coach_assign.order_id', '=', 'fps_orders.id')
    //                         ->select('fps_orders.user_id', 'fps_coach_assign.coach_id' )
    //                         ->where("fps_orders.user_id", Auth::User()->id)
    //                         ->where("fps_coach_assign.coach_id", $id)
    //                         ->first();
    //                         // ->distinct('fps_coach_assign.coach_id')
    //                         // ->get()->toArray();

    //                         // dd($coaches);

    //                         if($coaches == null){
    //                             // $msg = "not found";
    //                             return response()->json([
    //                                 'status'=>202,
    //                                 'message'=>"Sorry! you are not connect with this coach.",
    //                             ]);
    //                         }
    //                         else{
    //                             // return redirect('chatify/');
    //                             return response()->json([
    //                                 'status'=>200,
    //                                 'message'=>$coaches,
    //                             ]);
    //                         }

    // }
  
}
