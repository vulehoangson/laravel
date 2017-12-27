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
            'sort' => 'desc'
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
            'status' => false
        );
        if(!empty($sKey))
        {
            $aSuggestion = array(
                'search' => $sKey
            );
            $aParams = array(
                'query' => $this->solr->createQuery($aSuggestion),
                'field' => '*',
                'sort' => 'desc'
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
        }
        return $aResult;
    }
}