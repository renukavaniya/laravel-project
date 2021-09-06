<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Borrow;
use Session;
use DB;
use Illuminate\Http\Request;

class BookController extends Controller
{
    function showbook()
    {
        /*$search = request()->query('search');
       if($search){

        $books = Book::where('title','LIKE',"%{$search}%")->Paginate(3);

       }
       else{*/
           
           $books = Book::Paginate(5);
      // }
        //$books=Book::all();
        return ($books);
     //return view('user.showbooks',['books'=>$books]);
    }
    
    function singlebook($id)
    {
        
        $books=Book::find($id);
        //$post->delete();
        return ($books);
    }
    function addToCart(Request $request)
    {
        $cart=new Cart;
        
        //$cart->book_id=$request->get('book_id');
        $cart->book_id=1;
        //$request->session()->put('bookid', $cart->book_id);
        $cart->user_id=4;
        //$cart->user_id= auth()->user()->id;
        //$request->session()->put('userid', $cart->user_id);
        $id =  $cart->book_id;
        
        $bi = Cart::where('book_id', '=', $id)->count();
        $ui = Cart::where('user_id', '=', $cart->user_id)->count();
        /*if($bi&&$ui >= 1 ){return ('Book Added In Cart.');}
        else{*/
        $cart->save();
        //$borrow= DB::table('books')->where('id','=', $cart->book_id)->decrement('quantity',1);
        $books = Book::where('id', '=', $id)->decrement('quantity', 1);
        //}
        return ('Book Added To Cart succesfully.');
    }
    function cartList()
    {
    //  $userId=auth()->user()->id;
        $userId=21;
        $books = Cart::join('books', 'cart.book_id', '=', 'books.id')
               ->where('cart.user_id', $userId)
               ->select('books.*', 'cart.id as cart_id')
               ->get();
               
               return ($books);
    }
    
    function deleteCart($id)
    {
        Cart::destroy($id);
        
        //$bookid=Session::get('bookid');
        $bookid=1;
        $borrow= DB::table('books')->where('id', '=', $bookid);
        
        $borrow->increment('quantity', 1);
        //dd($id);
        //$books = Book::latest('id')->increment('quantity',1);
        
//      $id = latest('id');

        return('Book Deleted from Cart succesfully.');
    }
    public function borrownow(Request $request)
    {
      // $userId=auth()->user()->id;
        $userId=4;
         $allCart= Cart::where('user_id', $userId)->get();
        // $bookid=Session::get('bookid');
        
        // $userid=Session::get('userid');
        foreach ($allCart as $cart) {
            $borrow= new Borrow;
            
            $borrow->book_id=$cart['book_id'];
            $borrow->user_id=$cart['user_id'];
            $borrow->approved="pending";
            $borrow->issue_date="pending";
            $borrow->return_date="pending";
            $b_id = Borrow::where('user_id', $borrow->user_id)->count();
            $u_id = Borrow::where('book_id', $borrow->book_id)->count();
            //dd($b_id);
            //if( !$u_id >=1 ) {
            $borrow->save();
            
            Cart::where('user_id', $userId)->delete();
            //}
            /*elseif (Borrow::where('approved', $borrow->approved === 'approved')) {
    return back()->with('success', 'Your previous book has not been returned yet');
}   elseif (Borrow::where('approved', $borrow->approved === 'approved')) {
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
        return ('Book Borrow success');
     //return redirect()->back();
    }
}
