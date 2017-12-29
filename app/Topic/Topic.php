<?php
namespace App\Topic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Cookie\CookieController;
use App\Http\Controllers\Session\SessionController;
use App\Helper\Helper;
class TopicModel extends Model
{
    private $oHelper;
    public function __construct()
    {
        $this->oHelper = new Helper();
    }
    public function _add($aVals = array())
    {
        $iUserId=!empty(SessionController::getSession('user_id')) ? SessionController::getSession('user_id') : (!empty(CookieController::getCookie('user_id')) ? CookieController::getCookie('user_id') : 0 );
        if(!empty($iUserId))
        {
            $iId=DB::table('topic')->insertGetId([
                'title' => $aVals['name'],
                'currency' => (int)$aVals['currency'],
                'price' => (int)$aVals['price'],
                'description' => $aVals['description'],
                'address' => $aVals['address'],
                'phone' => $aVals['phone'],
                'user_id' => $iUserId,
                'status' => 1,
                'time_stamp' => strtotime(date('d-m-Y H:i:s'))
            ]);

            DB::table('topic_category_data')->insert([
                'category_id' => $aVals['category'],
                'topic_id' => $iId
            ]);

            DB::table('topic_category')->Where([
                    ['category_id','=',$aVals['category']],
                ])
                ->orWhere([
                    ['is_root','=',1]
                ])->increment('used');
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
        return $this->oHelper->convertDataFromObjectToArray($aTopics);

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

