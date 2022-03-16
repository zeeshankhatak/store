<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use App\Categories;
use App\Course;
use DB;
use Session;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Coupon_details = Coupon::all();
        // $Coupon_details = DB::table('fps_coupans')
        //                 ->select('*')
        //                 ->get();
                        // dd($Coupon_details);
        return view('admin.coupan.index', compact('Coupon_details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupan.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::table('fps_coupans')->insert([
            'coupan_code' => $request->code,
            'amount' => $request->amount,
        ]);
        Session::flash('success','Coupan Has Been Created !');
        return redirect()->route('all.coupons');
    }



    public function show($id)
    {
        //
    }



    public function edit($id)
    {
        $coupon_id = DB::table('fps_coupans')
                    ->select('*')
                    ->where("id", $id)
                    ->first();
                    // dd($coupon_id);

        if($coupon_id->status == 0)
        {
            DB::table('fps_coupans')->where('id','=',$id)->update(['status' => "1"]);
            return back()->with('success','Status changed to Active !');

        }
        else
        {
            DB::table('fps_coupans')->where('id','=',$id)->update(['status' => "0"]);
            return back()->with('success','Status changed to In-Active !');
        }

    }



    public function update(Request $request, $id)
    {
        // $input = $request->all();
        // $newc = Coupon::find($id);

        // if($request->link_by == 'product'){
        //     $input['minamount'] = NULL;
        // }else{
        //     $input['pro_id'] = NULL;
        // }

        // $newc->update($input);

        // return redirect("coupon")->with("success","Coupan Has Been Updated !");
    }

    public function destroy($id)
    {
        $newc = Coupon::find($id);
        if(isset($newc)){
            $newc->delete();
            return back()->with('success','Coupon has been deleted');
        }else{
            return back()->with('delete','404 | Coupon not found !');
        }
    }
}
