<?php
namespace App\Topic;

use Illuminate\Support\Facades\DB;
use App\Helper\Helper;
class CategoryModel
{
    private $oHelper;
    public function __construct()
    {
        $this->oHelper = new Helper();
    }
    public function getList($aCond = array())
    {
        $oDB=DB::table('topic_category')->select('*');
        if(!empty($aCond))
        {
            $oDB->where($aCond);
        }
        $aRows = $oDB->get();
        return $this->oHelper->convertDataFromObjectToArray($aRows);
    }
    public function getTopTopicsForCategory($iCategoryId)
    {
        /*$aRows = DB::table('topic')->join('topic_category_data','topic.topic_id','=','topic_category_data.topic_id')
                                   ->join('topic_category','topic_category.category_id','=','topic_category_data.category_id')
                                   ->join('user','user.user_id','=','topic.user_id')
                                   ->join('currency','currency.currency_id','=','topic.currency')
                                   ->select('topic.*','user.full_name','currency.title AS currency_title','user.group_id AS user_group')
                                   ->where([
                                       ['topic_category.is_root','<>',1],
                                       ['topic.status','=',2],
                                       ['topic_category.category_id','=',$iCategoryId]
                                   ])
                                   ->orderBy('topic.time_stamp', 'desc')
                                   ->limit(10)
                                   ->get();*/
        $aTotal = DB::table('topic')->join('topic_category_data','topic.topic_id','=','topic_category_data.topic_id')
            ->join('topic_category','topic_category.category_id','=','topic_category_data.category_id')
            ->join('user','user.user_id','=','topic.user_id')
            ->join('currency','currency.currency_id','=','topic.currency')
            ->select('topic.*','user.full_name','currency.title AS currency_title','user.group_id AS user_group')
            ->where([
                ['topic_category.is_root','<>',1],
                ['topic.status','=',2],
                ['topic_category.category_id','=',$iCategoryId]
            ])
            ->orderBy('topic.time_stamp', 'desc')
            ->limit(10)
            ->get();
        $aTotal = $this->oHelper->convertDataFromObjectToArray($aTotal,true);
        if(!empty($aTotal))
        {
            $aTotalConvert = [];
            foreach ($aTotal as $iKey => $aValue)
            {
                $aValue['attachment_path'] = '';
                $aValue['stt'] = (int)$iKey;
                $aTotalConvert[$aValue['topic_id']] = $aValue;
            }
            $aRows = DB::table('topic')->join('topic_category_data','topic.topic_id','=','topic_category_data.topic_id')
                ->join('topic_category','topic_category.category_id','=','topic_category_data.category_id')
                ->join('user','user.user_id','=','topic.user_id')
                ->join('currency','currency.currency_id','=','topic.currency')
                ->join('attachment','topic.topic_id','=','attachment.topic_id')
                ->select('topic.topic_id','attachment.path AS attachment_path',DB::raw('MIN(attachment.attachment_id) AS attachment_id'))
                ->where([
                    ['topic_category.is_root','<>',1],
                    ['topic.status','=',2],
                    ['topic_category.category_id','=',$iCategoryId],
                    ['attachment.type','<>','mp4']
                ])
                ->groupBy('topic.topic_id')
                ->orderBy('topic.time_stamp', 'desc')
                ->limit(10)
                ->get();
            $aRows = $this->oHelper->convertDataFromObjectToArray($aRows,true);

            foreach($aRows as $iKey => $aRow)
            {
                $aTotalConvert[$aRow['topic_id']]['attachment_path'] = $aRow['attachment_path'];
            }
            return $aTotalConvert;

        }
        return [];



    }
}