<?php
namespace App\Http\Controllers\Ajax;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Cookie\CookieController;
use App\User\LoginModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Session\SessionController;
use App\Topic\TopicModel;
use App\Http\Controllers\Topic\SearchController;
class AjaxController extends Controller
{
    public function __construct()
    {

    }

    public function Logout()
    {
      
    }
    public function Signup()
    {
        echo ( !isset($_COOKIE['login']) ? url('signup') : '');
    }

    public function Login()
    {
        $a=1;
        echo ( !isset($_COOKIE['login']) ? url('login') : '');
    }

    public function approveTopic(Request $request)
    {
        $iId= (int)$request->id;
        $oTopicModel = new TopicModel();
        $bApprove = $oTopicModel->approveTopic($iId);
        $sHtml = '';
        if($bApprove)
        {
            $aRestList = $oTopicModel->getApprovedWaitingTopics();
            foreach($aRestList as $iKey => $value)
            {
                $sHtml.='<div class="col-md-12 item" style="padding: 0px 0 20px 5px !important;  border: 1px solid #e5e5e5;margin-right: 20px;margin-bottom: 20px;">
                        <div class="title" style="height: auto; color: #808080; margin-bottom: 10px; padding: 0 10px;">
                            <a href=""><h2>'.$value['title'].'</h2></a>
                        </div>
                        <div class="description" style="padding: 0 10px;margin-bottom: 15px;">
                            <h4>'.$value['description'].'</h4>
                        </div>
                        <div class="approve-remove" style="padding: 0 10px;">
                            <button class="btn btn-success approve" style="margin-right: 20px;" data-id="'.$value['topic_id'].'">Chấp nhận</button>
                            <button class="btn btn-danger remove" data-id="'.$value['topic_id'].'">Xóa</button>
                        </div>
                    </div>';
            }
        }

        echo json_encode(array('status' => $bApprove, 'sHtml' => $sHtml));
    }

    public function removeTopic(Request $request)
    {
        $iId= (int)$request->id;
        $oTopicModel = new TopicModel();
        $bRemove = $oTopicModel->removeTopic($iId);
        $sHtml = '';

        if($bRemove)
        {
            $aRestList = $oTopicModel->getApprovedWaitingTopics();
            $sHtml = '';
            foreach($aRestList as $iKey => $value)
            {
                $sHtml.='<div class="col-md-6 item" style="padding: 0px 0 20px 5px !important;  border: 1px solid #e5e5e5; width: 45%;margin-right: 20px;margin-bottom: 20px;">
                        <div class="title" style="height: auto; color: #808080; margin-bottom: 10px; padding: 0 10px;">
                            <a href=""><h2>'.$value['title'].'</h2></a>
                        </div>
                        <div class="description" style="padding: 0 10px;margin-bottom: 15px;">
                            <h4>'.$value['description'].'</h4>
                        </div>
                        <div class="approve-remove" style="padding: 0 10px;">
                            <button class="btn btn-success approve" style="margin-right: 20px;" data-id="'.$value['topic_id'].'">Chấp nhận</button>
                            <button class="btn btn-danger remove" data-id="'.$value['topic_id'].'">Xóa</button>
                        </div>
                    </div>';
            }
        }

        echo json_encode(array('status' => $bRemove, 'sHtml' => $sHtml));
    }
    public function searchSuggestion(Request $request)
    {
        $sKey = $request->all();
        $oSearch = new SearchController();
        $aResult = $oSearch->suggestion($sKey);
        echo json_encode($aResult);

    }
}