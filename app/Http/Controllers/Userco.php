<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Auth;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class Userco extends Controller
{
    /* function index()
    {
     return view('user.login');
    }*/
	function renuka($id){
	return	User::find($id);
	}
	
	function index()
    {
	if(isset(Auth::user()->email)){
		return back();
	}	
		
     return view('user.login');
    }
	
	function login(Request $request)
    {
	 
    $this->validateLogin($request);

    if ($this->attemptLogin($request)) {
        $user = $this->guard()->user();
        $user->generateToken();

        return response()->json([
            'data' => $user->toArray(),
        ]);
    }

    return $this->sendFailedLoginResponse($request);
    }
	function userdashboard()
    {
	//$data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];	
	
     return view('user.userdashboard');
    }
	
	 public function register()
   {
	   if(session()->has('LoggedUser')){
            
           return back();
        }
	   
	   return view('user.register');
   }
    public function edituserprofile(Request $request,$id)
   {
		//$data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];	
		try{
	   $users=User::find($id);
	   
		//$post->delete();
		//return view('admin.edituser',['users'=>$users]);
	   return view('user.editprofile',['users'=>$users]);
   }catch(\Exception $e){
		 return redirect('admin/userprofile')->with('error','Id no found.');
   }
   }
   public function updateuserprofile(Request $request,$id)
	{
		//$data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];	
		
		
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

		try{
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
		
		//return redirect('admin/dashboard')->with('error','Data Updated succesfully.');;
		return back()->with('error','User profile Updated succesfully.');
		}
		catch(\Exception $e)
		 {
			 return back()->with('error','User profile Updated Fail.');
		 }
		
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

	   try{
	   
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
		$request->session()->put('users',$request->get('firstname'));
		return redirect('user')->with('success','Registration has been successfully.');
   }catch(\Exception $e){
		  return back()->with('error','Registration Fail.');
   }
		 
   }
   
   public function deleteuser(Request $request,$id){
	   try{
	   $user = User::find($id);
	   
	   $user->delete();
	   return redirect('admin/userprofile')->with('error','User Data Deleted succesfully.');
	   }
	   catch(\Exception $e){
		 return redirect('admin/userprofile')->with('error','User Data Delete Fail.');
   }
   }
   
   public function edituser(Request $request,$id)
	{  try{
		$users=User::find($id);
		//$post->delete();
		return view('admin.edituser',['users'=>$users]);
	}
	catch(\Exception $e){
		 return redirect('admin/userprofile')->with('error','Id Not Found.');
   }
		
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

		try{
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
		catch(\Exception $e){
		 return redirect('admin/userprofile')->with('error','User Upldated Fail.');
   }
		
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

		try{
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
		
		//return redirect('admin/dashboard')->with('error','Data Updated succesfully.');;
		return redirect('admin/userprofile')->with('error','User Updated succesfully.');
		}
		catch(\Exception $e){
		 return redirect('admin/userprofile')->with('error','User Updated Fail.');
        }
		}
	}
	function logout()
    {
		/*if(session()->has('users')){
            session()->pull('users');
          //  return redirect('/user');
        }*/
     Auth::logout();
     return redirect('user');
	/* if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect('/user');
        }*/
	 
    }
	
	function changeuserpassword($id)
    {
		//$data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];

      $users=User::find($id);
		//$post->delete();
		//return view('admin.edituser',['users'=>$users]);
		
     return view('user.changeuserpassword',['users'=>$users]);
    }
	public function updateuserpassword(Request $request){
		//$data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];	
		//$users=User::find($id);
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
