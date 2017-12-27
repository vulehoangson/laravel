<?php
namespace App\Solr;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class Solr extends Model
{
    protected $client;
    protected $endpoint;

    public function __construct()
    {
        $this->client = new \Solarium\Client(config('solarium'));
        $this->endpoint = $this->client->getEndpoint();
        $this->client->getEndpoint()->setAuthentication('admin','985632');
    }

    public function ping()
    {
        // create a ping query
        $ping = $this->client->createPing();

        // execute the ping query
        try {
            $ping = $this->client->ping($ping)->getResponse()->getBody();
            $aStatus = json_decode($ping,true);
            return $aStatus['status'];
        } catch (\Solarium\Exception $e) {
            return "ERROR";
        }
    }
    public function createQuery($aParams = array())
    {
        $sQuery = '';
        unset($aParams['_token']);
        foreach($aParams as $sIndex => $value)
        {
            if(!empty($value) )
            {
                if($sIndex = 'search')
                {
                    $aWords = explode(' ',$value);
                    if ((int)count($aWords) === 1)
                    {
                        $sQuery.= '(topic_title : "*'.$aWords[0].'*" OR description : "*'.$aWords[0].'*") AND';
                    }
                    else
                    {
                        $sTemp='(';
                        foreach($aWords as $aWord)
                        {
                            $sTemp.= '(topic_title : "*'.$aWord.'*" OR description : "*'.$aWord.'*") OR';
                        }
                        $sQuery = trim($sTemp,' OR').') AND';

                    }
                }
                elseif ($sIndex = 'category')
                {

                }

            }
        }
        return trim($sQuery,'AND');
    }
    public function search($aParams = array())
    {
        $query = $this->client->createSelect();
        if(empty($aParams['query']))
        {
            $query->setQuery('*:*');
        }
        else
        {
            $query->setQuery($aParams['query']);
        }
        $query->setFields($aParams['field']);
        $query->addSort('topic_id', ($aParams['sort'] === 'desc' ? $query::SORT_DESC : $query::SORT_ASC));

        $resultset = $this->client->select($query);
        $aResult = array();
        if(!empty((int)$resultset->getNumFound()))
        {
            foreach ($resultset as $iKey => $document) {
                // the documents are also iterable, to get all fields
                foreach ($document as $field => $value) {
                    // this converts multivalue fields to a comma-separated string
                    $aResult[$iKey][$field] = ($field == 'time_stamp' ? date('d-m-Y H:i:s',$value) : $value);
                }
            }
        }
        return $aResult;
    }
}