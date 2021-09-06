<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Book;
use App\Models\User;
use Session;

class CartsController extends Controller
{
    public function __construct(Cart $carts)
    {
        $this->cart = $carts;
    }

    
    function addToCart(Request $request)
    {
        /*$cart=new Cart;

        $cart->book_id=$request->get('book_id');
        $request->session()->put('bookid', $cart->book_id);

        $cart->user_id= auth()->user()->id;
        //$request->session()->put('userid', $cart->user_id);
        $id =  $cart->book_id;

        $bi = Cart::where('book_id','=',$id)->count();
        $ui = Cart::where('user_id','=',$cart->user_id)->count();
        if($bi&&$ui >= 1 ){return redirect('/cartlist')->with('error','Book Added In Cart.');}
        else{
        $cart->save();*/
        
        //$borrow= DB::table('books')->where('id','=', $cart->book_id)->decrement('quantity',1);
        $cart=[
        'book_id'=>$request->get('book_id'),
        //$request->session()->put('bookid', $cart->book_id);
        
        'user_id'=> auth()->user()->id
        //$request->session()->put('userid', $cart->user_id);
        
        ];
        $id =  $request->get('book_id');
        $request->session()->put('bookid', $id);
        $u_id=auth()->user()->id;
        $carts=$this->cart->addToCart($cart, $id, $u_id);
        //$books = Book::where('id','=',$id)->decrement('quantity',1);
        
        return redirect('/cartlist')->with('success', 'Book Added To Cart succesfully.');
    }
    
    public function cart()
    {
        return view('user.carts');
    }

    
    public function addcart($id) // by this function we add product of choose in card
    {
        $book = Book::find($id);

        if (!$book) {
            abort(404);
        }
// what is Session:
//Sessions are used to store information about the user across the requests.
// Laravel provides various drivers like file, cookie, apc, array, Memcached, Redis, and database to handle session data.
// so cause write the below code in controller and tis code is fix
        $cart = session()->get('cart');

     // if cart is empty then this the first product
        if (!$cart) {
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
        if (isset($cart[$id])) {
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

        return Cart::where('user_id', $userId)->count();
    }
    function cartList()
    {
        $userId=auth()->user()->id;
        $books = $this->cart->CartList($userId);
        
               
               return view('user.cartlist', ['books'=>$books]);
    }
    
    function deleteCart($id)
    {
        
        
        
        $carts = $this->cart->deleteCarts($id);
        //Cart::destroy($id);
        
    /*  $books = Cart:://join('books','cart.book_id','=','books.id')
                    select('book_id')
               ->where('id','=',$id)
               //->select('cart.book_id')
               ->get();*/
        //dd($id1);die();
        
        //dd($id);
        //$books = Book::latest('id')->increment('quantity',1);
        
//      $id = latest('id');

        return redirect('cartlist')->with('error', 'Book Deleted from Cart succesfully.');
    }
    
    public function removeCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');

            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }
           //$borrow= DB::table('books')->increment('quantity',1);
            return redirect('/userdashboard');
        }
    }

    //
}
