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
use App;
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
    public function changeLanguage(Request $request)
    {
        $sLanguage = $request->language;
        CookieController::setCookie('language',$sLanguage);
    }

    public function loadMore(Request $request)
    {
        $iPage = $request->paging;
        $aParams = json_decode($request->params,true);
        $oTopicModel = new TopicModel();
        $aRows = $oTopicModel->search($aParams, $iPage);
        $aResult = array(
            'status' => false
        );
        if(!empty($aRows))
        {
            $aResult['status'] = true;
            $aResult['data'] = '';
            $aIds = [];
            $aResultConvert = [];
            foreach ($aRows as $key => $value)
            {
                $aIds[] = $value['topic_id'];
                $value['stt'] = $key;
                $value['attachment_path'] = '';
                $aResultConvert[$value['topic_id']] = $value;
            }
            $aTempList = $oTopicModel->getListTopicHasAvatar($aIds);
            foreach($aTempList as $aTemp)
            {
                $aResultConvert[$aTemp['topic_id']]['attachment_path'] = $aTemp['attachment_path'];
            }


            foreach($aResultConvert as $aTopic)
            {
                $aResult['data'] .= '<div class="col-md-12 col-sm-12 item" style="padding: 20px 0;cursor: pointer;" data-id="'.$aTopic['topic_id'].'">
                            <div class="col-md-2 col-sm-2 image">
                                <img src="'.(!empty($aTopic['attachment_path']) ?  asset($aTopic['attachment_path']) : asset('images/default_product.jpg') ).'" style="border: 1px solid #dddddd; height: 110px; width: 110px">
                            </div>
                            <div class="content col-md-7 col-sm-7">
                                <div style="font-size: 18px;margin-bottom: 15px;color: #196c4b"><a href="'.url('topic/detail/'.$aTopic['topic_id']).'" style="text-decoration: none;">'.$aTopic['title'].'</a> </div>
                                <div style="font-size: 15px;margin-bottom: 5px"><b>'.$aTopic['price'].'</b> '.$aTopic['currency_title'].'</div>
                                <div style="font-size: 15px;margin-bottom: 5px">'.__('phrases.category').': <b>'.$aTopic['category_title'].'</b></div>
                                <div style="font-size: 15px; margin-bottom: 5px;">'.__('phrases.posted_at').' <b>'.$aTopic['time_stamp'].'</b></div>
                            </div>
                            <div class="user col-md-3 col-sm-3" >
                                '.__('phrases.by').' <a style="text-decoration: none;" href="'.asset('profile/'.$aTopic['user_id']).'"><b>'.$aTopic['full_name'].'</b></a>';


                            if((int)$aTopic['user_group'] === 1)
                            {
                                $aResult['data'] .= '<div style="background-image: url(\''.asset('images/superadmin.png').'\'); background-position: 0 0;height: 12px;width: 17px;display: inline-block;"></div>';
                            }
                            elseif((int)$aTopic['user_group'] === 2)
                            {
                                $aResult['data'] .= '<div style="background-image: url(\''.asset('images/superadmin.png').'\'); background-position: 0 -17px;height: 12px;width: 12px;display: inline-block;"></div>';
                            }

                $aResult['data'] .='</div>                 
                        </div>';
            }

        }
        echo json_encode($aResult);
    }
}