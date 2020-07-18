<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Session;
use Image;
use App\Category;
use App\Product;
use App\ProductsAttributes;
use App\ProductsImage;
use DB;
class ProductsController extends Controller
{
    public function addProduct(Request $request){
    	if($request->isMethod('post')){
    		$data=$request->all();
    		if(empty($data['category_id'])){
    		return redirect()->back()->with('flash_message_error','Under Category is Missing');
    		}
    		$product=new Product();
    		$product->category_id=$data['category_id'];
    		$product->product_name=$data['product_name'];
    		$product->product_code=$data['product_code'];
    		$product->product_color=$data['product_color'];
    		$product->price=$data['product_price'];
    		if(!empty($data['description'])){
    		$product->description=$data['description'];	
    		}else{
    		$product->description='';	
    		}
    	//upload Image
    		if($request->hasfile('image')){
    		$image_tmp=Input::file('image');
    		if($image_tmp->isValid()){
    		        $extension=$image_tmp->getClientOriginalExtension();
    				$filename=rand(111,99999).'.'.$extension;
    				$large_image_path='images/backend_images/products/large/'.$filename;
    				$medium_image_path='images/backend_images/products/medium/'.$filename;
    				$small_image_path='images/backend_images/products/small/'.$filename;
    				// Resize Images
    				Image::make($image_tmp)->save($large_image_path);
    				Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
    				Image::make($image_tmp)->resize(300,300)->save($small_image_path);
    				$product->image=$filename;
    			}
    		}
    		  $product->save();
    		  return redirect('/admin/view-product')->with('flash_message_success','Product Added Successfully');
    	}
    	// for dropdown category start
    	$categories=Category::where(['parent_id'=>0])->get();
    	$categories_dropdown="<option selected disabled>Select</option>";
    	foreach($categories as $cat){
    	$categories_dropdown.="<option value='".$cat->id."'>".$cat->name."</option>";
    	$sub_categories=Category::where(['parent_id'=>$cat->id])->get();
    	foreach ($sub_categories as $sub_cat){
    	$categories_dropdown.="<option value='".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";
    		}
    	}
// end dropdown category
    	return view('admin.products.add_product')->with(compact('categories_dropdown'));
    }

    public function viewProduct(){
    	$products=Product::get();
    	foreach ($products as $key => $val) {
    		$category_name=Category::where(['id'=>$val->category_id])->first();
    		$products[$key]->category_name=$category_name->name;
         	}
    	return view('admin.products.view_product')->with(compact('products'));
        }

    public function editProduct(Request $request,$id=null){
    	if($request->isMethod('post')){
    		$data=$request->all();

    			if($request->hasfile('image')){
    		$image_tmp=Input::file('image');
    		if($image_tmp->isValid()){
    		        $extension=$image_tmp->getClientOriginalExtension();
    				$filename=rand(111,99999).'.'.$extension;
    				$large_image_path='images/backend_images/products/large/'.$filename;
    				$medium_image_path='images/backend_images/products/medium/'.$filename;
    				$small_image_path='images/backend_images/products/small/'.$filename;
    				// Resize Images
    				Image::make($image_tmp)->save($large_image_path);
    				Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
    				Image::make($image_tmp)->resize(300,300)->save($small_image_path);
    				
    			}
    		}else{
    				$filename=$data['current_image'];
    		}
    		$array=array(
    			'category_id'=>$data['category_id'],
    			'product_name'=>$data['product_name'],
    			'product_code'=>$data['product_code'],
    			'product_color'=>$data['product_color'],
    			'price'=>$data['product_price'],
    			'description'=>$data['description'],
    			'image'=>$filename
    		);
    		$Product=Product::where(['id'=>$id])->update($array);
    		return redirect('/admin/view-product')->with('flash_message_success','Product updated successfully');

    	}
       $productDetails=Product::where(['id'=>$id])->first();
       // for dropdown category start
    	$categories=Category::where(['parent_id'=>0])->get();
    	$categories_dropdown="<option selected disabled>Select</option>";
    	foreach($categories as $cat){
    		if($cat->id==$productDetails->category_id){
    			$selected="selected";
    		}else{
    			$selected="";
    		}
    	$categories_dropdown.="<option value='".$cat->id."' ".$selected.">".$cat->name."</option>";
    	$sub_categories=Category::where(['parent_id'=>$cat->id])->get();
    	foreach ($sub_categories as $sub_cat){
    		if($sub_cat->id==$productDetails->category_id){
    			$selected="selected";
    		}else{
    			$selected="";
    		}
    	$categories_dropdown.="<option value='".$sub_cat->id."' ".$selected.">&nbsp;--&nbsp;".$sub_cat->name."</option>";
    		}
    	}
// end dropdown category
       return view('admin.products.edit_product')->with(compact('productDetails','categories_dropdown'));

    }
public function deleteImage($id=null){
    if(!empty($id)){
        $productImage=ProductsImage::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Product image deleted successfully');
    }

}

