@if(!isset(Auth::user()->email))
    <script>window.location="/admin";</script>
 @endif


@extends('layouts.master')
@section('content')


<div class="main-panel">
<nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#pablo"> Book List </a>
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
                             <ul class="navbar-nav ml-auto">
                            <li class="nav-item"  >
                                <a class="nav-link" href="{{ url('/admin/logout') }}">
                                    <span class="no-icon">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
		

<div class="container col-sm-12">
<!--<h1>Welcome</h1>
@if(isset(Auth::user()->email))
    <div class="alert alert-danger success-block">
     <strong>Welcome {{ Auth::user()->email }}</strong>
     <br />
	 <a href="">Change Password</a><br>
     <a href="{{ url('/admin/logout') }}">Logout</a>
    </div>
   @else
    <script>window.location = "/admin";</script>
   @endif-->
   @if ($message = Session::get('error'))
  <!-- <div class="alert alert-succses alert-block">-->
<div class="alert alert-success col-sm-6">

    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
   </div>
   @endif
   
					 <form method="GET" action="userprofile">
                      <label for="search" class="text-right">Search:</label>
					  <input class="col-md-2" type="search" value="{{request()->query('search')}}" name="search" placeholder="Search" id="search">
					 <button type="submit">Submit</button>
					 
					 <div>
                <span class="paginationtextfield">Show</span>&nbsp;
                <select id="limit_records" name="limit_records">
                    <?php
                    $record_per_page_arr = array("3","6","9","15","25");
                    foreach($record_per_page_arr as $limit_records){
                        if(isset($_GET['limit_records']) && $_GET['limit_records'] == $limit_records){
							
                            echo '<option value="'.$limit_records.'" selected="selected">'.$limit_records.'</option>';
                        }else{
                            echo '<option value="'.$limit_records.'">'.$limit_records.'</option>';
                        }
                    }
                    ?>
                </select>
				<span class="paginationtextfield">entries</span>&nbsp;
                </div>
					 
					 
					  </form>
					  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript">
					$(document).ready(function(){
						$("#limit_records").change(function(){
							$('form').submit();
						})
					})
				</script>
				
   <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover ">
                                
                                <div class="card-body table-full-width table-responsive ">
                                    <table class="table table-hover table-striped ">
                                        <thead>
                                            <th>@sortablelink('id')</th>
                                            <th>@sortablelink('firstname')</th>
                                            <th>@sortablelink('lastname')</th>
                                            <th>@sortablelink('email')</th>
                                            <th>@sortablelink('birthdate')</th>
											<th>@sortablelink('mobile')</th>
											<th>@sortablelink('gender')</th>
											<th>@sortablelink('address')</th>
											<th>@sortablelink('state')</th>
											<th>@sortablelink('city')</th>
											<th>Delete</th>
											<th>Edit</th>
                                        </thead>
                                        <tbody>
										@foreach($users as $user)
                                            <tr>
                                                 <td>{{ $user->id;}} </td>
                                                 <td>{{ $user->firstname;}} </td>
                                                 <td>{{ $user->lastname;}} </td>
                                                 <td>{{ $user->email;}} </td>
                                                <td>{{ $user->dob;}} </td>
												<td>{{ $user->mobile;}} </td>
												<td>{{ $user->gender;}} </td>
												<td>{{ $user->address;}} </td>
												<td>{{ $user->state;}} </td>
												<td>{{ $user->city;}} </td>
												
												<td><a href="/delete/{{ $user->id;}}" class="btn btn-danger btn-fill">Delete</a></td>
		                                       <td><a href="/edituser/{{ $user->id;}}" class="btn btn-warning btn-fill">Edit</a></td>
                                            </tr>
                                            @endforeach;
											@forelse($users as $user)
												@empty
											   <p class ="text-center">
											   No result found for <strong> {{request()->query('search')}} </strong>
											   </p>
										     @endforelse;
												
                                        </tbody>
                                    </table>
									{!! $users->appends(\Request::except('page'))->render('pagination::bootstrap-4') !!}
								
                                </div>
                            </div>
                        </div>
   
 @endsection
 </div>
 </div>