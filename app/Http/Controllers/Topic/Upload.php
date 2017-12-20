<?php
namespace App\Http\Controllers\Topic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Topic\TopicModel;
use App\Topic\CategoryModel;
use App\Http\Controllers\User\LoginController;
class UploadController extends Controller
{
    private $oCategoryModel;
    private $oTopicModel;
    public function __construct()
    {
        $this->oCategoryModel= new CategoryModel();
        $this->oTopicModel = new TopicModel();
    }

    public function process(Request $request )
    {
        $oUser=new LoginController();
        list($bLogin,$iUserGroup)=$oUser->checkAutoLogin(true);
        if(!$bLogin)
        {
            return back();
        }
        $aVals= $request->all();
        $aCurrencies=Helper::getCurrencies();
        $aCategories = $this->oCategoryModel->getList([
            ['is_root','<>',1]
        ]);
        $aFrontend=array();
        if(!empty($aVals))
        {
            $iId=$this->oTopicModel->_add($aVals);
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
        if(!empty($aCategories))
        {
            $aFrontend['aCategories'] = $aCategories;
        }

        return view('upload',['aFrontend' => $aFrontend, 'bLogin' => $bLogin,'iUserGroup' => $iUserGroup]);
    }
}