    public function deleteProductImage($id=null){
        // get product image

        $productImage=Product::where(['id'=>$id])->first();
        // get product image path
        $large_image_path='images/backend_images/products/large/';
        $medium_image_path='images/backend_images/products/medium/';
        $small_image_path='images/backend_images/products/small/';
     //delete large image if not exist in folder
        if(file_exists($large_image_path)){
            unlink($large_image_path.$productImage->image);

        }
          //delete medium image if not exist in folder
        if(file_exists($medium_image_path)){
            unlink($medium_image_path.$productImage->image);

        }
          //delete large image if not exist in folder
        if(file_exists($small_image_path)){
            unlink($small_image_path.$productImage->image);

        }
    	$product=Product::where(['id'=>$id])->update(['image'=>'']);
    	return redirect()->back()->with('flash_message_success','Product Image has been deleted');
    }
    public function deletetProduct($id=null){
    	if(!empty($id)){

    		Product::where(['id'=>$id])->delete();
    		return redirect('/admin/view-product')->with('flash_message_success','Product has been deleted');
    	}

    }
    public function addAttributes(Request $request,$id=null){
    	$productDetails=Product::with('attributes')->where(['id'=>$id])->first();
    	
    	 // echo "<pre>";print_r($productDetails);die();
    	if($request->isMethod('post')){
    		$data=$request->all();

    		foreach($data['sku'] as $key=>$val){
    			if(!empty($val)){
    				$attribut=new ProductsAttributes();
    				$attribut->product_id=$id;
    				$attribut->sku=$val;
    				$attribut->size=$data['size'][$key];
    				$attribut->price=$data['price'][$key];
    				$attribut->stock=$data['stock'][$key];
    				$attribut->save();

    			}
    		}
    		return redirect('/admin/add-attributes/'.$id)->with('flash_message_success','Product Attributes Added successfully');
    	}
         return view('admin.products.add_attributes')->with(compact('productDetails'));	
    }
public function addImage(Request $request,$id=null){
    $productDetails=Product::with('attributes')->where(['id'=>$id])->first();
    if($request->isMethod('post')){
        $data=$request->all();
           // echo "<pre>";print_r($data);die();
        if($request->hasfile('image')){
            $files=$request->file('image');
           foreach($files as $file){
            $image=new ProductsImage();
            $extension=$file->getClientOriginalExtension();
            $filename=rand(111,99999).'.'.$extension;
            $large_image_path='images/backend_images/products/large'.$filename;
            $medium_image_path='images/backend_images/products/medium'.$filename;
            $small_image_path='images/backend_images/products/small'.$filename;
            Image::make($file)->save($large_image_path);
            Image::make($file)->resize(600,600)->save($medium_image_path);
            Image::make($file)->resize(300,300)->save($small_image_path);
            $image->image=$filename;
            $image->product_id=$data['product_id'];
            // print_r($image->product_id);die();
            $image->save();

        }
        }
        return redirect('/admin/add-images/'.$id)->with('flash_message_success','Product Image has been successfully');
    }
    $productsImage=ProductsImage::where(['product_id'=>$id])->get();
    // echo "<pre>";print_r($ProductsImage);die();
     return view('admin.products.add_image')->with(compact('productDetails','productsImage'));
    }

    public function deleteAttributes($id=null){
    	if(!empty($id)){
    		$product=Product::where(['id'=>$id])->delete();
    		return redirect()->back()->with('flash_message_success','Product Attribute Deleted Successfully');
    	}
    }
    public function products($url=null){

        // if category url does not exist then show 404 error page show
        $categoryCount=Category::where(['url'=>$url,'status'=>1])->count();
        if($categoryCount==0){
           return view('404');
        }

        $categoryDetails=Category::where(['url'=>$url])->first();
        if($categoryDetails->parent_id==0){
            // if url is main category
            $sub_categories=Category::where(['parent_id'=>$categoryDetails->id])->get();
            foreach($sub_categories as $subcat){
                $cat_id[]=$subcat->id;
            }
               $productAll=Product::whereIn('category_id',$cat_id)->get();
               $productAll=json_decode(json_encode($productAll));
             // echo "<pre>";print_r($productAll);die();
        }else{
            // if url is sub categorys
             $productAll=Product::where(['category_id'=>$categoryDetails->id])->get();
        }
        $categories=Category::with('categories')->where(['parent_id'=>0])->get();
        return view('products.listing')->with(compact('categoryDetails','productAll','categories'));
    }

