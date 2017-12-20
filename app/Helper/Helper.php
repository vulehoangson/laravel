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
    public function convertDataFromObjectToArray($oData,$bConverTimestamp=false)
    {
        $aConvert=array();

        if(!$oData->isEmpty())
        {
            if($bConverTimestamp)
            {
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                foreach ($oData as $iKey => $aData)
                {

                    foreach ($aData as $sIndex => $value)
                    {
                        if($sIndex === 'time_stamp')
                        {
                            $aConvert[$iKey][$sIndex] = date('d-m-Y H:i:s',$value);
                        }
                        else
                        {
                            $aConvert[$iKey][$sIndex] = $value;
                        }

                    }
                }
            }
            else
            {
                foreach ($oData as $iKey => $aData)
                {

                    foreach ($aData as $sIndex => $value)
                    {
                        $aConvert[$iKey][$sIndex] = $value;
                    }
                }
            }

        }

        return $aConvert;
    }

}