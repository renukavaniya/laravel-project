 @extends('layouts.master1')
@section('content')
<main id="main">
 <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
	  {{ csrf_field() }}

        <div class="row">

          <div class="col-lg-8 entries">
		  
            <article class="entry">

              <div class="entry-img">
               <!-- <img src="asset/img/blog/blog-1.jpg" alt="" class="img-fluid">-->
			   
			   
				
			 <img src="{{ asset('upload/'.$books->image ) }} "   style="width: 280px; height: 300px;">
			
				  <div class="form-group ">
						<label>Title: </label>
						{{$books->title}}
					 </div>
                     <div class="form-group ">
						<label>Author: </label>
						{{$books->author}}
					</div>
					<div class="form-group ">
						<label>Publisher: </label>
						{{$books->publisher}}
					</div>
					<div class="form-group ">
						<label>ISBN: </label>
						{{$books->isbn}}
					</div>
					<div class="form-group ">
						<label>Description: </label>
						{{$books->description}}
					 </div>
					  
					
					<div class="form-group ">
						<label>Language: </label>
						{{$books->language}}
					</div>
					<div class="form-group ">
						<label>Genres: </label>
						 {{$books->genres}}
					 </div>
			  <div class="form-group ">
						
						 @if($books->quantity > 0)
							 <label>In Stock </label>
						 @else
							 <label>Out Of Stock</label>
						 @endif
					 </div>
              </div>

              
            </article><!-- End blog entry -->


           
          </div><!-- End blog entries list -->

          <div class="col-lg-4">

            <div class="sidebar">

              
              <div class="sidebar-item search-form">
			  <br>
                <form action="/add_to_cart" method="post">
                  <input type="hidden" name="book_id" value="{{$books->id}}" >
                  @csrf
                
              </div><!-- End sidebar search formn-->
			    @if($books->quantity > 0)
			   <div class="read-more" >
                  <button class="btn btn-warning Active" >Add to Cart</button>
                </div><br>
				@else
				 <div class="read-more" >
                  <button class="btn btn-warning Active" disabled >Add to Cart</button>
                </div><br>	
				@endif
				<!--<a href="{{ url('addcart/'.$books->id) }}" class="btn btn-block text-center text-light" role="button">Addcart</a>--> </p>
				<!--<div class="read-more">
                  <a href="/addToCart/{{$books->id}}" class="btn btn-warning" >Add TO cart</a>
                </div>-->
				
				<div class="read-more">
                  <a href="/borrownow" class="btn btn-warning" >Borrow Now</a>
                </div>
				</form>
              
              </div><!-- End sidebar recent posts-->

             
            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->
@endsection