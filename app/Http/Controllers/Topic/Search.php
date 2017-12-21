<?php
namespace App\Http\Controllers\Topic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\User\LoginController;
use App\Solr\SolrModel;
class SearchController extends Controller
{
    private $solr;
    public function __construct()
    {
        $this->solr = new SolrModel();
    }

    public function process(Request $request)
    {
        $aVals = $request->all();
        if(!empty($aVals))
        {
            return view('Search',[]);
        }
        return view('Search',[]);

    }
}