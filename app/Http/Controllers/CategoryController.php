<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
   public function addCategory(Request $request){
   	if($request->isMethod('post')){
   		$data=$request->all();
         if(empty($data['status'])){
            $status="0";
         }else{
            $status="1";
         }
   		$category=new Category();
   		$category->name=$data['category'];
   		$category->description=$data['description'];
   		$category->parent_id=$data['parent_id'];
   		$category->url=$data['url'];
         $category->status=$status;
   		$category->save();
   		return redirect('/admin/view-category')->with('flash_message_success','Category Added Successfully');
   	}
   	$levels=Category::where(['parent_id'=>0])->get();
   	return view('admin.categories.add_category')->with(compact('levels'));
   }
   public function viewCategory(){
   	$categories=Category::get();
   	return view('admin.categories.view_category')->with(compact('categories'));

   }
   public function editCategory(Request $request,$id=null){
   	if($request->isMethod('post')){
   		$data=$request->all();
          if(empty($data['status'])){
            $status="0";
         }else{
            $status="1";
         }
   		Category::where(['id'=>$id])->update(['name'=>$data['category'],'description'=>$data['description'],'url'=>$data['url'],'status'=>$status]);
   		return redirect('/admin/view-category')->with('flash_message_success','Category Updated Successfully');
   	}
    $categoryDetails=Category::where(['id'=>$id])->first();
    $levels=Category::where(['parent_id'=>0])->get();
   	return view('admin.categories.edit_category')->with(compact('categoryDetails','levels'));
   }

   public function deleteCategory($id=null){
   		if(!empty($id)){
   	$category=Category::where(['id'=>$id])->delete();
   	return redirect('/admin/view-category')->with('flash_message_success','Category Deleted Successfully');
}

   }
}
