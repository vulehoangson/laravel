<?php
namespace App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class SignupModel extends Model
{
    private $username;
    private $password;

    public function __construct($aValue=array())
    {
        $this->username=$aValue['username'];
        $this->password=$aValue['password'];
    }

    public function Signup()
    {
        $data=DB::table('user')->select('*')
                               ->where([
                                   ['username','=',$this->username]
                               ])->get();
        if($data->isEmpty())
        {
            $password_hash=Hash::make($this->password);
            $iId=DB::table('user')->insertGetId([
                'username' => $this->username,
                'password' => $password_hash,
                'group_id' => 3
            ]);
            return $iId;
        }
        return false;
    }

}