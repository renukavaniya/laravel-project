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

class BorrowController extends Controller
{
    public function __construct(Borrow $borrow)
    {
        $this->borrow = $borrow;
    }

    public function borrowNow(Request $request)
    {
        $userId=auth()->user()->id;
         $allCart= Cart::where('user_id', $userId)->get();
         $borrow=$this->borrow->borrowNow($allCart, $userId);
         $bookid=Session::get('bookid');
        // dd($bookid);
         $userid=Session::get('userid');
         
         
         //$request->input();
        /*$books = Cart::join('books','cart.book_id','=','books.id')
               ->where('cart.user_id',$userId)
               ->select('books.*','cart.id as cart_id')
               ->get();*/
        return redirect('/userdashboard')->with('error', 'Send Request');
        ;
     //return redirect()->back();
    }
    public function borrowedbooks()
    {
         $userId=auth()->user()->id;
         $borrow = $this->borrow->borrowedBooks($userId);
    
               
        return view('user.borrowedbooks', ['borrow'=>$borrow]);
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
              
        $borrow=$this->borrow->convert_customer_data_to_html($userId);
    //  $a ='<h1>Hello</h1>';
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
        foreach ($borrow as $book) {
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
    
 /*public function return_book($id)
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
 }*/
    public function borrow_Book(Request $request)
    {
        //$userId=auth()->user()->id;
       // $books=Borrow::all();
        ///$userId=auth()->user()->id;
        $borrow = $this->borrow->borrowedBookslist();
    
              
               
        return view('admin.borrow_book', ['borrow'=>$borrow]);
    }
    public function request_Book(Request $request)
    {
       //$userId=auth()->user()->id;
      // $books=Borrow::all();
        $borrow = $this->borrow->requestBookslist();
              
               
        return view('admin.request', ['borrow'=>$borrow]);
    }
    public function return_Booklist(Request $request)
    {
      //$userId=auth()->user()->id;
     // $books=Borrow::all();
        $borrow = $this->borrow->returnBookslist();
          
               
        return view('admin.return_book', ['borrow'=>$borrow]);
    }
    public function updateReturn($id, $id1)
    {
    // dd($id1);
        $userId=auth()->user()->id;
     // $bookid=Session::get('bookid');
        $borrow = $this->borrow->updateReturn($id, $id1);
      
        return back()->with('success', 'Book Return Successfully');
    }

    //
}
