<?php

namespace App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginModel extends Model
{
    private $username;
    private $password;

    public function __construct($username='',$password='')
    {
        $this->username=$username;
        $this->password=$password;
    }
    public function Login()
    {
        $aData=DB::table('user')->select('*')->where([
            ['username','=',$this->username]
        ])->get();
        if(!$aData->isEmpty())
        {
            $aResult=array();
            foreach($aData as  $Object)
            {
                foreach($Object as $iKey => $value)
                {
                    $aResult[$iKey]=$value;
                }
            }

            if(Hash::check($this->password,$aResult['password']))
            {
                return array($aResult['user_id'],$aResult['password']);
            }

        }
        return false ;
    }


}