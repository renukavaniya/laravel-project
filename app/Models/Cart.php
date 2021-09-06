<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use Session;

class Cart extends Model
{
    use HasFactory;
    public $table="Carts";
    protected $fillable=['book_id','user_id'];
    
    public function addToCart($cart, $id, $u_id)
    {
     // dd($id);
        $bi = $this->where('book_id', '=', $id)->count();
        $ui = $this->where('user_id', '=', $u_id)->count();
        if ($bi&&$ui >= 1) {
            return redirect('/cartlist')->with('error', 'Book Added In Cart.');
        } else {
            $this->create($cart);
    
            Book::where('id', '=', $id)->decrement('quantity', 1);
        }
    }
    function cartList($userId)
    {
        /*$userId=auth()->user()->id;
        $books = $this->cart->CartList($userId);*/
        $books = $this->join('books', 'carts.book_id', '=', 'books.id')
               ->where('carts.user_id', $userId)
               ->select('books.*', 'carts.id as cart_id')
               ->get();
               return $books;
    }
    
    public function deleteCarts($id)
    {
        $cart=$this->find($id);
        
        $cart->delete();
        $bookid=Session::get('bookid');
        $borrow= Book::where('id', '=', $bookid);
        
        
        $borrow->increment('quantity', 1);
    }
}
