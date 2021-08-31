<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
	public function storeuser(Request $request)
	{   
	
	     $rules=array(
	        "firstname" => "required",
            "lastname" => "required",
			"email"   => "required|email|unique:users",
			"password" => "required|min:6|max:100",
            "dob" => "required",
			"mobile" => "required|digits:10",
			"gender" => "required",
			"address" => "required",
			"state" => "required",
			"city" => "required"
			 
        );
		$validator=Validator::make($request->all(),$rules);
		if($validator->fails())
		{
			return response()->json($validator->errors(),401);
		}
        else{
			$user= new User;
		$user->firstname=$request->firstname;
		$user->lastname=$request->lastname;
		$user->email=$request->email;
		$user->password =$request->password;
		$user->password = Hash::make($user->password);
		$user->dob=$request->dob;
		$user->mobile=$request->mobile;
		$user->gender=$request->gender;
		$user->address=$request->address;
		$user->state=$request->state;
		$user->city=$request->city;
		
		$result=$user->save();
		if($result){
		return ["Result"=>"registration success."];
	}
	else
	{
		return ["Result"=>"registration Fail."];
	}
		}
		
}
public function login(Request $request)
{
 $rules=array(
	        
			"email"   => "required|email",
			"password" => "required|min:6|max:100",
);
    $user_data = array(
      'email'  => $request->email,
      'password' => $request->password
     );		
$validator=Validator::make($request->all(),$rules);
		if($validator->fails())
		{
		return response()->json($validator->errors(),401);
		}
		else{
   if(Auth::attempt($user_data))
     {
	 return ["Result"=>"login success."];
	}
     else
     {
		return ["Result"=>"login fail."]; 
     }	
	}	 
}
public function editprofile($id){
	return User::find($id);
}

public function updateprofile(Request $request)
{
	    $users=User::find($request->id);
		
		$users->firstname=$request->firstname;
		$users->lastname=$request->lastname;
		$users->email=$request->email;
		$users->dob=$request->dob;
		$users->mobile=$request->mobile;
		$users->gender=$request->gender;
		$users->address=$request->address;
		$users->state=$request->state;
		$users->city=$request->city;
		$result=$users->save();
		if($result){
	    return ["Result"=>"user profile updated succesfuly."];
		}
		else{
			return ["Result"=>"user profile updated Fail."];
		}
}
function update_password(Request $request){
		//$data = ['LoggedUserInfo'=>User::where('id','=', session('AdminUser'))->first()];	
        $request->validate([
        'old_password'=>'required|min:6|max:100',
        'new_password'=>'required|min:6|max:100',
        'confirm_password'=>'required|same:new_password'
        ]);

        //$current_user=auth()->user();
		$current_user=21;
        if(Hash::check($request->old_password,$current_user->password)){

            $current_user->update([
                'password'=>bcrypt($request->new_password)
            ]);

            return ('Password successfully updated.');

        }else{
            return ('Old password does not matched.');
        }

    }



}
