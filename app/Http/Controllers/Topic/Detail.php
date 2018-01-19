<?php
namespace App\Http\Controllers\Topic;

use App\Http\Controllers\Controller;
use App\Helper\Helper;
use App\Http\Controllers\User\LoginController;
class DetailController extends Controller
{
    private $oHelper;
    public function __construct()
    {
        $this->oHelper = new Helper();
    }

    public function process()
    {
        $oUser=new LoginController();
        $aFrontend=array();
        list($bLogin,$iUserGroup)=$oUser->checkAutoLogin(true);
        $aResult = $this->oHelper->parseAddressToCoordinate('Trường đại học Khoa học tự nhiên Thành phố Hồ Chí Minh');
        if(!empty($aResult))
        {
            $aFrontend['Coordinate'] = $aResult;
        }
        return view('Detail',['bLogin' => $bLogin,'iUserGroup' => $iUserGroup,'aFrontend' => $aFrontend]);
    }
}