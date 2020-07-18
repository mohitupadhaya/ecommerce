@extends('layouts.adminLayout.admin_design')

@section('content')
<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Matrix Admin</a></h1>
</div>
<!--close-Header-part--> 



<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Categories</a> <a href="#" class="current">Edit Category</a> </div>
    <h1>Category</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Category</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/edit-category/'.$categoryDetails->id)}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
              {{csrf_field()}}
              <div class="control-group">
                <label class="control-label">Category Name</label>
                <div class="controls">
                  <input type="text" name="category" id="category" value="{{$categoryDetails->name}}">
                </div>
              </div>
                <div class="control-group">
                <label class="control-label">Category Level</label>
                <div class="controls">
                <select name="parent_id">
                  <option value="0">Main Category</option>
                  @foreach($levels as $val)
                  <option value="{{$val->id}}" @if($val->id==$categoryDetails->parent_id)selected @endif >{{$val->name}}</option>
                  @endforeach

                </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                  <input type="text" name="description" id="description" value="{{$categoryDetails->description}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Url</label>
                <div class="controls">
                  <input type="text" name="url" id="url" value="{{$categoryDetails->url}}">
                </div>
              </div>
                <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="url" @if($categoryDetails->status=="1")checked @endif value="1">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Update Category" class="btn btn-success">
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