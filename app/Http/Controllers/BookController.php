<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\Book;
use App\Models\User;
use App\Models\Cart;
use DB;
use Session;
use App\Models\Borrow;
use Validator;
use Auth;
use PDF;



class BookController extends Controller
{
   public function index()
   {
	   return view('admin.addbook');
   }
  /* public function search(Request $request)
   {
	   $search = $request->get('search');
	   $books = Book::where('title','LIKE',"%{$search}%")->Paginate(3);
	   return view('admin.dashboard',['books'=>$books]);
   }*/
   public function booklist()
    {
     return view('admin.booklist');
    }
	 public function userprofile()
    {
     return view('admin.userprofile');
    }
   
   public function store(Request $request)
   {
	   $request->validate([
	   
			'title' => 'required',
            'author' => 'required',
			'publisher' => 'required',
			'isbn' => 'required',
			'description' => 'required',
			'language' => 'required',
			'genres' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

	   
	   try{
	    $book=new Book;
		$book->title=$request->get('title');
		$book->author=$request->get('author');
		$book->publisher=$request->get('publisher');
		$book->isbn=$request->get('isbn');
		$book->description=$request->get('description');
		$book->language=$request->get('language');
		$book->genres=$request->get('genres');
		//$book->image=$request->get('image');
		if($request->hasfile('image'))
		{
			$file = $request->file('image');
			$extension = $file->getClientOriginalExtension();
			$filename = time().'.'.$extension;
			$file->move('upload',$filename);
			$book->image = $filename;
		}
		
		
		$book->save();
		
		//$bookInfo = Book::where('id','=', $request->email)->first();
		//echo "data insertted";
		 //return redirect('admin/dashboard')->with('error','Data added succesfully.');
		  return redirect('admin/booklist')->with('error','Book added succesfully.');
	   }catch(\Exception $e){
		 return redirect('admin/booklist')->with('error','Book added Fail.');
   }
		 
   }
   
   public function show(Request $request)
	{	
	
		$limit_records = isset($request->limit_records) ? $request->limit_records : 3;
		//$page = isset($_GET["page"]);
		$search = request()->query('search');
	   if($search){
		//dd($search);
		$books = Book::where('title','LIKE',"%{$search}%")->sortable()->Paginate($limit_records);
		//dd($Books);
	   }
	   else{
		   
		   $books = Book::sortable()->Paginate($limit_records);
	   }
		
		//$books = DB::table('books')->paginate(3);
	//	$books=Book::paginate(2);
		//$books=Book::all();
		//return view('admin.dashboard',['books'=>$books]);
		return view('admin.booklist',['books'=>$books]);
	}
	public function showuser(Request $request){
		
		$limit_records = isset($_GET["limit_records"]) ? $_GET["limit_records"] : 3;
		$search = request()->query('search');
	   if($search){
		//dd($search);
		$users = User::where('firstname','LIKE',"%{$search}%")->sortable()->Paginate($limit_records);
		//$users = User::where('firstname','LIKE',"%{$search}%")->sortable()->Paginate($limit_records);
		//dd($Books);
	   }
	   else{
		   
		   $users = User::sortable()->Paginate($limit_records);
	   }
		
		//$users=User::all();
		return view('admin.userprofile',['users'=>$users]);
	}
	
   public function destroy(Request $request,$id)
	{	
	try{
		$book=Book::find($id);
		//$book=Book::where('book_id',$book_id)->first();;
		$filename = $book->image;
		$filepath = public_path('upload/'.$filename);
		//dd($filepath);
		unlink($filepath);
		$book->delete();
		//return redirect('admin/dashboard')->with('error','Data Deleted succesfully.');
		return redirect('admin/booklist')->with('error','Book Deleted succesfully.');
	}catch(\Exception $e){
		 return redirect('admin/booklist')->with('error','Book Deleted Fail.');
   }
	}
	public function edit(Request $request,$id)
	{	try{
		$books=Book::find($id);
		//$post->delete();
		return view('admin.editbook',['books'=>$books]);
			}
			catch(\Exception $e){
				 return redirect('admin/booklist')->with('error','Book Id Not Found.');
		   }
	}
	public function update(Request $request,$id)
	{
		if($request->file('image')){
		$request->validate([
	   
			'title' => 'required',
            'author' => 'required',
			'publisher' => 'required',
			'isbn' => 'required',
			'description' => 'required',
			'language' => 'required',
			'genres' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

		try{
		$books=Book::find($id);
		
		$books->title=$request->get('title');
		$books->author=$request->get('author');
		$books->publisher=$request->get('publisher');
		$books->isbn=$request->get('isbn');
		$books->description=$request->get('description');
		$books->language=$request->get('language');
		$books->genres=$request->get('genres');
		
	
		
		//$books->image=$request->get('image');
		if($request->hasfile('image'))
		{
			$file = $request->file('image');
			$extension = $file->getClientOriginalExtension();
			$filename = time().'.'.$extension;
			$file->move('upload',$filename);
			$books->image = $filename;
		}
		 
		$books->save();
		}
		catch(\Exception $e){
		 return redirect('admin/userprofile')->with('error','Book Updated Fail.');
        }
		}
		else{
			$request->validate([
	   
			'title' => 'required',
            'author' => 'required',
			'publisher' => 'required',
			'isbn' => 'required',
			'description' => 'required',
			'language' => 'required',
			'genres' => 'required',
            
        ]);

	
		$books=Book::find($id);
		
		$books->title=$request->get('title');
		$books->author=$request->get('author');
		$books->publisher=$request->get('publisher');
		$books->isbn=$request->get('isbn');
		$books->description=$request->get('description');
		$books->language=$request->get('language');
		$books->genres=$request->get('genres');
		
		$books->save();	
		}
		//return redirect('admin/dashboard')->with('error','Data Updated succesfully.');;
		return redirect('admin/booklist')->with('error','Book Updated succesfully.');
		
		
	}
	function showbook()
    {
		$search = request()->query('search');
	   if($search){
		
		$books = Book::where('title','LIKE',"%{$search}%")->Paginate(3);
		
	   }
	   else{
		   
		   $books = Book::Paginate(5);
	   }
		//$books=Book::all();
		return view('user.userdashboard',['books'=>$books]);
     //return view('user.showbooks',['books'=>$books]);
    }
	function singlebook(Request $request,$id)
    {
		
	 $books=Book::find($id);
		//$post->delete();
		return view('user.singlebook',['books'=>$books]);
		
    }
	function addToCart(Request $request)
	{	//$userid=auth()->user()->id;
		
		/*$abc=Cart::/*join('books','cart.book_id','=','books.id')
				 ->join('users','cart.user_id','=','users.id')*/
		       

				
		      /* select('cart.*') ->where('cart.user_id')->where('cart.book_id')
			   ->get();
			$cnt=count($abc);*/
			//dd($abc) ;
		
	 /* $this->validate($request, [
      'book_id'   => 'unique:cart',
      'user_id'  => 'unique:cart'
     ]);*/

		
		
		$cart=new Cart;
		
		$cart->book_id=$request->get('book_id');
		$request->session()->put('bookid', $cart->book_id);
		
		$cart->user_id= auth()->user()->id;
		//$request->session()->put('userid', $cart->user_id);
		$id =  $cart->book_id;
		
		$bi = Cart::where('book_id','=',$id)->count();
		$ui = Cart::where('user_id','=',$cart->user_id)->count();
		if($bi&&$ui >= 1 ){return redirect('/cartlist')->with('error','Book Added In Cart.');}
		else{
		$cart->save();
		//$borrow= DB::table('books')->where('id','=', $cart->book_id)->decrement('quantity',1);
		$books = Book::where('id','=',$id)->decrement('quantity',1);
		}
		return redirect('/cartlist')->with('success','Book Added To Cart succesfully.');
		
	}
	
	public function cart()  
 {
     return view('user.carts');  
 }

	
	 public function addcart($id) // by this function we add product of choose in card
 {
     $book = Book::find($id);

     if(!$book) {

         abort(404);

     }
// what is Session:
//Sessions are used to store information about the user across the requests.
// Laravel provides various drivers like file, cookie, apc, array, Memcached, Redis, and database to handle session data. 
// so cause write the below code in controller and tis code is fix
     $cart = session()->get('cart');  

     // if cart is empty then this the first product
     if(!$cart) {

         $cart = [
                 $id => [
                     "title" => $book->title,
                     "author" => $book->author,
                     "publisher" => $book->publisher,
                     "isbn" => $book->isbn
                 ]
         ];

         session()->put('cart', $cart);

         return redirect('/userdashboard')->with('success', 'added to cart successfully!');
     }

     // if cart not empty then check if this product exist then increment quantity
     if(isset($cart[$id])) {

         //$cart[$id]['quantity']++;

         session()->put('cart', $cart); // this code put product of choose in cart

         return redirect('/userdashboard')->with('success', 'Product added to cart successfully!');

     }

     // if item not exist in cart then add to cart with quantity = 1
     $cart[$id] = [
                     "title" => $book->title,
                     "author" => $book->author,
                     "publisher" => $book->publisher,
                     "isbn" => $book->isbn
                 
     ];

     session()->put('cart', $cart); // this code put product of choose in cart

     return redirect('/userdashboard')->back()->with('success', 'Product added to cart successfully!');
 }

	static function cartItem()
	{
		
		$userId=auth()->user()->id;
		return Cart::where('user_id',$userId)->count();
	}
	function cartList()
	{
		$userId=auth()->user()->id;
		$books = Cart::join('books','cart.book_id','=','books.id')
		       ->where('cart.user_id',$userId)
		       ->select('books.*','cart.id as cart_id')
			   ->get();
			   
			   return view('user.cartlist',['books'=>$books]);
	}
	
	function deleteCart($id)
	{
		Cart::destroy($id);
		
	/*	$books = Cart:://join('books','cart.book_id','=','books.id')
					select('book_id')
		       ->where('id','=',$id)
		       //->select('cart.book_id')
			   ->get();*/
		//dd($id1);die();
		$bookid=Session::get('bookid');
		$borrow= DB::table('books')->where('id','=',$bookid);
		
		$borrow->increment('quantity',1);
		//dd($id);
		//$books = Book::latest('id')->increment('quantity',1);
		
//		$id = latest('id'); 

		return redirect('cartlist')->with('error','Book Deleted from Cart succesfully.');
	}
	
	 public function removeCart(Request $request)
 {
     if($request->id) {

         $cart = session()->get('cart');

         if(isset($cart[$request->id])) {

             unset($cart[$request->id]);

             session()->put('cart', $cart);
         }
		//$borrow= DB::table('books')->increment('quantity',1);
         return redirect('/userdashboard');
     }
 }
 
 public function borrownow(Request $request) 
 {	     $userId=auth()->user()->id;
         $allCart= Cart::where('user_id',$userId)->get();
		 $bookid=Session::get('bookid');
		// dd($bookid);
		 $userid=Session::get('userid');
		 foreach($allCart as $cart)
		 {
			 
			  
			//dd($bookid);
			 $borrow= new Borrow;
			/* $borrow->book_id=$cart['book_id'];
		     $borrow->user_id=$cart['user_id'];
			 $borrow->approved="pending";
			 $borrow->issue_date="pending";
			 $borrow->return_date="pending";
			 $borrow->save();
			
			 Cart::where('user_id',$userId)->delete();*/
			 
			
			// if(!$bookid && $userid >1) {
			 $borrow->book_id=$cart['book_id'];
		     $borrow->user_id=$cart['user_id'];
			 $borrow->approved="pending";
			 $borrow->issue_date="pending";
			 $borrow->return_date="pending";
			$b_id = Borrow::where('user_id',$borrow->user_id)->count();
			$u_id = Borrow::where('book_id',$borrow->book_id)->count();
			//dd($b_id);
			 //if( !$u_id >=1 ) {
			 $borrow->save();
			
			 Cart::where('user_id',$userId)->delete();
			//}
			/*elseif (Borrow::where('approved', $borrow->approved === 'approved')) {
    return back()->with('success', 'Your previous book has not been returned yet');
}	elseif (Borrow::where('approved', $borrow->approved === 'approved')) {
    return back()->with('success', 'Your previous book has not been returned yet');
}*/	
/*else{
return back()->with('success', 'Your previous book has not been returned yet');
}*/	
      
			 
			 
		 }
		 
		 //$request->input();
		/*$books = Cart::join('books','cart.book_id','=','books.id')
		       ->where('cart.user_id',$userId)
		       ->select('books.*','cart.id as cart_id')
			   ->get();*/
		return redirect('/userdashboard')->with('error', 'Send Request');;	   
	 //return redirect()->back();
	 
 }
 public function borrowedbooks()
 {
	  $userId=auth()->user()->id;
      $borrow=Borrow::join('books','borrow.book_id','=','books.id')
		       ->where('borrow.user_id',$userId)
		      // ->select('books.*','borrow.id as cart_id')
			   ->get();
			   
		return view('user.borrowedbooks',['borrow'=>$borrow]);
		
 }
 
     function pdf()
    {
		/*$userId=auth()->user()->id;
      $borrow= DB::table('borrow')->join('books','borrow.book_id','=','books.id')
		       ->where('borrow.user_id',$userId)
		      // ->select('books.*','borrow.id as cart_id')
			   ->get();*/
	
		
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->convert_customer_data_to_html());
		
	//$pdf->loadview('user.borrowedbooks',compact('borrow'));
    // return $pdf->stream();
	return $pdf->download("books.pdf");
    }

    function convert_customer_data_to_html()
    {
		$userId=auth()->user()->id;
      $borrow= DB::table('borrow')->join('books','borrow.book_id','=','books.id')
		       ->where('borrow.user_id',$userId)
		      // ->select('books.*','borrow.id as cart_id')
			   ->get();
			  
	
	//	$a ='<h1>Hello</h1>';
    // $borrow = $this->get_customer_data();
     /*$output = '
     <h3 align="center">Books Data</h3>';
     
     return $output;*/
	      $output = '
     <h3 align="center">Customer Data</h3>
     <table width="100%" style="border-collapse: collapse; border: 0px;">
      <tr>
    <th style="border: 1px solid; padding:12px;" width="20%">Book_name</th>
    <th style="border: 1px solid; padding:12px;" width="30%">Author</th>
    <th style="border: 1px solid; padding:12px;" width="15%">Publisher</th>
    <th style="border: 1px solid; padding:12px;" width="15%">ISBN</th>
    <th style="border: 1px solid; padding:12px;" width="20%">Description</th>
   </tr>
     ';  
    foreach($borrow as $book)
     {
		  
      $output .= '
      <tr>
       <td style="border: 1px solid; padding:12px;">'.$book->title.'</td>
       <td style="border: 1px solid; padding:12px;">'.$book->author.'</td>
       <td style="border: 1px solid; padding:12px;">'.$book->publisher.'</td>
       <td style="border: 1px solid; padding:12px;">'.$book->isbn.'</td>
       <td style="border: 1px solid; padding:12px;">'.$book->description.'</td>
      </tr>
      ';
     }
     $output .= '</table>';
	 return $output;
    }
	
 public function return_book($id)
 {
	  $userId=auth()->user()->id;
	 // $bookid=Session::get('bookid');
	   $borrow= DB::table('borrow')->where('book_id',$id)->where('user_id',$userId)->update([
		'approved'=>"return"
        //'issue_date'=>$request->issue_date,
		//'return_date'=>$request->return_date
		]);
		
		$book= DB::table('books')->where('id','=',$id);
		
		$book->increment('quantity',1);
		
		return back()->with('success', 'Book Return Successfully');
 }
	 
}
