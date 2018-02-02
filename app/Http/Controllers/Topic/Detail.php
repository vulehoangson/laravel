<?php
namespace App\Http\Controllers\Topic;

use App\Http\Controllers\Controller;
use App\Helper\Helper;
use App\Http\Controllers\User\LoginController;
use Illuminate\Http\Request;
use App\Topic\TopicModel;
class DetailController extends Controller
{
    private $oHelper;
    private $oTopic;
    public function __construct()
    {
        $this->oHelper = new Helper();
        $this->oTopic = new TopicModel();
    }

    public function process(Request $request)
    {
        $oUser=new LoginController();
        $aFrontend=array();
        list($bLogin,$iUserGroup)=$oUser->checkAutoLogin(true);
        $iCurrentUserId = $oUser->getCurrentUserId();

        $iTopicId = $request->id;
        $aTopic = $this->oTopic->getQuickTopic($iTopicId);
        $aRelatedTopic = $this->oTopic->getRelatedTopics($aTopic['topic_id'], $aTopic['category_id']);

        $aCoordinateConvert = !empty($aTopic['address']) ? $this->oHelper->parseAddressToCoordinate($aTopic['address']) : [];
        if(!empty($aCoordinateConvert))
        {
            $aFrontend['Coordinate'] = $aCoordinateConvert;
        }
        if(!empty($aTopic))
        {
            $aTopic['attachment'] = $this->oTopic->getAttachmentFiles($iTopicId);
            $aFrontend['aTopic'] = $aTopic;
        }
        if(!empty($aRelatedTopic))
        {
            $aIds =[];
            $aRelatedTopicConvert = [];
            foreach($aRelatedTopic as $iKey => $aValue)
            {
                $aValue['attachment_path'] = '';
                $aValue['stt'] = (int)$iKey;
                $aRelatedTopicConvert[$aValue['topic_id']] = $aValue;
                $aIds[] = $aValue['topic_id'];
            }
            $aTemps = $this->oTopic->getListTopicHasAvatar($aIds);
            foreach($aTemps as $aTemp)
            {
                $aRelatedTopicConvert[$aTemp['topic_id']]['attachment_path'] = $aTemp['attachment_path'];
            }
            $aFrontend['aRelatedTopics'] = $aRelatedTopicConvert;
        }
        return view('Detail',['bLogin' => $bLogin,'iUserGroup' => $iUserGroup,'iCurrentUserId' => (int)$iCurrentUserId,'aFrontend' => $aFrontend]);
    }
}