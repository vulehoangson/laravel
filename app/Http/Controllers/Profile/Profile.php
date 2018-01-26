<?php
namespace App\Http\Controllers\Profile;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\LoginController;
use Illuminate\Http\Request;
use App\User\UserModel;
class ProfileController extends Controller
{
    private $oUserModel;
    public function __construct()
    {
        $this->oUserModel = new UserModel();
    }

    public function process(Request $request)
    {
        $oUser=new LoginController();
        list($bLogin,$iUserGroup)=$oUser->checkAutoLogin(true);
        $iId = $request->id;
        $aFrontend = [];
        $aUser = $this->oUserModel->getUserInfo($iId);
        if(!empty($aUser))
        {
            $aFrontend['aUser'] = $aUser;
        }
        return view('profile',[
            'bLogin' => $bLogin,
            'iUserGroup' => $iUserGroup,
            'aFrontend' => $aFrontend
        ]);
    }
}