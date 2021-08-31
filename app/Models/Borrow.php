<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Request;

class Borrow extends Model
{
    use HasFactory;
	public $table="Borrow";
	//protected $fillable=['book_id','user_id','approved','issue_date','return_date'];
	public $timestamps=false;
	
	public static function getAllBooks()
	{  //Request::get($id);
	$id = session('id');
		$result = DB::table('Borrow')->join('books','borrow.book_id','=','books.id')
					
				    ->join('users','borrow.user_id','=','users.id')
					->select('firstname','title','author','isbn','language','genres')
		       ->where('borrow.approved','=',"approved")
			   ->where('borrow.user_id','=',$id)
		       //->select('borrow.*','borrow.user_id','borrow.book_id')
			   ->get()->toArray();
			   return $result;
	}
	public static function getBooks()
	{  //Request::get($id);
	$date = session('date');
	$todate = session('todate');
		$result = DB::table('Borrow')->join('books','borrow.book_id','=','books.id')
					
				    ->join('users','borrow.user_id','=','users.id')
					->select('firstname','title','author','isbn','language','genres','issue_date')
		      // ->where('borrow.approved','=',"approved")
			  // ->where('borrow.issue_date','=',$date)
			  ->whereBetween('borrow.issue_date', [$date, $todate])
		       //->select('borrow.*','borrow.user_id','borrow.book_id')
			   ->get()->toArray();
			   return $result;
	}
	
}
