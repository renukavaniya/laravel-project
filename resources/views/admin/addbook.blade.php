@extends('layouts.master')
@section('content')
<div class="main-panel">
<nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#pablo"> Add Book </a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="nav navbar-nav mr-auto">
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="dropdown">
                                    <!--<i class="nc-icon nc-palette"></i>-->
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
              <h3 class="card-title"><center>Add Book</center></h3>
			  
			  
	
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

<form method="post" enctype="multipart/form-data" id="" action="/store">
                    {{ csrf_field() }}
                     <div class="form-group ">
						<label>Title </label>
						<input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" value="{{ old('title') }}">
					 </div>
                     <div class="form-group ">
						<label>Author </label>
						<input type="text" class="form-control" name="author" id="auther" placeholder="Enter Auther" value="{{ old('author') }}">
					</div>
					<div class="form-group ">
						<label>Publisher </label>
						<input type="text" class="form-control" name="publisher" id="publisher" placeholder="Enter Publicer" value="{{ old('publisher') }}">
					</div>
					<div class="form-group ">
						<label>ISBN </label>
						<input type="text" class="form-control" name="isbn" id="isbn" placeholder="Enter ISBN" value="{{ old('isbn') }}">
					</div>
					<!--<div class="form-group ">
						<label>Description </label>
						<input type="text" class="form-control" name="desc" id="desc" placeholder="Enter Description" value="">
					 </div>-->
					 <div class="form-group ">
					 <label>Description </label><br>
					 <textarea id="description" name="description" class="form-control" rows="4" cols="50" value = "{{ old('description') }}"></textarea>
						</div>
						
					
					 
					<div class="form-group ">
						<label>Language </label>
						<input type="text" class="form-control" name="language" id="language" placeholder="Enter Laguage" value="{{ old('language') }}">
					</div>
					<div class="form-group ">
						<label>Genres </label>
						<input type="text" class="form-control" name="genres" id="genres" placeholder="Enter Title" value="{{ old('genres') }}">
					 </div>
					<div class="form-group ">
						 <label>Book Image:</label>
                   <input type="file" name="image" id="image" class="form-control" value="{{ old('image') }}" >
						<!--<input type="text" name="image" id="image" class="form-control" value="" >-->
					</div>
					
					
					<br>
                     <div >
                        <button type="submit" name="submit" value="submit" id="submit" class="btn btn-info btn-fill "> Add</button>
                     </div>
                  </form>
				  
				  </div>
				  </div>
				  </div>
				  </div>
				  </section>
@endsection