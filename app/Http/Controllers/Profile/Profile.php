<?php
namespace App\Http\Controllers\Profile;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\LoginController;
use Illuminate\Http\Request;
use App\User\UserModel;
use App\Helper\Helper;
class ProfileController extends Controller
{
    private $oUserModel;
    private $oHelper;
    public function __construct()
    {
        $this->oUserModel = new UserModel();
        $this->oHelper = new Helper();
    }

    public function process(Request $request)
    {
        $oUser=new LoginController();
        list($bLogin,$iUserGroup)=$oUser->checkAutoLogin(true);
        $iId = $request->id;
        $aFrontend = [];
        $aUser = $this->oUserModel->getUserInfo($iId);
        $aCoordinateConvert = !empty($aUser['address']) ? $this->oHelper->parseAddressToCoordinate($aUser['address']) : [];
        if(!empty($aUser))
        {
            $aFrontend['aUser'] = $aUser;
        }
        if(!empty($aCoordinateConvert))
        {
            $aFrontend['aCoordinate'] = $aCoordinateConvert;
        }
        return view('profile',[
            'bLogin' => $bLogin,
            'iUserGroup' => $iUserGroup,
            'aFrontend' => $aFrontend
        ]);
    }
}