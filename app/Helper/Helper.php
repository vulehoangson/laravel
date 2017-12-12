<?php
namespace App\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Helper extends Model
{
    public static function getCurrencies()
    {
        $aCurrrencies=DB::table('currency')->select('*')->get();
        $aConvert=array();
        if(!$aCurrrencies->isEmpty())
        {
            foreach ($aCurrrencies as $iKey => $aCurrrency)
            {
                foreach($aCurrrency as $sIndex => $value)
                {
                    $aConvert[$iKey][$sIndex] = $value;
                }

            }
            return $aConvert;
        }
        return array();
    }
}