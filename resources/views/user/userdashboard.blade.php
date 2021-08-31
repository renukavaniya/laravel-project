@extends('layouts.master1')
@section('content')

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
   <br>
   <section id="team" class="team">
      <div class="container">
	  <form method="GET" action="showbooks">
<label for="search" class="text-right">Search:</label>
<input class="col-md-2" type="search" value="{{request()->query('search')}}" name="search" placeholder="Search" id="search">
<button type="submit">Submit</button>
</form>
@if ($message = Session::get('error'))
   <div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert"></button>
    <strong>{{ $message }}</strong>
   </div>
   @endif

       <!-- <div class="row">
         @foreach($books as $book)
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
		   <a href="singlebook/$book->id">
            <div class="member">
			
             <!-- <img src="asset/img/team/team-2.jpg" alt="">-->
			<!--  <img src="{{ asset('upload/'.$book->image ) }} " >
              <h4>{{ $book->title;}} </h4>
              <span>{{ $book->author;}}(Author)</span>
              <p>
                Repellat fugiat adipisci nemo illum nesciunt voluptas repellendus. In architecto rerum rerum temporibus
              </p>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
			   </a>
            </div>
          </div>
@endforeach;

{!!$books->appends(['search'=> request()->query('search')])->links('pagination::bootstrap-4')->render()!!}
         
        </div>

      </div>
    </section><!-- End Team Section -->
	
<div class="row">
         @foreach($books as $book)
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
		   <a href="singlebook/{{ $book->id;}}">
		  
            <div class="member">
			
             <!-- <img src="asset/img/team/team-2.jpg" alt="">-->
			  <img src="{{ asset('upload/'.$book->image ) }} ">
              <h4>{{ $book->title;}} </h4>
              <span>{{ $book->author;}}(Author)</span>
			   <div class="form-group ">
						
						 @if($book->quantity > 0)
							 <label>In Stock </label>
						 @else
							 <label>Out Of Stock</label>
						 @endif
					 </div>
              <p>
                Repellat fugiat adipisci nemo illum nesciunt voluptas repellendus. In architecto rerum rerum temporibus
              </p>
			   
              
			   </a>
			    <form action="/add_to_cart" method="post">
                  <input type="hidden" name="book_id" value="{{$book->id}}" >
                  @csrf
               
			   @if($book->quantity > 0)
			   <div class="read-more" >
                  <button class="btn btn-primary Active" >Add to Cart</button>
                </div><br>
				@else
				 <div class="read-more" >
                  <button class="btn btn-primary Active" disabled >Add to Cart</button>
                </div><br>	
				@endif
				</form>
				<div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
@endforeach;

{!!$books->appends(['search'=> request()->query('search')])->links('pagination::bootstrap-4')->render()!!}
         
        </div>

      </div>
    </section><!-- End Team Section -->


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
 @endsection