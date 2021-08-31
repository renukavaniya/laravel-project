@extends('layouts.master1')
@section('content')


<section id="contact" class="contact">
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
   @if ($message = Session::get('success'))
  <!-- <div class="alert alert-succses alert-block">-->
<div class="alert alert-success col-sm-6">

    
    <strong>{{ $message }}</strong>
   </div>
   @endif
    @if ($message = Session::get('error'))
  <!-- <div class="alert alert-succses alert-block">-->
<div class="alert alert-danger col-sm-6">

   
    <strong>{{ $message }}</strong>
   </div>
   @endif
  
   
					
	
   <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>id</th>
                                            <th>title</th>
                                            <th>author</th>
                                            <th>publisher</th>
                                            <th>isbn</th>
											<th>description</th>
											<th>language</th>
											<th>genres</th>
											<th>image</th>
											<th>Delete</th>
											
                                        </thead>
                                        <tbody>
										@foreach($books as $book)
                                            <tr>
                                                 <td>{{ $book->id;}} </td>
                                                 <td>{{ $book->title;}} </td>
                                                 <td>{{ $book->author;}} </td>
                                                 <td>{{ $book->publisher;}} </td>
                                                <td>{{ $book->isbn;}} </td>
												<td>{{ $book->description;}} </td>
												<td>{{ $book->language;}} </td>
												<td>{{ $book->genres;}} </td>
												<td><img src="{{ asset('upload/'.$book->image ) }} " width="70px" height="80px" class="img-thumbnail" /> </td>
												<td><a href="/delete_cart/{{ $book->cart_id;}}" class="btn btn-danger btn-fill">Delete</a></td>
		                                       
                                            </tr>
                                            @endforeach
											
											 
											
											@forelse($books as $book)
												@empty
											   <p class ="text-center">
											   No result found for <strong> {{request()->query('search')}} </strong>
											   </p>
										     @endforelse
												
                                        </tbody>
                                    </table>
									<form action="/borrownow" method="post">
									@csrf
									<button class="btn btn-success" >Borrow Now</button>
									</form>
							
                                </div>
                            </div>
                        </section>
   
 @endsection
 </div>
 </div>