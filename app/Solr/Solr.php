<?php
namespace App\Solr;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class Solr extends Model
{
    protected $client;
    protected $endpoint;
    private $proximity_matching = 1000;
    
    
    
    public function __construct()
    {
        $this->client = new \Solarium\Client(config('solarium'));
        $this->endpoint = $this->client->getEndpoint();
        $this->client->getEndpoint()->setAuthentication('admin','985632');
    }

    /**
     * @return string
     */
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

    /**
     * @param array $aParams
     * @return string
     */
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
                    $sQuery.= '(topic_title : "'.$value.'"~'.$this->proximity_matching.'OR description : "'.$value.'"~'.$this->proximity_matching.') AND';
                    
                }
                elseif ($sIndex = 'category')
                {

                }

            }
        }
        return trim($sQuery,'AND');
    }

    /**
     * @param array $aParams
     * @return array
     */
    public function search($aParams = array())
    {
        $query = $this->client->createSelect();

        /*-------check query string-------*/
        if(empty($aParams['query']))
        {
            $query->setQuery('*:*');
        }
        else
        {
            $query->setQuery($aParams['query']);
        }

        /*-------check field-------*/
        if(!empty($aParams['field']))
        {
            $query->setFields($aParams['field']);
        }
        else
        {
            $query->setFields('*');
        }

        /*-------check sort-------*/
        if(!empty($aParams['sort']))
        {
            foreach($aParams['sort'] as $sField => $sOrder)
            {
                $query->addSort($sField, ($sOrder === 'desc' ? $query::SORT_DESC : $query::SORT_ASC));
            }
        }

        /*-------check limit-------*/
        if(!empty($aParams['limit']))
        {
            $query->setRows((int)$aParams['limit']);
        }
        else
        {
            $query->setRows(10);
        }

        /*-------check pagination-------*/
        if(!empty($aParams['pagination']))
        {
            $query->setStart($aParams['pagination']);
        }
        else
        {
            $query->setStart(0);
        }



        $resultset = $this->client->select($query);
        $aResult = array();
        if(!empty((int)$resultset->getNumFound()))
        {
            foreach ($resultset as $iKey => $document) {
                foreach ($document as $field => $value) {
                    $aResult[$iKey][$field] = ($field == 'time_stamp' ? date('d-m-Y H:i:s',$value) : $value);
                }
            }
        }
        return $aResult;
    }
}