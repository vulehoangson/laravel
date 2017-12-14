<?php
namespace App\Topic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Cookie\CookieController;
use App\Http\Controllers\Session\SessionController;
class TopicModel extends Model
{
    private $_aTopic;

    public function __construct($aTopic=array())
    {
        $this->_aTopic = $aTopic;
    }


    public function _add()
    {
        $iUserId=!empty(SessionController::getSession('user_id')) ? SessionController::getSession('user_id') : (!empty(CookieController::getCookie('user_id')) ? CookieController::getCookie('user_id') : 0 );
        if(!empty($iUserId))
        {
            $iId=DB::table('topic')->insertGetId([
                'title' => $this->_aTopic['name'],
                'currency' => (int)$this->_aTopic['currency'],
                'price' => (int)$this->_aTopic['price'],
                'description' => $this->_aTopic['description'],
                'address' => $this->_aTopic['address'],
                'phone' => $this->_aTopic['phone'],
                'user_id' => $iUserId,
                'status' => 1
            ]);
            return $iId;
        }
        return false;

    }
    public function _delete($iTopicId)
    {
        $bDelete=DB::table('topic')->where('topic_id',$iTopicId)->delete();
        return $bDelete;
    }
    public function getQuickTopic($iTopic)
    {
        
    }

    public function _update($iTopicId)
    {

    }

    public function getApprovedWaitingTopics()
    {
        $aTopics=DB::table('topic')
                    ->where([
                        ['user_id','<>',0],
                        ['status','=',1]
                    ])->get();
        if(!$aTopics->isEmpty())
        {
            return $this->convertDataFromObjectToArray($aTopics);
        }

        return array();
    }
    public function convertDataFromObjectToArray($oData)
    {
        $aConvert=array();

        foreach ($oData as $iKey => $aData)
        {
            foreach ($aData as $sIndex => $value)
            {
                $aConvert[$iKey][$sIndex] = $value;
            }
        }
        return $aConvert;
    }

    public function approveTopic($iTopicId)
    {
        if(!empty($iTopicId))
        {
            DB::table('topic')
                ->where('topic_id',$iTopicId)
                ->update([
                    'status' => 2
                ]);
            return true;
        }
        return false;
    }

    public function removeTopic($iTopicId)
    {
        if(!empty($iTopicId))
        {
            DB::table('topic')
                ->where('topic_id',$iTopicId)
                ->update([
                    'status' => 3
                ]);
            return true;
        }
        return false;
    }
}

