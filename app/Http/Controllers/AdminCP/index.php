<?php
namespace App\Http\Controllers\AdminCP;

use App\Http\Controllers\Controller;
use App\Topic\TopicModel;
use App\Http\Controllers\User\LoginController;
use App\User\UserModel;
class IndexController extends Controller
{
    private $oTopicModel;

    public function __construct()
    {
        $this->oTopicModel=new TopicModel();
    }

    public function process()
    {
        $oUser=new LoginController();
        list($bLogin,$iUserGroup)=$oUser->checkAutoLogin(true);
        if( ($iUserGroup != 1 &&  $iUserGroup != 2) )
        {
            return back();
        }

        $aApprovedWatingTopics=$this->oTopicModel->getApprovedWaitingTopics();
        $aFrontend=array(
            'aTopics' => $aApprovedWatingTopics
        );


        return view('admincp.index',['aFrontend' => $aFrontend,'bLogin' => $bLogin, 'iUserGroup' => $iUserGroup]);
    }
}