<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Cookie\CookieController;
use App\User\SignupModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Session\SessionController;
use App\Http\Controllers\User\LoginController;
use App\User\UserModel;
use Intervention\Image\ImageManagerStatic as Image;
use App\Helper\Helper;
class SignupController extends Controller
{
    private $CookiesId='user_id';
    private $oUserModel;
    private $oHelper;
    public function __construct()
    {
        $this->oUserModel = new UserModel();
        $this->oHelper = new Helper();
    }
    public function openFormSignup()
    {
        $oLogin=new LoginController();
        return ( $oLogin->checkAutoLogin() ? redirect(url('')) : view('Signup') );
    }
    public function validateSignup(Request $request)
    {
        $aVals = $request['val'];
        $aError = [];
        if(!empty($aVals['username']) && !empty($aVals['password']))
        {
            $aInsert=array(
                'username' => $aVals['username'],
                'password' => $aVals['password'],
                'full_name' => $aVals['full_name'],
                'address' => $aVals['address'],
                'phone' => $aVals['phone'],
                'avatar' => ''
            );
            $iLimitSize = 1024*1024*5;
            $avatar = !empty($request->file) ? $request->file : null ;
            $coverphoto = !empty($request->coverphoto) ? $request->coverphoto : null;
            $iAvatarSize = !empty($avatar) ? (int)$avatar->getClientSize() : 0;
            $iCoverSize = !empty($coverphoto) ? (int)$coverphoto->getClientSize() : 0;
            if($iAvatarSize > $iLimitSize)
            {
                $aError[]['content']=(string)'File Avatar '.pathinfo($avatar->getClientOriginalName(), PATHINFO_FILENAME).' vượt quá 5 MB nên đã bị bỏ qua';
            }
            if($iCoverSize > $iLimitSize)
            {
                $aError[]['content']=(string)'File Cover '.pathinfo($avatar->getClientOriginalName(), PATHINFO_FILENAME).' vượt quá 5 MB nên đã bị bỏ qua';
            }

            if(!empty($aError))
            {
                return view('Signup',['aError' => $aError]);
            }

            $oModel=new SignupModel($aInsert);
            $iId = $oModel->Signup();
            if($iId)
            {



                if(!empty($avatar))
                {
                    $iSize = $avatar->getClientSize();
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $sBaseName = $avatar->getClientOriginalName();
                    $sName = pathinfo($sBaseName,  PATHINFO_FILENAME);
                    $sExtension = pathinfo($sBaseName,  PATHINFO_EXTENSION);
                    $sFileName = '';
                    $sPath = '';

                    $aImageSize = getimagesize($avatar);
                    $iImageWidth = !empty($aImageSize[0]) ? $aImageSize[0] : 0;
                    $iImageHeight = !empty($aImageSize[1]) ? $aImageSize[1] : 0;
                    if($iImageHeight >= 200)
                    {
                        $iTrueWidth = 0;
                        $iTrueHeight = 0 ;
                        list($iTrueWidth, $iTrueHeight) = $this->oHelper->calculateImageSize($iImageWidth, $iImageHeight, 200, 200);

                        /*------Using Image library of Laravel to resize image---------------*/
                        $oImageResize = Image::make($avatar->getRealPath());
                        $oImageResize->resize($iTrueWidth, $iTrueHeight);
                        $sFileName  = md5($sName.date('m/d/Y H:i:s').$sExtension.$sBaseName.uniqid());
                        $oImageResize->save(public_path('/avatars/'.$sFileName.'.'.$sExtension) );
                        $sPath = 'avatars/'.$sFileName.'.'.$sExtension;

                    }
                    else
                    {
                        /*--------Save files in storage/app/public/files using function store---------*/
                        //$sPath = $avatar->store('public/files');

                        /*--------Save files in public/files using function move-----------*/
                        $sFileName = md5($sName.date('m/d/Y H:i:s').$sExtension.$sBaseName.uniqid());
                        $sPath = $avatar->move('avatars/',$sFileName.'.'.$sExtension);
                    }

                    $aUserUpdate = [
                        'avatar' => $sPath
                    ];
                    $this->oUserModel->updateUser($iId, $aUserUpdate);
                }

                if(!empty($coverphoto))
                {
                    $iSize = $coverphoto->getClientSize();
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $sBaseName = $coverphoto->getClientOriginalName();
                    $sName = pathinfo($sBaseName,  PATHINFO_FILENAME);
                    $sExtension = pathinfo($sBaseName,  PATHINFO_EXTENSION);
                    $sFileName = '';
                    $sPath = '';

                    $aImageSize = getimagesize($coverphoto);
                    $iImageWidth = !empty($aImageSize[0]) ? $aImageSize[0] : 0;
                    $iImageHeight = !empty($aImageSize[1]) ? $aImageSize[1] : 0;
                    if($iImageHeight >= 480)
                    {
                        $iTrueWidth = 0;
                        $iTrueHeight = 0 ;
                        list($iTrueWidth, $iTrueHeight) = $this->oHelper->calculateImageSize($iImageWidth, $iImageHeight, 640, 480);

                        /*------Using Image library of Laravel to resize image---------------*/
                        $oImageResize = Image::make($coverphoto->getRealPath());
                        $oImageResize->resize($iTrueWidth, $iTrueHeight);
                        $sFileName  = md5($sName.date('m/d/Y H:i:s').$sExtension.$sBaseName.uniqid());
                        $oImageResize->save(public_path('/covers/'.$sFileName.'.'.$sExtension) );
                        $sPath = 'covers/'.$sFileName.'.'.$sExtension;

                    }
                    else
                    {
                        /*--------Save files in storage/app/public/files using function store---------*/
                        //$sPath = $coverphoto->store('public/files');

                        /*--------Save files in public/files using function move-----------*/
                        $sFileName = md5($sName.date('m/d/Y H:i:s').$sExtension.$sBaseName.uniqid());
                        $sPath = $coverphoto->move('covers/',$sFileName.'.'.$sExtension);
                    }

                    $aUserUpdate = [
                        'cover_photo' => $sPath
                    ];
                    $this->oUserModel->updateUser($iId, $aUserUpdate);
                }
                SessionController::createSession($this->CookiesId,$iId);
                return redirect(url(''));
            }
            else
            {
                $aError[]['content'] = 'Sign Up Failed. Username existed !!!';
                return view('Signup',['aError' => $aError]);
            }

        }
        else
        {
            $aError[]['content'] = 'Username and Password can not be empty !!!';
            return view('Signup',['aError' => $aError]);
        }

    }
}