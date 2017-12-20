<?php
namespace App\Topic;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Helper\Helper;
class CategoryModel extends Model
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
                                   ->select('topic.*','user.username','currency.title AS currency_title')
                                   ->where([
                                       ['topic_category.is_root','<>',1],
                                       ['topic.status','=',2],
                                       ['topic_category.category_id','=',$iCategoryId]
                                   ])
                                   ->orderBy('topic.time_stamp', 'desc')
                                   ->limit(10)
                                   ->get();
        return $this->oHelper->convertDataFromObjectToArray($aRows,true);

    }
}