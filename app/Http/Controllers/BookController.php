<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\Book;
use App\Models\User;
use Validator;
use Auth;



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
		//echo "data insertted";
		 //return redirect('admin/dashboard')->with('error','Data added succesfully.');
		  return redirect('admin/booklist')->with('error','Book added succesfully.');
		
		 
   }
   
   public function show(Request $request)
	{	
	
		$limit_records = isset($_GET["limit_records"]) ? $_GET["limit_records"] : 3;
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
		$book=Book::find($id);
		$filename = $book->image;
		$filepath = public_path('upload/'.$filename);
		//dd($filepath);
		unlink($filepath);
		$book->delete();
		//return redirect('admin/dashboard')->with('error','Data Deleted succesfully.');
		return redirect('admin/booklist')->with('error','Book Deleted succesfully.');
	}
	public function edit(Request $request,$id)
	{
		$books=Book::find($id);
		//$post->delete();
		return view('admin.editbook',['books'=>$books]);
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
		return redirect('admin/booklist')->with('error','Book Updated succesfully.');;
		
	}
	
}
