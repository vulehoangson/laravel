<?php

namespace App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{
    public function getUserInfo($user_id)
    {
        $aUser=DB::table('user')->select('*')
                        ->where([
                            ['user_id','=',$user_id]
                        ])->get();
        if(!$aUser->isEmpty())
        {
            $aResult=[];
            foreach($aUser as $object)
            {
                foreach($object as $key => $value)
                {
                    $aResult[$key]=$value;
                }

            }
            return $aResult;
        }
        return false;
    }
}