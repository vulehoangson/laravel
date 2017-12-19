<?php
namespace App\Http\Controllers\AdminCP;

use App\Http\Controllers\Controller;
use App\Topic\CategoryModel;
use App\Topic\TopicModel;
use App\Http\Controllers\User\LoginController;
use App\User\UserModel;
class IndexController extends Controller
{
    private $oTopicModel;
    private $oCategoryModel;
    public function __construct()
    {
        $this->oTopicModel=new TopicModel();
        $this->oCategoryModel = new CategoryModel();
    }

    public function process()
    {
        $oUser=new LoginController();
        list($bLogin,$iUserGroup)=$oUser->checkAutoLogin(true);
        if( ((int)$iUserGroup != 1 &&  (int)$iUserGroup != 2))
        {
            if(url()->current() != url()->previous())
            {
                return back();
            }
            else
            {
                return redirect(url(''));
            }
        }
        $aApprovedWatingTopics=$this->oTopicModel->getApprovedWaitingTopics();
        $aCategories = $this->oCategoryModel->getList();
        $aFrontend=array(
            'aTopics' => $aApprovedWatingTopics,
            'aCategories' => $aCategories
        );


        return view('admincp.index',['aFrontend' => $aFrontend,'bLogin' => $bLogin, 'iUserGroup' => $iUserGroup]);
    }
}