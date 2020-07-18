@extends('layouts.adminLayout.admin_design')

@section('content')
<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Mohit Admin</a></h1>
</div>
<!--close-Header-part--> 



<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">Edit Product</a> </div>
    <h1>Product</h1>
  </div>
    @if(Session::has('flash_message_success'))    
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong> {!! session('flash_message_success')!!}</strong>
        </div>
        @endif    
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Product</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/edit-product/'.$productDetails->id)}}" name="basic_validate" id="basic_validate" novalidate="novalidate" enctype="multipart/form-data">
              {{csrf_field()}}
               <div class="control-group">
                <label class="control-label">Under Category</label>
                <div class="controls">
                <select name="category_id" required="">
                  <option value="0">Main Category</option>
                 <?php echo $categories_dropdown;?>
                </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Product Name</label>
                <div class="controls">
                  <input type="text" name="product_name" id="category" value="{{$productDetails->product_name}}">
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Product Code</label>
                <div class="controls">
                  <input type="text" name="product_code" id="category" value="{{$productDetails->product_code}}">
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Product Color</label>
                <div class="controls">
                  <input type="text" name="product_color" id="category" value="{{$productDetails->product_color}}">
                </div>
              </div>
                
              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                 <textarea name="description">{{$productDetails->description}}</textarea>
                </div>
              </div>
                <div class="control-group">
                <label class="control-label">Product Price</label>
                <div class="controls">
                  <input type="text" name="product_price" id="price" value="{{$productDetails->price}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Image</label>
                <div class="controls">
                  <input type="file" name="image" id="url" required="">
                  <input type="hidden" name="current_image" value="{{$productDetails->image}}">
                  @if($productDetails->image)
                  <img src="{{asset('/images/backend_images/products/small/'.$productDetails->image)}}" width="50px;">  |<a href="{{url('admin/delete-product-image/'.$productDetails->id)}}}">Delete</a>
                  @endif
                </div>
              </div>
            <!--   <div class="control-group">
              <label class="control-label">File upload input</label>
              <div class="controls">
                <input type="file" />
                <div class="uploader" id="uniform-undefined"><input type="file" size="19" style="opacity: 0;" name="image"><span class="filename">No file selected</span><span class="action">Choose File</span></div>
              </div>
            </div> -->
              <div class="form-actions">
                <input type="submit" value="Edit Product" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>

</body>
</html>
@endsection