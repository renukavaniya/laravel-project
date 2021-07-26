<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Auth;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
     function index()
    {
     return view('user.login');
    }
	
	function login(Request $request)
    {
     $this->validate($request, [
      'email'   => 'required|email',
      'password'  => 'required|min:6'
     ]);

     $user_data = array(
      'email'  => $request->get('email'),
      'password' => $request->get('password')
     );
	 
	 // $user_data = $request->only('email', 'password');
	 
//	 $remember = $request->get('remember')?true:false;
/*$ab = Auth::attempt($user_data);
dd($ab);*/
     if(Auth::attempt($user_data))
     {
		 $remember = $request->remember;
		 
		 if(!empty($remember))
		 {
			setcookie('email',$request->get('email'),time()+60*60*24*15);
			setcookie('password',$request->get('password'),time()+60*60*24*15);
			//dd($request->remember);
		 }
		 
		

     return redirect('user/registerdashboard');
     }
     else
     {
		// echo "Not Success";
      return back()->with('error', 'Wrong Login Details');     
     }

    }
	 public function register()
   {
	   return view('user.register');
   }
    public function storeuser(Request $request)
   {
	   $request->validate([
	   
			'firstname' => 'required',
            'lastname' => 'required',
			'email'   => 'required|email|unique:users',
			'password' => 'required|min:6|max:100',
			'cpassword' => 'required|same:password',
			'dob' => 'required',
			'mobile' => 'required|digits:10',
			'gender' => 'required',
			'address' => 'required',
			'state' => 'required',
			'city' => 'required',
			 
        ]);

	   
	   
	    $user=new User;
		$user->firstname=$request->get('firstname');
		$user->lastname=$request->get('lastname');
		$user->email=$request->get('email');
		$user->password =$request->get('password');
		$user->password = Hash::make($user->password);
		$user->dob=$request->get('dob');
		$user->mobile=$request->get('mobile');
		$user->gender=$request->get('gender');
		$user->address=$request->get('address');
		$user->state=$request->get('state');
		$user->city=$request->get('city');
		
		$user->save();
		echo "REGISTARTION SUCCSESS ";
		 
		  //return redirect('admin/booklist')->with('error','Book added succesfully.');
		
		 
   }
   
   public function deleteuser(Request $request,$id){
	   
	   $user = User::find($id);
	   
	   $user->delete();
	   return redirect('admin/userprofile')->with('error','User Data Deleted succesfully.');
	   
   }
   
   public function edituser(Request $request,$id)
	{
		$users=User::find($id);
		//$post->delete();
		return view('admin.edituser',['users'=>$users]);
	}
	public function updateuser(Request $request,$id)
	{
		if($request->get('password')){
		$request->validate([
	   
			'firstname' => 'required',
            'lastname' => 'required',
			'email' => 'required|email',
			'password' => 'required|min:6|max:100',
			'cpassword' => 'required|same:password',
			'dob' => 'required',
			'mobile' => 'required',
			'gender' => 'required',
			'address' => 'required',
			'state' => 'required',
			'city' => 'required',
            
        ]);

		
		$users=User::find($id);
		
		$users->firstname=$request->get('firstname');
		$users->lastname=$request->get('lastname');
		$users->email=$request->get('email');
		$users->password=$request->get('password');
		$users->password = Hash::make($users->password );
		
		$users->dob=$request->get('dob');
		$users->mobile=$request->get('mobile');
		$users->gender=$request->get('gender');
		$users->address=$request->get('address');
		$users->state=$request->get('state');
		$users->city=$request->get('city');
		
		//$books->image=$request->get('image');
		 
		$users->save();
		}
		else{
			$request->validate([
	   
			'firstname' => 'required',
            'lastname' => 'required',
			'email' => 'required|email',
			
			'dob' => 'required',
			'mobile' => 'required',
			'gender' => 'required',
			'address' => 'required',
			'state' => 'required',
			'city' => 'required',
            
        ]);

		
		$users=User::find($id);
		
		$users->firstname=$request->get('firstname');
		$users->lastname=$request->get('lastname');
		$users->email=$request->get('email');
		
		$users->dob=$request->get('dob');
		$users->mobile=$request->get('mobile');
		$users->gender=$request->get('gender');
		$users->address=$request->get('address');
		$users->state=$request->get('state');
		$users->city=$request->get('city');
		
		//$books->image=$request->get('image');
		 
		$users->save();
		}
		//return redirect('admin/dashboard')->with('error','Data Updated succesfully.');;
		return redirect('admin/userprofile')->with('error','User Updated succesfully.');
		
	}
	function logout()
    {
     Auth::logout();
     return redirect('user');
    }
	
}
