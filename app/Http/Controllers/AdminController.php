<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Session;
class AdminController extends Controller
{
    public function login(Request $request){
    	if($request->isMethod('post')){
         $data=$request->input();
         if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])){
         	session::put('adminSession',$data['email']);
         return redirect('/admin/dashboard');
         }else{

         return redirect('/admin')->with('flash_message_error','Invalid username or password');
         }
    	}

        return view('admin.admin_login');
    }

    public function dashboard(){
    	if(session::has('adminSession')){
    		return view('admin.dashboard');

    	}else{
    		return redirect('/admin')->with('flash_message_error','please login to access');
    	}
    	
    }

    public function logout(){
    	session::flush();
    	  return redirect('/admin')->with('flash_message_success','logged out successfully');
    }

    }
