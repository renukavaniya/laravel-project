@extends('layouts.master1')
@section('content')
<div class="main-panel">
<br><br>
<section id="contact" class="contact">

  <div class="container col-sm-6">
		<div class="card">
           <!-- <div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong><center><h4>Login</h4 ></center></strong> </div>-->
            <div class="card-body">
               <div class="col-sm-12">
              <h3 class="card-title"><center>Change Password</center></h3>
			  
			 
     @if ($message = Session::get('success'))
   <div class="alert alert-success alert-block">
    <!--<button type="button" class="close" data-dismiss="alert">×</button>-->
    <strong>{{ $message }}</strong>
   </div>
   @endif

	
   @if ($message = Session::get('error'))
   <div class="alert alert-danger alert-block">
    <!--<button type="button" class="close" data-dismiss="alert">×</button>-->
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
														
<form method="post" enctype="multipart/form-data" id="" action="/updateuserpassword">
                    {{ csrf_field() }}
                     
                     <div class="form-group">
						<label>Old Password </label>
						<input type="password" class="form-control" name="old_password" id="old_password" placeholder="Enter Old Password" value="{{old('old_password')}}">
					</div>
					 <div class="form-group">
						<label>New Password </label>
						<input type="password" class="form-control" name="new_password" id="new_password" placeholder="Enter New Password" value="{{old('new_password')}}">
					</div>
					 <div class="form-group">
						<label>Confirm Password </label>
						<input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Enter Confirm Password" value="{{old('confirm_password')}}">
					</div>
					
					<br>
                     <div >
                        <button type="submit" name="submit" value="submit" id="submit" class="btn btn-info btn-fill "> Change Password </button>
                     </div>
                  </form>
				  
				  <script src="jquery.min.js"></script>
				  <script src="jquery.min.js"></script>
				  
				  </div>
				  </div>
				  </div>
				  </div>
				  </section>
@endsection
</div>
