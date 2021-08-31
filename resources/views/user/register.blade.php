<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Books Management</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/css/demo.css" rel="stylesheet" />
	
	<!--for clientside validation-->
	 
   <style>
        label.error {
            color: #dc3545;
            font-size: 14px;
        }
    </style>

</head>

<br><br>
<section id="contact" class="contact">

  <div class="container col-sm-6">
		<div class="card">
           <!-- <div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong><center><h4>Login</h4 ></center></strong> </div>-->
            <div class="card-body">
               <div class="col-sm-12">
              <h3 class="card-title"><center>Registration</center></h3>
			  
			  @php
			  if(isset($_COOKIE['email']) && isset($_COOKIE['password']))
			  {
				  $email    =  $_COOKIE['email'];
				 
				  $password =  $_COOKIE['password'];
			  }
			  else{
				  $email    = '';
				  $password ='';
			  }
			  @endphp
			  
			<!-- @if(isset(Auth::user()->email))
    <script>window.location="/admin/dashboard";</script>
   @endif-->
    
	 @if ($message = Session::get('success'))
   <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
   </div>
   @endif

   @if ($message = Session::get('error'))
   <div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
   </div>
   @endif


	@if ($errors->any())
    <div class="alert alert-danger">
     <ul>
     @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
     @endforeach
     </ul>
    </div>
   @endif

<form method="post" enctype="multipart/form-data" id="" action="/storeuser">
                    {{ csrf_field() }}
					<div class="form-group ">
						<label>First Name </label>
						<input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter First Name" value="{{ old('firstname') }}">
					 </div>
					 <div class="form-group ">
						<label>Last Name </label>
						<input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter Last Name" value="{{ old('lastname') }}">
					 </div>
                     <div class="form-group ">
						<label>Email </label>
						<input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" value="{{ old('email') }}">
					 </div>
                     <div class="form-group ">
						<label>Password </label>
						<input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" value="{{ old('password') }}">
					</div>
					<div class="form-group">
						<label>ConfirmPassword </label>
						<input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Enter Confirm Password" value="{{ old('cpassword') }}">
					</div><br>
					<div class="form-group">
					<label> Birthdate:</label> <input type="date" name="dob" class="disableFuturedate" placeholder="YYYY/MM/DD" value ="{{ old('cpassword') }}">
					</div>
					<div class="form-group">
				 <label>Mobile Number:</label>
                  <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number"value ="{{ old('mobile') }}" >
                </div>
               
				<div class="form-group">
				  <label for="gender">Gender:</label><br>
				   <input type="radio" id="male" name="gender" value="male" >
				  <label for="male">Male</label><br>
				  <input type="radio" id="female" name="gender" value="female">
				  <label for="female">Female</label><br>
                </div>
				<div class="form-group">
                   <label>Address: </label>
                   <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address"value = "{{ old('address') }}" >
                 </div><br>
				 <div class="form-group">
				  <label for="state">State:</label>

					  <select id="state" name="state">
						  <option value="">Select State</option>
						  <option value="Gujrat" >Gujrat</option>
						  <option value="Maharashtra" >Maharashtra</option>
						  
					  </select>
				 
				  <label for="city">City:</span></label>

					  <select id="city" name="city">
						  <option value="">Select City</option>
						  
						  <option value="Ahemdabad">Ahemdabad</option>
						  <option value="Baroda">Baroda</option>
						  <option value="Mumbai">Mumbai</option>
						  <option value="Pune">Pune</option>
						  
					  </select>
					
					 
					  </div>
					  
					<br>
                     <div >
                        <button type="submit" name="submit" value="submit" id="submit" class="btn btn-info btn-fill ">Register</button>
                     </div>
                  </form>
				  
				  </div>
				  </div>
				  </div>
				  </div>
				  </section>
</body>
<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="../assets/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="../assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="../assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="../assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="../assets/js/demo.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

        demo.showNotification();

    });
</script>

</html>