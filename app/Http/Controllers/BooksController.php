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

class BooksController extends Controller
{
    public function __construct(Book $books)
    {
        $this->book = $books;
    }
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
    public function bookList()
    {
        return view('admin.booklist');
    }
    public function userProfile()
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

       
     //   try{
       /*  $book=new Book;
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
        $book->quantity=$request->get('quantity');

        $book->save();*/
     //  $book=new Book;
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('upload', $filename);
            $this->book->image = $filename;
        }
        
        $book= [

        'title'=>$request->get('title'),
        'author'=>$request->get('author'),
        'publisher'=>$request->get('publisher'),
        'isbn'=>$request->get('isbn'),
        'description'=>$request->get('description'),
        'language'=>$request->get('language'),
        'genres'=>$request->get('genres'),
        //$book->image=$request->get('image');
        
        'image' => $filename,
        
        'quantity'=>$request->get('quantity')
        ];
      // $books = new Book;
        $books = $this->book->storeBooks($book);
        //$bookInfo = Book::where('id','=', $request->email)->first();
        //echo "data inserted";
         //return redirect('admin/dashboard')->with('error','Data added succesfully.');
          return redirect('admin/booklist')->with('error', 'Book added succesfully.');
       /* }catch(\Exception $e){
         return redirect('admin/booklist')->with('error','Book added Fail.');
    }*/
    }
   
  /* public function show(Request $request)
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
    //  $books=Book::paginate(2);
        //$books=Book::all();
        //return view('admin.dashboard',['books'=>$books]);
        return view('admin.booklist',['books'=>$books]);
    }*/
    public function show(Request $request)
    {
    
    //  $book = new Book;
        $limit_records = isset($request->limit_records) ? $request->limit_records : 3;
        $search = request()->query('search');
        $books = $this->book->showBooks($limit_records, $search);
        
        return view('admin.booklist', ['books'=>$books]);
    }
    
    
    public function destroy($id)
    {
     //try{
        
        //$book=new Book;
        $books = $this->book->deleteBooks($id);
        //$book=Book::where('book_id',$book_id)->first();;
        /*$filename = $book->image;
        $filepath = public_path('upload/'.$filename);
        //dd($filepath);
        unlink($filepath);
        $book->delete();*/
        
        //return redirect('admin/dashboard')->with('error','Data Deleted succesfully.');
        return redirect('admin/booklist')->with('error', 'Book Deleted succesfully.');
     /*}catch(\Exception $e){
         return redirect('admin/booklist')->with('error','Book Deleted Fail.');
    }*/
    }
    public function edit(Request $request, $id)
    {
        try {
             //$books=Book::find($id);
             //$post->delete();
            $books=$this->book->editBooks($id);
            return view('admin.editbook', ['books'=>$books]);
        } catch (\Exception $e) {
             return redirect('admin/booklist')->with('error', 'Book Id Not Found.');
        }
    }
    public function update(Request $request, $id)
    {
        //$books=new Book;
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('upload', $filename);
            $this->book->image = $filename;
        }
        
        if ($request->file('image')) {
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

            try {
            /*$books=Book::find($id);

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

            $books->save();*/
                $book= [

                'title'=>$request->get('title'),
                'author'=>$request->get('author'),
                'publisher'=>$request->get('publisher'),
                'isbn'=>$request->get('isbn'),
                'description'=>$request->get('description'),
                'language'=>$request->get('language'),
                'genres'=>$request->get('genres'),
            //$book->image=$request->get('image');
        
                'image' => $filename,
        
                'quantity'=>$request->get('quantity')
                ];
       
                $this->book->updateBooks($book, $id);
            } catch (\Exception $e) {
                return redirect('admin/userprofile')->with('error', 'Book Updated Fail.');
            }
        } else {
            $request->validate([
       
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'isbn' => 'required',
            'description' => 'required',
            'language' => 'required',
            'genres' => 'required',
            
            ]);

            $book= [

            'title'=>$request->get('title'),
            'author'=>$request->get('author'),
            'publisher'=>$request->get('publisher'),
            'isbn'=>$request->get('isbn'),
            'description'=>$request->get('description'),
            'language'=>$request->get('language'),
            'genres'=>$request->get('genres'),
        //$book->image=$request->get('image');
        
            'quantity'=>$request->get('quantity')
            ];
            $this->book->updateBooks($book, $id);
        }
        //return redirect('admin/dashboard')->with('error','Data Updated succesfully.');;
        return redirect('admin/booklist')->with('error', 'Book Updated succesfully.');
    }
    function showBook()
    {
        /*$search = request()->query('search');
       if($search){

        $books = Book::where('title','LIKE',"%{$search}%")->Paginate(3);

       }
       else{

           $books = Book::Paginate(5);
       }*/
       
        $search = request()->query('search');
        $books = $this->book->showBook($search);
        
        //$books=Book::all();
        return view('user.userdashboard', ['books'=>$books]);
     //return view('user.showbooks',['books'=>$books]);
    }
    function singleBook($id)
    {
        $books=$this->book->singleBook($id);
    // $books=Book::find($id);
        //$post->delete();
        return view('user.singlebook', ['books'=>$books]);
    }
}
