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


        $iTopicId = $request->id;
        $aTopic = $this->oTopic->getQuickTopic($iTopicId);
        $aRelatedTopic = $this->oTopic->getRelatedTopics($aTopic['topic_id'], $aTopic['category_id']);
        $aCoordinateConvert = !empty($aTopic['address']) ? $this->oHelper->parseAddressToCoordinate($aTopic['address']) : array();
        if(!empty($aCoordinateConvert))
        {
            $aFrontend['Coordinate'] = $aCoordinateConvert;
        }
        if(!empty($aTopic))
        {
            $aFrontend['aTopic'] = $aTopic;
        }
        if(!empty($aRelatedTopic))
        {
            $aFrontend['aRelatedTopics'] = $aRelatedTopic;
        }
        return view('Detail',['bLogin' => $bLogin,'iUserGroup' => $iUserGroup,'aFrontend' => $aFrontend]);
    }
}