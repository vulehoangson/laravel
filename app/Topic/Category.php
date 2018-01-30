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
        $aRows = DB::table('topic')->join('topic_category_data','topic.topic_id','=','topic_category_data.topic_id')
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
        /*$aRows = DB::table('topic')->join('topic_category_data','topic.topic_id','=','topic_category_data.topic_id')
            ->join('topic_category','topic_category.category_id','=','topic_category_data.category_id')
            ->join('user','user.user_id','=','topic.user_id')
            ->join('currency','currency.currency_id','=','topic.currency')
            ->leftJoin('attachment','attachment.topic_id','=','topic.topic_id')
            ->select('topic.*','user.full_name','currency.title AS currency_title','user.group_id AS user_group',DB::raw('MIN(attachment.attachment_id) AS attachment_id'),'attachment.path AS avatar')
            ->where([
                ['topic_category.is_root','<>',1],
                ['topic.status','=',2],
                ['topic_category.category_id','=',$iCategoryId],
                ['attachment.type','<>','mp4']
            ])
            ->groupBy('topic.topic_id')
            ->orderBy('topic.time_stamp', 'desc')
            ->limit(10)
            ->get();*/
        return $this->oHelper->convertDataFromObjectToArray($aRows,true);

    }
}