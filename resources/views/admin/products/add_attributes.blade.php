@extends('layouts.adminLayout.admin_design')

@section('content')
<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Mohit Admin</a></h1>
</div>
<!--close-Header-part--> 

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products Attributes</a> <a href="#" class="current">Add Attributes</a> </div>
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
            <h5>Add Product Attributes</h5>

          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/add-attributes/'.$productDetails->id)}}" name="basic_validate" id="basic_validate">
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
         <div class="field_wrapper">
         <div>
        <input type="text" name="sku[]" placeholder="Sku" required style="width: 120px;" >
        <input type="text" name="size[]" placeholder="Size" style="width: 120px;" required>
        <input type="text" name="price[]" placeholder="Price" style="width: 120px;" required>
        <input type="text" name="stock[]" placeholder="Stock" style="width: 120px;" required>
        <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
           </div>
           </div>
              </div>          
                <div class="form-actions">
                <input type="submit" value="Add Attribute" class="btn btn-success">
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
            <h5>Attributes Details</h5>
          </div>
          <div class="widget-content nopadding">
        <form class="form-horizontal" method="post" action="{{url('/admin/edit-attributes/'.$productDetails->id)}}" name="basic_validate" id="basic_validate">
              {{csrf_field()}}
            <table class="table table-bordered data-table" id="myTable">
              <thead>
                <tr>
                  <th>Attribute Id</th>
                  <th>Sku</th>
                  <th>Size</th>
                  <th>Price</th>
                  <th>Stock</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                    @foreach($productDetails['attributes'] as $attribute)
                <tr class="gradeU">
                  <td><input type="hidden" name="idAttr[]" value="{{$attribute->id}}">{{$attribute->id}}</td>
                  <td>{{$attribute->sku}}</td>
                  <td>{{$attribute->size}}</td>
                  <td><input type="text" name="price[]" value="{{$attribute->price}}"></td>
                  <td><input type="text" name="stock[]" value="{{$attribute->stock}}"></td>
                  
                  <td class="center">
                    <input type="submit" name="" value="Update" class="btn btn-info btn-mini">
                 <a href="{{url('/admin/delete-attribute/'.$attribute->id)}}" class="btn btn-danger btn-mini">Delete</a></td>
                </tr>
                   @endforeach
              </tbody>
            </table>
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