@extends('layouts.adminLayout.admin_design')

@section('content')
<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Mohit Admin</a></h1>
</div>
<!--close-Header-part--> 



<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Coupons</a> <a href="#" class="current">Add Coupon</a> </div>
    <h1>Coupons</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add Coupon</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/add-coupon')}}" name="couponcodeForm" id="couponcodeForm">

              {{csrf_field()}}
              <div class="control-group">
                <label class="control-label">Coupon Code</label>
                <div class="controls">
                  <input type="text" name="coupon_code" id="coupon_code" required>
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Amount</label>
                <div class="controls">
                  <input type="text" name="amount" id="amount" required>
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Amount Type</label>
                <div class="controls">
                <select name="amount_type " required="">
                 <option value="Percentage">Percentage</option>
                 <option value="Fixed">Fixed</option>
                </select>
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Expiry Date</label>
                <div class="controls">
                  <input type="text" name="expire_date" id="datepicker" required>
                </div>
              </div>
                
              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add Coupon" class="btn btn-success">
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