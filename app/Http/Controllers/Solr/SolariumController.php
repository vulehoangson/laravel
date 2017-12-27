<?php
/*
namespace App\Http\Controllers\Solr;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SolariumController extends Controller
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
                    $aResult[$iKey][$field] = $value;
                }
            }
        }
        return $aResult;
    }
}*/
