<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    function index()
    {
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
//	 $remember = $request->get('remember')?true:false;
     if(Auth::attempt($user_data))
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
     }

    }
	function dashboard()
    {
     return view('admin.dashboard');
    }

	function logout()
    {
     Auth::logout();
     return redirect('admin');
    }
	function changepassword()
    {
     return view('admin.changepassword');
    }
	public function update_password(Request $request){
        $request->validate([
        'old_password'=>'required|min:6|max:100',
        'new_password'=>'required|min:6|max:100',
        'confirm_password'=>'required|same:new_password'
        ]);

        $current_user=auth()->user();

        if(Hash::check($request->old_password,$current_user->password)){

            $current_user->update([
                'password'=>bcrypt($request->new_password)
            ]);

            return redirect()->back()->with('success','Password successfully updated.');

        }else{
            return redirect()->back()->with('error','Old password does not matched.');
        }



    }

	
}
?>

