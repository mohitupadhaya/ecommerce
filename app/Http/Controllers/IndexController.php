<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
class IndexController extends Controller
{
    public function index(){
    	$productAll=Product::orderBy('id','DESC')->get();
    	$productAll=Product::inRandomOrder()->get();
    	// echo "<pre>";print_r($productAll);die();
    	$categories=Category::with('categories')->where(['parent_id'=>0])->get();
    

    	return view('shop')->with(compact('productAll','categories'));
    }
}
