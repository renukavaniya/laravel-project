<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Auth;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /* function index()
    {
     return view('user.login');
    }*/
    public function __construct(User $users)
    {
        $this->user = $users;
    }

    function index()
    {
        if (isset(Auth::user()->email)) {
            return back();
        }
        
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
    /*  if(Auth::attempt($user_data))
     {


     return redirect('/userdashboard');

     }
     else
     {
        // echo "Not Success";
      return back()->with('error', 'Wrong Login Details');
     }*/
        
        if ($this->user->login($user_data)) {
            return redirect('/userdashboard');
        } else {
           // echo "Not Success";
            return back()->with('error', 'Wrong Login Details');
        }
    //return $user;
     // $user_data = $request->only('email', 'password');
     
//   $remember = $request->get('remember')?true:false;
/*$ab = Auth::attempt($user_data);
dd($ab);*/
//$remember = $request->remember;
/*$user=new User;
      $user->login($user_data,);*/
    
     
           /*  $userInfo = User::where('email','=', $request->email)->first();
//dd($userInfo->password);
        if(!$userInfo){
            return back()->with('error','We do not recognize your email address');
        }else{
            //check password
            if(Hash::check($request->password, $userInfo->password)){

                $request->session()->put('LoggedUser', $userInfo->id);
                $request->session()->put('users', $userInfo->firstname);
                $request->session()->put('password', $userInfo->password);
                return redirect('/userdashboard');
            }else{
                return back()->with('error','Incorrect password');
            }
        }*/
        // return back()->with('error', 'Wrong Login Details');
    }
    function userdashboard()
    {
    //$data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
    
        return view('user.userdashboard');
    }
    
    public function register()
    {
        if (session()->has('LoggedUser')) {
            return back();
        }
       
        return view('user.register');
    }
    public function storeUser(Request $request)
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
        $user= [
        'firstname'=>$request->get('firstname'),
        'lastname'=>$request->get('lastname'),
        'email'=>$request->get('email'),
        'password' =>$request->get('password'),
        'password' => Hash::make('password'),
        'dob'=>$request->get('dob'),
        'mobile'=>$request->get('mobile'),
        'gender'=>$request->get('gender'),
        'address'=>$request->get('address'),
        'state'=>$request->get('state'),
        'city'=>$request->get('city')      ];
     // $books = new Book;
        $users = $this->user->storeUsers($user);
        
         
        return redirect('user')->with('success', 'Registration has been successfully.');
  /* }catch(\Exception $e){
          return back()->with('error','Registration Fail.');
   }*/
    }
   
    public function showUser(Request $request)
    {
        $limit_records = isset($request->limit_records) ? $request->limit_records : 3;
        $search = request()->query('search');
        $users = $this->user->showUsers($limit_records, $search);
        
        
        /*$limit_records = isset($_GET["limit_records"]) ? $_GET["limit_records"] : 3;
        $search = request()->query('search');
        if($search){
        //dd($search);
        $users = User::where('firstname','LIKE',"%{$search}%")->sortable()->Paginate($limit_records);


        }
        else{

           $users = User::sortable()->Paginate($limit_records);
        }*/
        
        //$users=User::all();
        return view('admin.userprofile', ['users'=>$users]);
    }
    public function edituserprofile($id)
    {
        //$data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        //try{
        $users=$this->user->editUserprofile($id);
      // $books=$this->book->editBooks($id);
       
       
        //$post->delete();
        //return view('admin.edituser',['users'=>$users]);
        return view('user.editprofile', ['users'=>$users]);
  /* }catch(\Exception $e){
         return redirect('admin/userprofile')->with('error','Id no found.');
   }*/
    }
    public function updateuserprofile(Request $request, $id)
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

        //try{
        $user= [

        'firstname'=>$request->get('firstname'),
        'lastname'=>$request->get('lastname'),
        'email'=>$request->get('email'),
        
        'dob'=>$request->get('dob'),
        'mobile'=>$request->get('mobile'),
        'gender'=>$request->get('gender'),
        'address'=>$request->get('address'),
        'state'=>$request->get('state'),
        'city'=>$request->get('city')
        ];
       
        $this->user->updateUsers($user, $id);
        //return redirect('admin/dashboard')->with('error','Data Updated succesfully.');;
        return back()->with('error', 'User profile Updated succesfully.');
        /*}
        catch(\Exception $e)
         {
             return back()->with('error','User profile Updated Fail.');
         }*/
    }
   
   
   
    public function deleteuser(Request $request, $id)
    {
        try {
      /*  $user = User::find($id);

        $user->delete();*/
            $users = $this->user->deleteUsers($id);
            return redirect('admin/userprofile')->with('error', 'User Data Deleted succesfully.');
        } catch (\Exception $e) {
            return redirect('admin/userprofile')->with('error', 'User Data Delete Fail.');
        }
    }
   
    public function edituser(Request $request, $id)
    {
        try {
          //  $users=User::find($id);
            $users=$this->user->editUserprofile($id);
              //$post->delete();
            return view('admin.edituser', ['users'=>$users]);
        } catch (\Exception $e) {
            return redirect('admin/userprofile')->with('error', 'Id Not Found.');
        }
    }
    public function updateuser(Request $request, $id)
    {
        if ($request->get('password')) {
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

            try {
                $users=User::find($id);
        
                $users->firstname=$request->get('firstname');
                $users->lastname=$request->get('lastname');
                $users->email=$request->get('email');
                $users->password=$request->get('password');
                $users->password = Hash::make($users->password);
        
                $users->dob=$request->get('dob');
                $users->mobile=$request->get('mobile');
                $users->gender=$request->get('gender');
                $users->address=$request->get('address');
                $users->state=$request->get('state');
                $users->city=$request->get('city');
        
            //$books->image=$request->get('image');
         
                $users->save();
            } catch (\Exception $e) {
                return redirect('admin/userprofile')->with('error', 'User Upldated Fail.');
            }
        } else {
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

            try {
                $user= [

                'firstname'=>$request->get('firstname'),
                'lastname'=>$request->get('lastname'),
                'email'=>$request->get('email'),
        
                'dob'=>$request->get('dob'),
                'mobile'=>$request->get('mobile'),
                'gender'=>$request->get('gender'),
                'address'=>$request->get('address'),
                'state'=>$request->get('state'),
                'city'=>$request->get('city')
                ];
       
                $this->user->updateUsers($user, $id);
            //return redirect('admin/dashboard')->with('error','Data Updated succesfully.');;
                return redirect('admin/userprofile')->with('error', 'User Updated succesfully.');
            } catch (\Exception $e) {
                return redirect('admin/userprofile')->with('error', 'User Updated Fail.');
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
    
    function changeuserpassword()
    {
        //$data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];

     // $users=User::find($id);
        //$post->delete();
        //return view('admin.edituser',['users'=>$users]);
        
        return view('user.changeuserpassword');
    }
    public function updateuserpassword(Request $request)
    {
        //$data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        //$users=User::find($id);
        $request->validate([
        'old_password'=>'required|min:6|max:100',
        'new_password'=>'required|min:6|max:100',
        'confirm_password'=>'required|same:new_password'
        ]);

        $current_user=auth()->user();
        $old_password=$request->old_password;
        $new_password=$request->new_password;
        
        if ($this->user->updateUserPassword($old_password, $new_password, $current_user)) {
            return redirect()->back()->with('success', 'Password successfully updated.');
        } else {
            return redirect()->back()->with('error', 'Old password does not matched.');
        }
    }
}
