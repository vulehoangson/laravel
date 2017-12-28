<?php
namespace App\Http\Controllers\Topic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\User\LoginController;
use App\Solr\Solr;
class SearchController extends Controller
{
    private $solr;
    public function __construct()
    {
        $this->solr = new Solr();
    }

    public function process(Request $request)
    {
        $oUser=new LoginController();
        $aFrontend=array();
        list($bLogin,$iUserGroup)=$oUser->checkAutoLogin(true);

        $aVals = $request->all();

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
        if(!empty($aResult))
        {
            $aFrontend['aTopics'] = $aResult;
        }

        return view('Search',['bLogin' => $bLogin,'iUserGroup' => $iUserGroup,'aFrontend' => $aFrontend]);

    }
    public function suggestion($sKey = '')
    {

        $aResult = array(
            'status' => false,
        );

        $aSuggestion = array(
            'search' => $sKey
        );
        
        /**
         * create parameters for solr
         */
        $aParams = array(
            'query' => $this->solr->createQuery($aSuggestion),
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
                    'value' => $aRow['topic_title']
                );
                $aTemp[] = $temp;
            }
            $aResult['data'] = $aTemp;
            $aResult['status'] = true;
        }

        return $aResult;
    }
}