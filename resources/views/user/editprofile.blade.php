@extends('layouts.master1')
@section('content')

<br><br>
<section id="contact" class="contact">

  <div class="container col-sm-6">
        <div class="card">
           <!-- <div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong><center><h4>Login</h4 ></center></strong> </div>-->
            <div class="card-body">
               <div class="col-sm-12">
              <h3 class="card-title"><center>Edit Profile</center></h3>
              
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

<form method="post" enctype="multipart/form-data" id="" action="/updateuserprofile/{{$users->id}}">
                    {{ csrf_field() }}
                    <div class="form-group ">
                        <label>First Name </label>
                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter First Name"  value="{{$users->firstname}}">
                     </div>
                     <div class="form-group ">
                        <label>Last Name </label>
                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter Last Name" value="{{$users->lastname}}">
                     </div>
                     <div class="form-group ">
                        <label>Email </label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" value="{{$users->email}}">
                     </div>
                   <!--  <div class="form-group ">
                        <label>Password </label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" value="">
                    </div>
                    <div class="form-group">
                        <label>ConfirmPassword </label>
                        <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Enter Confirm Password" value="">
                    </div><br>-->
                    <div class="form-group">
                    <label> Birthdate:</label> <input type="date" name="dob" class="disableFuturedate" placeholder="YYYY/MM/DD" value="{{$users->dob}}">
                    </div>
                    <div class="form-group">
                 <label>Mobile Number:</label>
                  <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number"value="{{$users->mobile}}" >
                </div>
               
                <div class="form-group">
                  <label for="gender">Gender:</label><br>
                   <input type="radio" id="male" name="gender" value="male" <?php if ($users->gender == "male") {
                       echo "checked";
                                                                            } ?> >
                  <label for="male">Male</label><br>
                  <input type="radio" id="female" name="gender" value="female" <?php if ($users->gender == "female") {
                        echo "checked";
                                                                               } ?>>
                  <label for="female">Female</label><br>
                </div>
                <div class="form-group">
                   <label>Address: </label>
                   <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address"value="{{$users->address}}" >
                 </div><br>
                  <div class="form-group">
                  <label for="state">State:</label>

                      <select id="state" name="state">
                          <option value="">Select State</option>
                          <option value="Gujrat" <?php if ($users->state == "Gujrat") {
                                echo "selected";
                                                 } ?>>Gujrat</option>
                          <option value="Maharashtra"  <?php if ($users->state == "Maharashtra") {
                                echo "selected";
                                                       } ?>>Maharashtra</option>
                          
                      </select>
                 
                  <label for="city">City:</span></label>

                      <select id="city" name="city">
                          <option value="">Select City</option>
                          
                          <option value="Ahemdabad" <?php if ($users->city == "Ahemdabad") {
                                echo "selected";
                                                    } ?>>Ahemdabad</option>
                          <option value="Baroda" <?php if ($users->city == "Baroda") {
                                echo "selected";
                                                 } ?>>Baroda</option>
                          <option value="Mumbai"<?php if ($users->city == "Mumbai") {
                                echo "selected";
                                                } ?>>Mumbai</option>
                          <option value="Pune"<?php if ($users->city == "Pune") {
                                echo "selected";
                                              } ?>>Pune</option>
                          
                      </select>
                     
                      </div>
                
                      
                    <br>
                     <div >
                        <button type="submit" name="submit" value="submit" id="submit" class="btn btn-info btn-fill ">Edit</button>
                     </div>
                  </form>
                  
                  </div>
                  </div>
                  </div>
                  </div>
                  </section>
@endsection
