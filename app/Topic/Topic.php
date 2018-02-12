<?php
namespace App\Topic;

use App\User\UserModel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Cookie\CookieController;
use App\Http\Controllers\Session\SessionController;
use App\Helper\Helper;
use App\User\UserMode;
class TopicModel
{
    private $oHelper;
    private $oUserModel;
    public function __construct()
    {
        $this->oHelper = new Helper();
        $this->oUserModel = new UserModel();
    }
    public function _add($aVals = array())
    {
        $iUserId=!empty(SessionController::getSession('user_id')) ? SessionController::getSession('user_id') : (!empty(CookieController::getCookie('user_id')) ? CookieController::getCookie('user_id') : 0 );

        if(!empty($iUserId))
        {
            $iUserGroup = (int)$this->oUserModel->getUserGroup($iUserId);
            $iId=DB::table('topic')->insertGetId([
                'title' => $aVals['name'],
                'currency' => (int)$aVals['currency'],
                'price' => (int)$aVals['price'],
                'description' => $aVals['description'],
                'address' => $aVals['address'],
                'phone' => $aVals['phone'],
                'user_id' => $iUserId,
                'status' => ($iUserGroup <> 1 && $iUserGroup <> 2) ? 1 : 2,
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
        DB::table('attachment')->where('topic_id',$iTopicId)->delete();
        DB::table('topic_category_data')->where('topic_id',$iTopicId)->delete();
        DB::table('topic')->where('topic_id',$iTopicId)->delete();
        return true;
    }
    public function getQuickTopic($iTopic)
    {
        $aRow = DB::table('topic')->join('user','user.user_id','=','topic.user_id')
            ->join('currency','currency.currency_id','=','topic.currency')
            ->join('topic_category_data','topic.topic_id','=','topic_category_data.topic_id')
            ->join('topic_category','topic_category_data.category_id','=','topic_category.category_id')
            ->select('topic.*','user.full_name','user.group_id AS user_group','user.user_id','currency.title AS currency_title','topic_category.category_id','topic_category.title AS category_title')
            ->where([
                ['topic.topic_id','=',$iTopic],
            ])->get();
        $aTopicConver = $this->oHelper->convertDataFromObjectToArray($aRow,true,true);
        /*$aTopicConver['attachment'] = $this->getAttachmentFiles($iTopic);*/
        return $aTopicConver;
    }

    public function getRelatedTopics($iTopicId, $iCategoryId)
    {
        $aRows = DB::table('topic')->join('user','user.user_id','=','topic.user_id')
            ->join('currency','currency.currency_id','=','topic.currency')
            ->join('topic_category_data','topic.topic_id','=','topic_category_data.topic_id')
            ->join('topic_category','topic_category_data.category_id','=','topic_category.category_id')
            ->select('topic.*','user.full_name','user.user_id','user.group_id AS user_group','currency.title AS currency_title','topic_category.category_id','topic_category.title AS category_title')
            ->where([
                ['topic.topic_id','<>',$iTopicId],
                ['topic_category.category_id','=',$iCategoryId],
                ['topic.status', '=' , 2]
            ])
            ->orderBy('topic.time_stamp', 'desc')
            ->limit(5)->get();
        $aConvert = $this->oHelper->convertDataFromObjectToArray($aRows,true);
        return $aConvert;
    }
    public function _update($iTopicId, $aUpdate)
    {
        if(!empty($iTopicId))
        {
            DB::table('topic')
                    ->where([
                        ['topic_id','=',$iTopicId]
                    ])
                    ->update([
                        'title' => $aUpdate['name'],
                        'currency' => $aUpdate['currency'],
                        'price' => $aUpdate['price'],
                        'description' => $aUpdate['description'],
                        'address' => $aUpdate['address'],
                        'phone' => $aUpdate['phone']
                    ]);
            DB::table('topic_category_data')->where([
                ['topic_id','=',$iTopicId]
            ])->update([
                'category_id' => $aUpdate['category']
            ]);
            return true;
        }
        return false;
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
    public function addAttachFiles($aInsert = array())
    {
        DB::table('attachment')->insert($aInsert);
        return true;

    }
    public function getAttachmentFiles($iTopicId)
    {
        $aRow = DB::table('attachment')->select('*')
                                    ->where('topic_id',$iTopicId)
                                    ->get();
        return $this->oHelper->convertDataFromObjectToArray($aRow);
    }
    public function deleteAttachmentFilesWithId($aIds = [])
    {
        /*DB::delete('DELETE FROM attachment WHERE attachment_id IN (:)',$aIds);*/
        if(!empty($aIds))
        {
            DB::table('attachment')->whereIn('attachment_id',$aIds)->delete();
            return true;
        }
        return false;
    }
    public function getFilesNotIn($iTopicId, $aIds = [])
    {
        if(!empty($aIds))
        {
            $aRows = DB::table('attachment')->select('*')
                ->where('topic_id',$iTopicId)
                ->whereNotIn('attachment_id', $aIds)
                ->get();
            return $this->oHelper->convertDataFromObjectToArray($aRows);
        }
        return [];

    }
    public function getListTopicHasAvatar($aIds = [])
    {
        $aRows = DB::table('topic')->join('topic_category_data','topic.topic_id','=','topic_category_data.topic_id')
            ->join('topic_category','topic_category.category_id','=','topic_category_data.category_id')
            ->join('user','user.user_id','=','topic.user_id')
            ->join('currency','currency.currency_id','=','topic.currency')
            ->join('attachment','topic.topic_id','=','attachment.topic_id')
            ->select('topic.topic_id','attachment.path AS attachment_path',DB::raw('MIN(attachment.attachment_id) AS attachment_id'))
            ->where([
                ['topic_category.is_root','<>',1],
                ['attachment.type','<>','mp4']
            ])
            ->whereIn('topic.topic_id', $aIds)
            ->groupBy('topic.topic_id')
            ->orderBy('topic.time_stamp', 'desc')
            ->get();
        return $this->oHelper->convertDataFromObjectToArray($aRows);
    }
    public function search($aVals = [])
    {
        $sSearch = '';
        if(!empty($aVals['search']))
        {
            $sTitle = '( ';
            $sDescription = '( ';
            $charSet = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $aVals['search']);
            $charSet = rtrim($charSet);
            $aSearch = explode(" ",$charSet);
            foreach($aSearch as $key => $value)
            {
                $sTitle.='MATCH (t.title) AGAINST (\'"'.$value.'" \') AND ';
                $sDescription.='MATCH (t.description) AGAINST (\'"'.$value.'" \') AND ';
            }
            $sTitle = trim($sTitle,'AND ').')';
            $sDescription = trim($sDescription,'AND ').')';
            $sSearch.='AND ( '.$sTitle.' OR '.$sDescription.' )';
        }

       $aRows = DB::select('
              SELECT t.*, tcd.category_id, tc.title AS category_title, u.full_name, u.group_id AS user_group, c.title AS currency_title   
              FROM topic t
              INNER JOIN topic_category_data tcd ON t.topic_id = tcd.topic_id
              INNER JOIN user u ON t.user_id = u.user_id
              INNER JOIN topic_category tc ON tc.category_id = tcd.category_id
              INNER JOIN currency c ON c.currency_id = t.currency
              WHERE (t.status = 2) '.(!empty($sSearch) ? $sSearch : '').(!empty($aVals['cat']) ? 'AND (tcd.category_id = '.$aVals['cat'].' ) ': '').( !empty($aVals['date']) && (int)$aVals['date']['datefrom'] <= (int)$aVals['date']['dateto'] ? 'AND (t.time_stamp BETWEEN '.strtotime($aVals['date']['datefrom'].' 00:00:00').' AND '.strtotime($aVals['date']['dateto'].' 23:59:59').') ' : '')
            .'ORDER BY t.time_stamp DESC LIMIT 10');
       return $this->oHelper->convertDataFromRawObjectToArray($aRows,true);
    }
}

