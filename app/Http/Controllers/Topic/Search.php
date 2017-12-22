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
        $aVals = $request->all();
        if(!empty($aVals))
        {
            $aParams = array(
                'query' => 'topic_title : "*'.$aVals['search'].'*"',
                'field' => '*',
                'sort' => 'desc'
            );
            $aResult = $this->solr->search($aParams);
        }
        return view('Search',[]);

    }
}