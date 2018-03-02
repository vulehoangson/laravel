<?php
namespace App\Helper;
use Illuminate\Support\Facades\DB;
class Helper
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


    public function convertDataFromRawObjectToArray($oData,$bConverTimestamp=false,$bObject = false)
    {
        $aConvert=array();

        if(!empty($oData))
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
    public function parseFormattedNumberToInt($sNumber)
    {
        $oNumberFormatter = new \NumberFormatter("en_EN", NumberFormatter::DECIMAL);
        return $oNumberFormatter->parse($sNumber, NumberFormatter::TYPE_INT32);
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
        $sRegisterKey = '7fd671e2-1d6c-4183-8ca7-457c249043c4';

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
            return ( !empty($oOutput['List'][0]['Latitude']) && !empty($oOutput['List'][0]['Longitude']) ? [$oOutput['List'][0]['Latitude'],$oOutput['List'][0]['Longitude']] : [0,0]);
        }
        return [];
    }
    public function deleteFiles($aFiles = [])
    {
        if(!empty($aFiles))
        {
            foreach($aFiles as $aFile)
            {
                $sPublicPath = public_path().'/'.$aFile['path'];
                if(file_exists($sPublicPath))
                {
                    unlink($sPublicPath);
                }

            }
        }
    }

}