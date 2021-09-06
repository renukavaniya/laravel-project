<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Models\Borrow;
use App\Models\Book;
use Auth;
use DB;
use PDF;
use Mail;



use Excel;
use App\Exports\BookExport;
use App\Exports\BydateExport;
use App\Imports\BookImport;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    public function __construct(User $users)
    {
        $this->user = $users;
    }

    function index()
    {
        
    
        if (isset(Auth::user()->email)) {
            return back();
        }
    
        
        return view('admin.login');
    }
    
    function auth(Request $request)
    {
        
        $this->validate($request, [
        'email'   => 'required|email',
        'password'  => 'required|min:5'
        ]);

        $user_data = array(
        'email'  => $request->get('email'),
        'password' => $request->get('password')
        );
//   $remember = $request->get('remember')?true:false;

   /*  if(Auth::attempt($user_data))
     {

         $remember = $request->remember;

         if(!empty($remember))
         {
            setcookie('email',$request->get('email'),time()+60*60*24*15);
            setcookie('password',$request->get('password'),time()+60*60*24*15);
            //dd($request->remember);
         }
        if(auth()->user()->is_admin==1){
        return redirect('admin/dashboard');
        }else{
            //echo "you dont have access to  admin";
            //return redirect()->route('abcd');
            return redirect('welcome')->with('error', 'you dont have access to  admin');
            // return back()->with('error', 'you dont have access to  admin');
        }
     }
     else
     {
        // echo "Not Success";
      return back()->with('error', 'Wrong Login Details');
     }*/
        if ($this->user->login($user_data)) {
            if (auth()->user()->is_admin==1) {
                return redirect('admin/dashboard');
            } else {
                return redirect('welcome')->with('error', 'you dont have access to  admin');
            }
           //return redirect('/userdashboard');
        } else {
           // echo "Not Success";
            return back()->with('error', 'Wrong Login Details');
        }
     /* $userInfo = User::where('email','=', $request->email)->first();

        if(!$userInfo){
            return back()->with('error','We do not recognize your email address');
        }else{
            //check password
            if(Hash::check($request->password, $userInfo->password)){

                //$request->session()->put('users', $userInfo->firstname);
               if($userInfo->is_admin==1){
                 $request->session()->put('AdminUser', $userInfo->id);
                return redirect('admin/dashboard');
                }else{

            return redirect('welcome')->with('error', 'you dont have access to  admin');

        }

            }else{
                return back()->with('error','Incorrect password');
            }
        }*/
    }
    function dashboard()
    {
    //$data = ['LoggedUserInfo'=>User::where('id','=', session('AdminUser'))->first()];
        return view('admin.dashboard');
    }

    function logout()
    {
        Auth::logout();
        return redirect('admin');
    }
    /*function logout()
    {

      if(session()->has('AdminUser')){
            session()->pull('AdminUser');
            return redirect('admin');
        }
    }*/
    
    function changepassword()
    {
    //$data = ['LoggedUserInfo'=>User::where('id','=', session('AdminUser'))->first()];
        return view('admin.changepassword');
    }
    function update_password(Request $request)
    {
        //$data = ['LoggedUserInfo'=>User::where('id','=', session('AdminUser'))->first()];
        $request->validate([
        'old_password'=>'required|min:6|max:100',
        'new_password'=>'required|min:6|max:100',
        'confirm_password'=>'required|same:new_password'
        ]);

         /*$current_user=auth()->user();

         if(Hash::check($request->old_password,$current_user->password)){

            $current_user->update([
                'password'=>bcrypt($request->new_password)
            ]);

            return redirect()->back()->with('success','Password successfully updated.');

         }else{
            return redirect()->back()->with('error','Old password does not matched.');
         }*/
         $current_user=auth()->user();
         $old_password=$request->old_password;
         $new_password=$request->new_password;
        
        if ($this->user->updateUserPassword($old_password, $new_password, $current_user)) {
            return redirect()->back()->with('success', 'Password successfully updated.');
        } else {
            return redirect()->back()->with('error', 'Old password does not matched.');
        }
    }
    
    
  
    public function exportToExcel(Request $request)
    {
        return Excel::download(new BookExport, 'Book-excel.xlsx');
    }
    function excel(Request $request, $id)
    {
        //dd($id);
        $request->session()->put('id', $id);
        return Excel::download(new BookExport, 'Book-excel.xlsx');
    }
    function excel_bydate(Request $request)
    {
        //dd($id);
        //$user->=$request->get('firstname');
        $request->session()->put('date', $request->date);
        $request->session()->put('todate', $request->todate);
        return Excel::download(new BydateExport, 'Bydate-excel.xlsx');
    }
    public function importForm(Request $request)
    {
        Excel::import(new BookImport, $request->file);
        return "Records are imported";
    }
   
  
    public function approve_form($id, $id2)
    {
        $book=User::find($id);
        $book1=Borrow::find($id2);
        //$borrow= DB::table('book')
        
         return view('admin.approve_form', ['book'=>$book], ['book1'=>$book1]);
    }
    public function approve_book(Request $request)
    {
      // $borrow =  Borrow::find($id);
        //$users=User::find($id);
        //$users->firstname=$request->get('firstname');
        /*$borrow->approved=$request->get('approved');
        $borrow->issue_date=$request->get('issue_date');
        $borrow->return_date=$request->get('return_date');

        $borrow->save();*/
        //dd($request->id);
         $this->validate($request, [
        'approved'   => 'required',
        'issue_date'  => 'required',
        'return_date'=> 'required'
         ]);
        $bookid = session('bookid');
        //dd($request->id2);
        //$userid = session('userid');
        $id2=$request->id2;
        $id=$request->id;
        $approve=$request->approved;
        $i_date=$request->issue_date;
        $r_date=$request->return_date;
         $borrow=$this->user->approveBook($id2, $id, $approve, $i_date, $r_date);
         
         /*$borrow= DB::table('borrow')->where('book_id',$request->id2)->where('user_id',$request->id)->update([
        'approved'=>$request->approved,
        'issue_date'=>$request->issue_date,
        'return_date'=>$request->return_date ]);*/
        
        /*$data=['firstname'=>"renuka",'data'=>'Hello Renuka'];

       $user['to']='renuka.vaniya@brainvire.com';
      // $pdf = PDF::loadView('user.borrowedbooks',compact('borrow'));
       Mail::send('mail',$data,function($msg)use($user){
        // Mail::send('mail',$borrow,function($msg)use($user){
            // $msg->pdf = PDF::loadView('user.borrowedbooks',$borrow);
         $msg->to( $user['to']);
        $msg->subject("Order confirmation");
        //$msg->attach("dummy.pdf");
        //$msg->attachData($pdf->output(), "invoice.pdf");
       });*/
     
     
     
        $data["email"]='renuka.vaniya@brainvire.com';
        $data["client_name"]='renuka vaniya';
        $data["subject"]='Order Confirmation';
        
        // $pdf->loadHTML('admin.request');
        $pdf = \App::make('dompdf.wrapper');
        $id2=$request->id2;
        $id=$request->id;
        $pdf->loadHTML($this->convert_customer_data_to_html($id2, $id));
     
      //return $pdf->stream();
        
         // $pdf = PDF::loadView('admin.request', $borrow);
        //$pdf->loadHTML('admin.request');
  //dd($pdf);
        
            Mail::send('mail', $data, function ($message) use ($data, $pdf) {
                $message->to($data["email"], $data["client_name"])
                ->subject($data["subject"])
                ->attachData($pdf->stream(), "invoice.pdf");
            });
     
                
        //$borrow->save();
        //$borrow= DB::table('borrow')->join('books','borrow.book_id','=','books.id')->decrement('quantity',1);
        return back()->with('error', 'Book Approved ');
        //return redirect('admin/dashboard')->with('error','Book Approved.');
    }
     
    public function website()
    {
        /*$userId=auth()->user()->id;
         $borrow= DB::table('borrow')->join('books','borrow.book_id','=','books.id')
               ->where('borrow.user_id',$userId)
              // ->select('books.*','borrow.id as cart_id')
               ->get();*/
        
       // foreach($borrow as $book)
        /*$data=['firstname'=>"renuka",'data'=>'Hello Renuka'];
        $user['to']='renuka.vaniya@brainvire.com';
       // $pdf = PDF::loadView('user.borrowedbooks',compact('borrow'));
        Mail::send('mail',$data,function($msg)use($user){
        // Mail::send('mail',$borrow,function($msg)use($user){
            // $msg->pdf = PDF::loadView('user.borrowedbooks',$borrow);
         $msg->to( $user['to']);
        $msg->subject("Order confirmation");
        //$msg->attach("dummy.pdf");
        //$msg->attachData($pdf->output(), "invoice.pdf");
        });*/
        $borrow=Borrow::join('books', 'borrow.book_id', '=', 'books.id')
                    ->join('users', 'borrow.user_id', '=', 'users.id')
                 
               ->where('borrow.approved', '=', "pending")
               //->select('borrow.*','borrow.user_id','borrow.book_id')
               ->get();
         // return $borrow;
        $data["email"]='renuka.vaniya@brainvire.com';
        $data["client_name"]='renuka vaniya';
        $data["subject"]='Order Confirmation';
        
        // $pdf->loadHTML('admin.request');
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_customer_data_to_html());
       //return $pdf->stream();
        
          // $pdf = PDF::loadView('admin.request', $borrow);
        //$pdf->loadHTML('admin.request');
   //dd($pdf);
        
            Mail::send('mail', $data, function ($message) use ($data, $pdf) {
                $message->to($data["email"], $data["client_name"])
                ->subject($data["subject"])
                ->attachData($pdf->stream(), "invoice.pdf");
            });
    }

    function convert_customer_data_to_html($id2, $id)
    {
        $userId=auth()->user()->id;
       /* $borrow= DB::table('borrow')->join('books','borrow.book_id','=','books.id')
               ->where('borrow.user_id',$userId)
              // ->select('books.*','borrow.id as cart_id')
               ->get();*/
               $borrow=$this->user->convert_customer_data_to_html($id2, $id);
               /*$borrow=Borrow::join('books','borrow.book_id','=','books.id')
                    ->join('users','borrow.user_id','=','users.id')

               ->where('borrow.approved','=',"approved")
               ->where('borrow.user_id','=',$id)
               ->where('borrow.book_id','=',$id2)
               //->select('borrow.*','borrow.user_id','borrow.book_id')
               ->get();*/
    
    
      //  $a ='<h1>Hello</h1>';
      // $borrow = $this->get_customer_data();
       /*$output = '
       <h3 align="center">Books Data</h3>';

       return $output;*/
          $output = '
     <h3 align="center">Books Data</h3>
     <table width="100%" style="border-collapse: collapse; border: 0px;">
      <tr>
    <th style="border: 1px solid; padding:12px;" width="20%">Book_name</th>
    <th style="border: 1px solid; padding:12px;" width="30%">Author</th>
    <th style="border: 1px solid; padding:12px;" width="15%">Publisher</th>
    <th style="border: 1px solid; padding:12px;" width="15%">ISBN</th>
    <th style="border: 1px solid; padding:12px;" width="20%">Description</th>
	<th style="border: 1px solid; padding:12px;" width="20%">Issue_Date</th>
	<th style="border: 1px solid; padding:12px;" width="20%">Return_Date</th>
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
	   <td style="border: 1px solid; padding:12px;">'.$book->issue_date.'</td>
	   <td style="border: 1px solid; padding:12px;">'.$book->return_date.'</td>
      </tr>
      ';
        }
        $output .= '</table>';
        return $output;
    }
}
