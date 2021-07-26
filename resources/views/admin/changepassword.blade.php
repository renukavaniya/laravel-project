@extends('layouts.master')
@section('content')
<div class="main-panel">
<nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#pablo"> Change Password </a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="nav navbar-nav mr-auto">
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="dropdown">
                                    <i class="nc-icon nc-palette"></i>
                                    <span class="d-lg-none">Dashboard</span>
                                </a>
                            </li>
                            
                            <li class="nav-item"  >
                                <a class="nav-link" href="{{ url('/admin/logout') }}">
                                    <span class="no-icon">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
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

<form method="post" enctype="multipart/form-data" id="" action="{{url('/admin/update_password')}}">
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
