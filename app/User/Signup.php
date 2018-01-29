<?php
namespace App\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class SignupModel
{
    private $username;
    private $password;
    private $full_name;
    private $address;
    private $phone;
    private $avatar;
    public function __construct($aValue=array())
    {
        $this->username=$aValue['username'];
        $this->password=$aValue['password'];
        $this->full_name=$aValue['full_name'];
        $this->address=$aValue['address'];
        $this->phone=$aValue['phone'];
        $this->avatar=$aValue['avatar'];
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
                'group_id' => 3,
                'full_name' => $this->full_name,
                'address' => $this->address,
                'phone' => $this->phone,
                'avatar' => $this->avatar
            ]);
            return $iId;
        }
        return false;
    }

}