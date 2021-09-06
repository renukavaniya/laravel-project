<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Validator;

use Auth;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'firstname',
            'lastname',
            'email',
            'password',
            'dob',
            'mobile',
            'gender',
            'address',
            'state',
            'city'
    ];
    
    public $sortable = ['id',  'firstname',
            'lastname',
            'email',
            'password',
            'dob',
            'mobile',
            'gender',
            'address',
            'state',
            'city'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    
    public function storeUsers($user)
    {
        $this->create($user);
    }
    
    public function showUsers($limit_records, $search)
    {
     
        $limit_records = isset($limit_records) ? $limit_records : 3;
        //$page = isset($_GET["page"]);
        //$search = request()->query('search');
        if ($search) {
         //dd($search);
            $users = $this->where('firstname', 'LIKE', "%{$search}%")->sortable()->Paginate($limit_records);
         //dd($Books);
        } else {
            $users = $this->sortable()->Paginate($limit_records);
        }
    
        return $users;
    }
    
    public function editUserProfile($id)
    {
        return $this->find($id);
    }
    public function updateUsers($user, $id)
    {
     // dd($book);
        $this->where('id', $id)->update($user);
    }
    public function deleteUsers($id)
    {
        $user=$this->find($id);
        //$book=Book::where('book_id',$book_id)->first();;
        
        $user->delete();
    }
    public function login($user_data)
    {
        if (Auth::attempt($user_data)) {
            return Auth::attempt($user_data);
        }
    }
    public function updateUserPassword($old_password, $new_password, $current_user)
    {
        
        if (Hash::check($old_password, $current_user->password)) {
            $current_user->update([
                'password'=>bcrypt($new_password)
            ]);
            
            return $current_user;
           // return redirect()->back()->with('success','Password successfully updated.');
        }/*else{
            return redirect()->back()->with('error','Old password does not matched.');
        }*/
    }
    
    public function approveBook($id2, $id, $approve, $i_date, $r_date)
    {
        $borrow= Borrow::where('book_id', $id2)->where('user_id', $id)->update([
        'approved'=>$approve,
        'issue_date'=>$i_date,
        'return_date'=>$r_date ]);
        return $borrow;
    }
    public function convert_customer_data_to_html($id2, $id)
    {
              $borrow=Borrow::join('books', 'borrow.book_id', '=', 'books.id')
                   ->join('users', 'borrow.user_id', '=', 'users.id')
                 
              ->where('borrow.approved', '=', "approved")
              ->where('borrow.user_id', '=', $id)
              ->where('borrow.book_id', '=', $id2)
              //->select('borrow.*','borrow.user_id','borrow.book_id')
              ->get();
              return $borrow;
    }
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
   /* protected $casts = [
        'email_verified_at' => 'datetime',
    ];*/
}
