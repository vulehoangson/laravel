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
    public function convertDataFromObjectToArray($oData,$bConverTimestamp=false,$bObject = false)
    {
        $aConvert=array();

        if(!$oData->isEmpty())
        {
            if($bObject)
            {
                if($bConverTimestamp)
                {
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    foreach ($oData as $iKey => $aData)
                    {

                        foreach ($aData as $sIndex => $value)
                        {
                            $aConvert[$sIndex] = ($sIndex === 'time_stamp' ? date('d-m-Y H:i:s',$value) : ($sIndex === 'price' ? $this->formatNumber($value) : $value));
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
            else
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
    public function parseAddressToCoordinate($sAddress)
    {

        $sUrl = 'http://developers.vietbando.com/V2/Service/PartnerPortalService.svc/rest/SearchAll';
        $sRegisterKey = '6f8a969e-76cc-4956-934f-370d6d5456f5';

        $aVals=array(
            "IsOrder" => true,
            "Keyword" => $sAddress,
            "Page" => 1,
            "PageSize" => 10,
        );
        $aHeader = array('Content-Type:application/json','RegisterKey:'.$sRegisterKey);
        $ch = curl_init(); //depend extension
        curl_setopt($ch, CURLOPT_URL, $sUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($aVals));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        $oOutput = json_decode($server_output,true);
        if($oOutput['IsSuccess'])
        {
            return array($oOutput['List'][0]['Latitude'],$oOutput['List'][0]['Longitude']);
        }
        return array();
    }

}