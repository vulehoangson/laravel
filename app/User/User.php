<?php

namespace App\User;

use Illuminate\Support\Facades\DB;

class UserModel
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

    public function getUserGroup($iUserId)
    {
        return DB::table('user')->where('user_id',$iUserId)->value('group_id');
    }
    public function updateUser($iUserId, $aUpdate = [])
    {
        return ( !empty($aUpdate) ? DB::table('user')->where('user_id',$iUserId)->update($aUpdate) : false );
    }
}