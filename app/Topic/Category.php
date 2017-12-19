<?php
namespace App\Topic;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoryModel extends Model
{
    public function getList()
    {
        $aRows = DB::table('topic_category')->select('*')->get();
        $aResult = array();
        if(!$aRows->isEmpty())
        {
            foreach ($aRows as $iKey => $aRow)
            {
                foreach ($aRow as $sIndex => $value)
                {
                    $aResult[$iKey][$sIndex] = $value;
                }
            }

        }
        return $aResult;
    }
}