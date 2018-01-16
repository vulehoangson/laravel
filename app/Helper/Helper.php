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
                        $aConvert[$iKey][$sIndex] = ($sIndex === 'time_stamp' ? date('d-m-Y H:i:s',$value) : ($sIndex === 'price' ? $this->formatNumber($value) : $value));
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
    public function formatNumber($iNumber,$decimals=0,$dec_point=',', $thousands_sep='.') {
        return number_format($iNumber,$decimals,$dec_point,$thousands_sep);
    }

    public function calculateImageSize($iImageWidth, $iImageHeight, $iThumbnailWidth, $iThumbnailHeight)
    {
        $w  = $iThumbnailWidth;
        $h  = $iThumbnailHeight;

        if ($iImageWidth > $iThumbnailWidth)
        {
            $w  = $iThumbnailWidth;
            $h  = floor($iImageHeight * $iThumbnailWidth/$iImageWidth);
            if ($h > $iThumbnailHeight)
            {
                $h  = $iThumbnailHeight;
                $w  = floor($iImageWidth * $iThumbnailHeight/$iImageHeight);
            }
        }
        elseif ($iImageHeight > $iThumbnailHeight)
        {
            $h  = $iThumbnailHeight;
            $w  = floor($iImageWidth * $iThumbnailHeight/$iImageHeight);
        }

        return array($w, $h);
    }

}