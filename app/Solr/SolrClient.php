<?php
namespace App\Solr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class SolrModel extends Model
{
    private $host = 'localhost';
    private $port = '8088';
    private $path = '/solr/test/';
    private $protocol = 'http';
    private $username = 'admin';
    private $password = '985632';
    private $solr = '';

    public function __construct()
    {

    }
}