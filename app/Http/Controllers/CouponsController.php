<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Coupon;
class CouponsController extends Controller
{
   public function addCoupon(Request $request){
       if($request->isMethod('post')){
        $data=$request->all();
        echo "<pre>";print_r($data);die();

       }
   	return view('admin.coupon.add_coupon');

   }
}
