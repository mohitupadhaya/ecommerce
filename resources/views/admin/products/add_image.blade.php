@extends('layouts.adminLayout.admin_design')

@section('content')
<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Mohit Admin</a></h1>
</div>
<!--close-Header-part--> 

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products Image</a> <a href="#" class="current">Add Image</a> </div>
    <h1>Product</h1>
          @if(Session::has('flash_message_success'))    
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong> {!! session('flash_message_success')!!}</strong>
        </div>
        @endif        
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add Product Image</h5>

          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/add-images/'.$productDetails->id)}}" name="basic_validate" id="basic_validate" enctype="multipart/form-data">
              {{csrf_field()}}
              <input type="hidden" name="product_id" value="{{$productDetails->id}}">
              <div class="control-group">
                <label class="control-label">Product Name</label>
               <label class="control-label"><strong>{{$productDetails->product_name}}</strong></label>
              </div>
               <div class="control-group">
                <label class="control-label">Product Code</label>
                <label class="control-label"><strong>{{$productDetails->product_code}}</strong></label>
              </div>
               <div class="control-group">
                <label class="control-label">Product Color</label>
                <label class="control-label"><strong>{{$productDetails->product_color}}</strong></label>
              </div>
                 <div class="control-group">
                <label class="control-label"></label>
         <div class="control-group">
                <label class="control-label">Image</label>
                <div class="controls">
                  <input type="file" name="image[]" id="image" multiple="multiple">
                </div>
              </div>
              </div>          
                <div class="form-actions">
                <input type="submit" value="Add Image" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
      <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Product Image</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table" id="myTable">
              <thead>
                <tr>
                  <th>Image Id</th>
                  <th>Product Id</th>
                  <th>Image</th>
                
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                  @foreach($productsImage as $img)
                <tr class="gradeU">
                  <td>{{$img->id}}</td>
                  <td>{{$img->product_id}}</td>
                  <td>
                    <img src="{{asset('images/backend_images/products/small'.$img->image)}}" style="width: 120px;">
                  </td>
  
                  
                  <td class="center"> <a href="{{url('/admin/delete-image/'.$img->id)}}" class="btn btn-danger btn-mini">Delete</a></td>
                </tr>
                 @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>

</body>
</html>
@endsection