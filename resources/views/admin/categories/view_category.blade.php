@extends('layouts.adminLayout.admin_design')

@section('content')
<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Matrix Admin</a></h1>
</div>
<!--close-Header-part--> 

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Category</a> </div>
    <h1>Category</h1>
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
            <h5>Category Details</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table" id="myTable">
              <thead>
                <tr>
                  <th>Category Id</th>
                  <th>Category Name</th>
                  <th>Description</th>
                  <th>Category Levels</th>
                  <th>Url</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                    @foreach($categories as $cat)
                <tr class="gradeU">
                  <td>{{$cat->id}}</td>
                  <td>{{$cat->name}}</td>
                  <td>{{$cat->description}}</td>
                  <td>{{$cat->parent_id}}</td>
                  <td>{{$cat->url}}</td>
                  <td class="center"><a href="{{url('/admin/edit-category/'.$cat->id)}}" class="btn btn-primary btn-mini">Edit</a>   <a href="{{url('/admin/delete-category/'.$cat->id)}}" class="btn btn-danger btn-mini">Delete</a></td>
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
@endsection