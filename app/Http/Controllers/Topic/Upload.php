<?php
namespace App\Http\Controllers\Topic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Topic\TopicModel;
use App\Http\Controllers\User\LoginController;
class UploadController extends Controller
{
    public function process(Request $request )
    {
        $oUser=new LoginController();
        $bLogin=$oUser->checkAutoLogin();
        if(!$bLogin)
        {
            return back();
        }
        $aVals= $request->all();
        $aCurrencies=Helper::getCurrencies();
        $aFrontend=array();
        if(!empty($aVals))
        {
            $oTopicModel=new TopicModel($aVals);
            $iId=$oTopicModel->_add();
            if(!empty($iId))
            {
                $aFrontend['success']='Upload thành công';
            }
            else
            {
                $aFrontend['error']='Upload không thành công. Kiểm tra lại dữ liệu nhập !!!';
            }
        }
        if(!empty($aCurrencies))
        {
            $aFrontend['aCurrencies'] = $aCurrencies;
        }
        $oUser=new LoginController();
        $bLogin=$oUser->checkAutoLogin();
        return view('upload',['aFrontend' => $aFrontend, 'bLogin' => $bLogin]);
    }
}