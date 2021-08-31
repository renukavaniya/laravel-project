<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Book extends Model
{
    use HasFactory;
	use Sortable;
	
	protected $table="books";
	protected $fillable=['title','author','publisher','isbn','description','language','genres','image','quantity'];
	
	public $sortable = ['book_id', 'title','author','publisher','isbn','description','language','genres','image','quantity'];
	
	
	        
}
