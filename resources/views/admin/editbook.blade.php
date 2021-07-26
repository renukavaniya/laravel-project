@extends('layouts.master')
@section('content')

<br><br>
<section id="contact" class="contact">

  <div class="container col-sm-6">
		<div class="card">
           <!-- <div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong><center><h4>Login</h4 ></center></strong> </div>-->
            <div class="card-body">
               <div class="col-sm-12">
              <h3 class="card-title"><center>Edit Book</center></h3>
			  
			  
	
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

<form method="post" enctype="multipart/form-data" id="" action="/update/{{$books->id}}">
                    {{ csrf_field() }}
                     <div class="form-group ">
						<label>Title </label>
						<input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" value="{{$books->title}}">
					 </div>
                     <div class="form-group ">
						<label>Author </label>
						<input type="text" class="form-control" name="author" id="auther" placeholder="Enter Auther" value="{{$books->author}}">
					</div>
					<div class="form-group ">
						<label>Publisher </label>
						<input type="text" class="form-control" name="publisher" id="publisher" placeholder="Enter Publicer" value="{{$books->publisher}}">
					</div>
					<div class="form-group ">
						<label>ISBN </label>
						<input type="text" class="form-control" name="isbn" id="isbn" placeholder="Enter ISBN" value="{{$books->isbn}}">
					</div>
					<div class="form-group ">
						<label>Description </label>
						<input type="text" class="form-control" name="description" id="description" placeholder="Enter Description" value="{{$books->description}}">
					 </div>
					  
					
					<div class="form-group ">
						<label>Language </label>
						<input type="text" class="form-control" name="language" id="language" placeholder="Enter Laguage" value="{{$books->language}}">
					</div>
					<div class="form-group ">
						<label>Genres </label>
						<input type="text" class="form-control" name="genres" id="genres" placeholder="Enter Title" value="{{$books->genres}}">
					 </div>
					 
					<div class="form-group ">
						 <label>Book Image:</label>
                  <input type="file" name="image" id="image" class="form-control" value="{{$books->image}}"  >
						<!--<input type="text" name="image" id="image" class="form-control" value="{{$books->image}}" >-->
					</div>
					
					<!--<img src="{{ asset('upload/'.$books->image ) }} " class="img-thumbnail" />-->
					
					<center> <a class="fancybox" name="image" rel="gallery1" href="/upload/{{$books->image }}" title="Twilight Memories (doraartem)">
				   <img src="{{ asset('upload/'.$books->image ) }} " style="width: 70px; height: 70px;" class="img-thumbnail" />
				   <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
					<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
					<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
					<script>
					$(document).ready(function() {
						$(".fancybox").fancybox({
							openEffect	: 'none',
							closeEffect	: 'none'
						});
					});
					</script></center>
					
					
					
					<br>
                     <div >
                        <button type="submit" name="submit" value="edit" id="submit" class="btn btn-info btn-fill "> Edit</button>
                     </div>
                  </form>
				  
				  </div>
				  </div>
				  </div>
				  </div>
				  </section>
@endsection