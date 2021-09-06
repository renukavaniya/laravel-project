<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Book;
use Request;

class Borrow extends Model
{
    use HasFactory;
    public $table="Borrow";
    //protected $fillable=['book_id','user_id','approved','issue_date','return_date'];
    public $timestamps=false;
    
    public static function getAllBooks()
    {
  //Request::get($id);
        $id = session('id');
        $result = DB::table('Borrow')->join('books', 'borrow.book_id', '=', 'books.id')
                    
                    ->join('users', 'borrow.user_id', '=', 'users.id')
                    ->select('firstname', 'title', 'author', 'isbn', 'language', 'genres')
               ->where('borrow.approved', '=', "approved")
               ->where('borrow.user_id', '=', $id)
               //->select('borrow.*','borrow.user_id','borrow.book_id')
               ->get()->toArray();
               return $result;
    }
    public static function getBooks()
    {
  //Request::get($id);
        $date = session('date');
        $todate = session('todate');
        $result = DB::table('Borrow')->join('books', 'borrow.book_id', '=', 'books.id')
                    
                    ->join('users', 'borrow.user_id', '=', 'users.id')
                    ->select('firstname', 'title', 'author', 'isbn', 'language', 'genres', 'issue_date')
              // ->where('borrow.approved','=',"approved")
              // ->where('borrow.issue_date','=',$date)
              ->whereBetween('borrow.issue_date', [$date, $todate])
               //->select('borrow.*','borrow.user_id','borrow.book_id')
               ->get()->toArray();
               return $result;
    }
    
    public function borrowNow($allCart, $userId)
    {
        foreach ($allCart as $cart) {
            //dd($bookid);
            $borrow= new Borrow;
            
            $borrow->book_id=$cart['book_id'];
            $borrow->user_id=$cart['user_id'];
            $borrow->approved="pending";
            $borrow->issue_date="pending";
            $borrow->return_date="pending";
            
            $borrow->save();
            
            Cart::where('user_id', $userId)->delete();
        }
    }
    public function borrowedBooks($userId)
    {
          $borrow=$this->join('books', 'borrow.book_id', '=', 'books.id')
               ->where('borrow.user_id', $userId)
              // ->select('books.*','borrow.id as cart_id')
               ->get();
            return $borrow;
    }
    public function borrowedBookslist()
    {
         $borrow=$this->join('books', 'borrow.book_id', '=', 'books.id')
                    ->join('users', 'borrow.user_id', '=', 'users.id')
                 
               ->where('borrow.approved', '=', "approved")
               //->select('borrow.*','borrow.user_id','borrow.book_id')
               ->get();
        return $borrow;
    }
    public function requestBookslist()
    {
          $borrow=$this->join('books', 'borrow.book_id', '=', 'books.id')
                    ->join('users', 'borrow.user_id', '=', 'users.id')
                 
               ->where('borrow.approved', '=', "pending")
               //->select('borrow.*','borrow.user_id','borrow.book_id')
               ->get();
        return $borrow;
    }
    public function returnBookslist()
    {
        $borrow=$this->join('books', 'borrow.book_id', '=', 'books.id')
                    ->join('users', 'borrow.user_id', '=', 'users.id')
                 
               ->where('borrow.approved', '=', "return")
               //->select('borrow.*','borrow.user_id','borrow.book_id')
               ->get();
        return $borrow;
    }
    
    public function updateReturn($id, $id1)
    {
         $borrow= $this->where('book_id', $id1)->where('user_id', $id)->update([
        'approved'=>"return"
        //'issue_date'=>$request->issue_date,
        //'return_date'=>$request->return_date
         ]);
        
        $book=Book::where('id', '=', $id1);
        
        $book->increment('quantity', 1);
    }
    public function convert_customer_data_to_html($userId)
    {
         $borrow= $this->join('books', 'borrow.book_id', '=', 'books.id')
               ->where('borrow.user_id', $userId)
              // ->select('books.*','borrow.id as cart_id')
               ->get();
            return $borrow;
    }
}
