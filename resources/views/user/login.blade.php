@extends('layouts.master1')
@section('content')

<br><br>
<section id="contact" class="contact">

  <div class="container col-sm-6">
		<div class="card">
           <!-- <div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong><center><h4>Login</h4 ></center></strong> </div>-->
            <div class="card-body">
               <div class="col-sm-12">
              <h3 class="card-title"><center>User Login</center></h3>
			  
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

<form method="post" enctype="multipart/form-data" id="" action="{{url('/user/auth')}}">
                    {{ csrf_field() }}
                     <div class="form-group ">
						<label>Email </label>
						<input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" value="@php if(!isset($_COOKIE['email'])){ echo old('email'); }else{ echo $email; } @endphp">
					 </div>
                     <div class="form-group ">
						<label>Password </label>
						<input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" value="@php if(!isset($_COOKIE['password'])){ echo old('password'); }else{ echo $password; } @endphp">
					</div>
					
					<input type="checkbox" id="remember" class="remember" name="remember"   >Remember Me
					
					<br>
                     <div >
                        <button type="submit" name="submit" value="submit" id="submit" class="btn btn-info btn-fill "> Login</button>
                     </div>
                  </form>
				  
				  </div>
				  </div>
				  </div>
				  </div>
				  </section>
@endsection