    public function product($id=null){
            $productDetail=Product::where(['id'=>$id])->first();
            $categories=Category::with('categories')->where(['parent_id'=>0])->get();
            $productAltImage=ProductsImage::where(['product_id'=>$id])->get();
            $productAltImage=json_decode(json_encode($productAltImage));
            // echo "<pre>";print_r($productAltImage);die();
            // for product stock
            // recommended products
            $relatedProducts=Product::where('id','!=',$id)->where(['category_id'=>$productDetail->category_id])->get();
                // $relatedProducts=json_decode(json_encode($relatedProducts));
             



            $stock_prod=ProductsAttributes::where('product_id',$id)->sum('stock');
        return view('products.detail')->with(compact('productDetail','categories','productAltImage','stock_prod','relatedProducts'));
    }

    public function productPrice(Request $request){
                // die('error');
               $data=$request->all();
               // echo "<pre>";print_r($data);die();
               $proArr=explode(",",$data['idSize']);
               $proArr=ProductsAttributes::where(['product_id'=>$proArr[0],'size'=>$proArr[1]])->first();
               echo $proArr->price;
               echo "#";
               echo $proArr->size;
    }
    public function editAttributes(Request $request,$id=null){
                  
                if($request->isMethod('post')){
                 $data=$request->all();
                 foreach ($data['idAttr'] as $key => $Attr) {
                ProductsAttributes::where(['id'=>$data['idAttr'][$key]])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
                 }
        return redirect()->back()->with('flash_message_success','Product Attribute Update Successfully');
                }
               
}
// Product add to cart
public function addtoCart(Request $request){
         $data=$request->all();
         // echo "<pre>";print_r($data);die();
         if(empty($data['user_email'])){
            $data['user_email']='';
         }
        $session_id=str_random(40);
        session::put('session_id',$session_id);
          // echo "<pre>";print_r($data);die();
        $countProduct=  DB::table('cart')->where(['product_id'=>$data['product_id'],'size'=>$data['size']])->count();
        if($countProduct>0){
            return redirect()->back()->with('flash_message_error','product already exist in cart');
        }else{

    DB::table('cart')->insert(['product_id'=>$data['product_id'],'product_name'=>$data['product_name'],'product_code'=>$data['product_code'],'product_color'=>$data['product_color'],'size'=>$data['size'],'price'=>$data['price'],'quantity'=>$data['quantity'],'session_id'=>$session_id,'user_email'=>$data['user_email']]);
    
        }
    

        
         return redirect('/cart')->with('flash_message_success','Product Added To cart successfully'); 
}

public function Cart(){
    $session_id=session::get('session_id');
    // $cartDetail=DB::table('cart')->where(['session_id'=>$session_id])->get();
    $cartDetail=DB::table('cart')->get();
    $cartDetail=json_decode(json_encode($cartDetail));
    // echo "<pre>";print_r($cartDetail);die();
    foreach ($cartDetail as $key => $cart) {
        $product=Product::where(['id'=>$cart->product_id])->first();
        $cartDetail[$key]->image=$product->image;
    }
     // echo "<pre>";print_r($cartDetail);die();
    return view('products.cart')->with(compact('cartDetail'));
}
// for delete product from cart
public function cartDeleteproduct($id=null){
    $cart=DB::table('cart')->where(['id'=>$id])->delete();
    return redirect()->back()->with('flash_message_success','Product has been deleted from cart');
    
}
// for update product quantity
public function updateProductquantity($id=null,$quantity=null){
    $cartDetail=DB::table('cart')->where('id',$id)->first();
    $getAttributeStock=ProductsAttributes::where('sku',$cartDetail->product_code)->first();
    $updated_quantity=$cartDetail->quantity+$quantity;
    
      $cart=DB::table('cart')->where('id',$id)->increment('quantity',$quantity);
     return redirect()->back()->with('flash_message_success','Product quantity updated successfuly');
   
    

}
}

