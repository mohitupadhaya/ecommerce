@extends('layouts.adminLayout.admin_design')

@section('content')
<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Matrix Admin</a></h1>
</div>
<!--close-Header-part--> 

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Products</a> </div>
    <h1>Products</h1>
       @if(Session::has('flash_message_success'))    
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong> {!! session('flash_message_success')!!}</strong>
        </div>
        @endif        
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Products Details</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table" id="myTable">
              <thead>
                <tr>
                  <th>Product Id</th>
                  <th>Category Id</th>
                  <th>Category Name</th>
                  <th>Product Name</th>
                  <th>Product Code</th>
                  <th>Product color</th>
                  <th>Product Price</th>
                  <th>Product Image</th>
                  <th>Description</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                    @foreach($products as $prod)
                <tr class="gradeU">
                  <td>{{$prod->id}}</td>
                  <td>{{$prod->category_id}}</td>
                  <td>{{$prod->category_name}}</td>
                  <td>{{$prod->product_name}}</td>
                  <td>{{$prod->product_code}}</td>
                  <td>{{$prod->product_color}}</td>
                  <td>{{$prod->price}}</td>
                  <td>
                    <img src="{{asset('/images/backend_images/products/small/'.$prod->image)}}" style="width: 70px;">

                  </td>
                  <td>{{$prod->description}}</td>
                  
                  <td class="center"><a href="#myModal{{$prod->id}}" data-toggle="modal" class="btn btn-success btn-mini" title="View Products">View</a>   <a href="{{url('/admin/add-attributes/'.$prod->id)}}" class="btn btn-success btn-mini" title="Add Attributes">Add</a> <a href="{{url('/admin/add-images/'.$prod->id)}}" class="btn btn-info btn-mini" title="Add Image">Add</a>   <a href="{{url('/admin/edit-product/'.$prod->id)}}" class="btn btn-primary btn-mini" title="Edit Products">Edit</a>   <a href="{{url('/admin/delete-product/'.$prod->id)}}" class="btn btn-danger btn-mini" title="Delete Products">Delete</a></td>
                </tr>
               
            <div id="myModal{{$prod->id}}" class="modal hide">
              <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">×</button>
                <h3>{{$prod->product_name}} Full Details</h3>
              </div>
              <div class="modal-body">
                <p>Product Id:{{$prod->id}}</p>
                <p>Category Id:{{$prod->category_id}}</p>
                <p>Category Name:{{$prod->category_name}}</p>
                <p>Product Name:{{$prod->product_name}}</p>
                <p>Product Code:{{$prod->product_code}}</p>
                <p>Product Color:{{$prod->product_color}}</p>
                <p>Product Price:{{$prod->price}}</p>
                <p>Product Description:{{$prod->description}}</p>
              </div>
            </div>      
        
                   @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection