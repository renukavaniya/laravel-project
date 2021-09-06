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
    
    public function showBooks($limit_records, $search)
    {
     
        $limit_records = isset($limit_records) ? $limit_records : 3;
        //$page = isset($_GET["page"]);
        //$search = request()->query('search');
        if ($search) {
         //dd($search);
            $books = $this->where('title', 'LIKE', "%{$search}%")->sortable()->Paginate($limit_records);
         //dd($Books);
        } else {
            $books = $this->sortable()->Paginate($limit_records);
        }
    
        return $books;
    }
    
    public function storeBooks($book)
    {
      //dd($book->title);
        $this->create($book);
    }
    public function deleteBooks($id)
    {
        $book=$this->find($id);
        //$book=Book::where('book_id',$book_id)->first();;
        $filename = $book->image;
        $filepath = public_path('upload/'.$filename);
        //dd($filepath);
        unlink($filepath);
        $book->delete();
    }
    public function editBooks($id)
    {
        return $this->find($id);
    }
    public function updateBooks($book, $id)
    {
     // dd($book);
        $this->where('id', $id)->update($book);
    }

    public function showBook($search)
    {
     
       // $limit_records = isset($limit_records) ? $limit_records : 3;
        //$page = isset($_GET["page"]);
        //$search = request()->query('search');
        if ($search) {
        //dd($search);
            $books = $this->where('title', 'LIKE', "%{$search}%")->sortable()->Paginate(3);
        //dd($Books);
        } else {
            $books = $this->sortable()->Paginate(5);
        }
    
        return $books;
    }
    public function singleBook($id)
    {
        return $this->find($id);
    }
}
