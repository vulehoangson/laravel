<?php
namespace App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SignupModel extends Model
{
    private $username;
    private $password;

    public function __construct($username='',$password='')
    {
        $this->username=$username;
        $this->password=$password;
    }

    public function Signup()
    {
        $data=DB::table('user')->select('*')
                               ->where([
                                   ['username','=',$this->username],
                                   ['password','=',$this->password]
                               ])->get();
        if(empty($data['items']))
        {
            $iId=DB::table('user')->insertGetId([
                'username' => $this->username,
                'password' => $this->password
            ]);
            return $iId;
        }
        return false;
    }
}