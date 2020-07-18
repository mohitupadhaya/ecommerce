@extends('layouts.adminLayout.admin_design')

@section('content')
<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Matrix Admin</a></h1>
</div>
<!--close-Header-part--> 



<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Categories</a> <a href="#" class="current">Add Category</a> </div>
    <h1>Category</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add Category</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/add-category')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
              {{csrf_field()}}
              <div class="control-group">
                <label class="control-label">Category Name</label>
                <div class="controls">
                  <input type="text" name="category" id="category" required>
                </div>
              </div>
                <div class="control-group">
                <label class="control-label">Category Level</label>
                <div class="controls">
                <select name="parent_id">
                  <option value="0">Main Category</option>
                  @foreach($levels as $val)

                  <option value="{{$val->id}}">{{$val->name}}</option>
                  
                  @endforeach

                </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                  <input type="text" name="description" id="description" required="">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Url</label>
                <div class="controls">
                  <input type="text" name="url" id="url" required="">
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="url" value="1">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add" class="btn btn-success">
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