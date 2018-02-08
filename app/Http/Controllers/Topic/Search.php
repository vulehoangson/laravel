<?php
namespace App\Http\Controllers\Topic;

use App\Http\Controllers\Controller;
use App\Topic\TopicModel;
use Illuminate\Http\Request;
use App\Http\Controllers\User\LoginController;
use App\Solr\Solr;
use App\Topic\CategoryModel;
class SearchController extends Controller
{
    private $solr;
    private $oCategoryModel;
    private $oTopic;
    public function __construct()
    {
        $this->solr = new Solr();
        $this->oCategoryModel = new CategoryModel();
        $this->oTopic = new TopicModel();
    }

    public function process(Request $request)
    {
        $oUser=new LoginController();
        $aFrontend=array();
        list($bLogin,$iUserGroup)=$oUser->checkAutoLogin(true);

        $aVals = $request->all();
        $aVals['date'] = !empty($aVals['datefrom']) && !empty($aVals['dateto']) ? array(
            'datefrom' => $aVals['datefrom'],
            'dateto' => $aVals['dateto']
        ) : array();
        unset($aVals['datefrom']);
        unset($aVals['dateto']);
        $aResult = [];
        /*if($this->solr->ping())
        {
            $aParams = array(
                'query' => $this->solr->createQuery($aVals),
                'field' => '*',
                'sort' => array(
                    'time_stamp' => 'desc',
                ),
                'limit' => 10,
                'pagination' => 0
            );
            $aResult = $this->solr->search($aParams);

        }*/
        
        $aResult = $this->oTopic->search($aVals);
        $aCategories = $this->oCategoryModel->getList([['is_root','<>',1]]);
        if(!empty($aResult))
        {
            $aIds = [];
            $aResultConvert = [];
            foreach ($aResult as $value)
            {
                $aIds[] = $value['topic_id'];
                $aResultConvert[$value['topic_id']] = $value;
            }
            $aTempList = $this->oTopic->getListTopicHasAvatar($aIds);
            foreach($aTempList as $aTemp)
            {
                $aResultConvert[$aTemp['topic_id']]['attachment_path'] = $aTemp['attachment_path'];
            }
            $aFrontend['aTopics'] = $aResultConvert;
        }
        if(!empty($aCategories))
        {
            $aFrontend['aCategories'] = $aCategories;
        }
        return view('Search',['bLogin' => $bLogin,'iUserGroup' => $iUserGroup,'aFrontend' => $aFrontend]);

    }
    public function suggestion($aVals)
    {

        $aResult = array(
            'status' => false,
        );
        $aVals['date'] = array(
            'datefrom' => $aVals['datefrom'],
            'dateto' => $aVals['dateto']
        );
        unset($aVals['datefrom']);
        unset($aVals['dateto']);
        /**
         * create parameters for query solr
         */
        /*$aParams = array(
            'query' => $this->solr->createQuery($aVals),
            'field' => '*',
            'sort' => array(
                'time_stamp' => 'desc',
            ),
            'limit' => 10,
            'pagination' => 0
        );

        $aRows = $this->solr->search($aParams);
        if(!empty($aRows))
        {
            $aTemp = array();
            foreach($aRows as $iKey => $aRow)
            {
                $temp=array(
                    'label' => $aRow['topic_title'],
                    'value' => $aRow['topic_title'],
                    'url' => asset('topic/detail/').'/'.$aRow['topic_id']
                );
                $aTemp[] = $temp;
            }
            $aResult['data'] = $aTemp;
            $aResult['status'] = true;
        }
        */
        
        
        /*
         * search full text with MYSQL
         */
        $aRows = $this->oTopic->search($aVals);

        if(!empty($aRows))
        {
            $aTemp = array();
            foreach($aRows as $iKey => $aRow)
            {
                $temp=array(
                    'label' => $aRow['title'],
                    'value' => $aRow['title'],
                    'url' => asset('topic/detail/').'/'.$aRow['topic_id']
                );
                $aTemp[] = $temp;
            }
            $aResult['data'] = $aTemp;
            $aResult['status'] = true;
        }

        return $aResult;
    }
}