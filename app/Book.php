<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Book extends Model
{
    protected $sTable;
    private $aBook;


    public function __construct($sName)
    {
        $this->sTable = 'book';
    }

    public function getValue($sIndex)
    {
        return ( !empty($this->$aBook[$sIndex]) ? $this->$aBook[$sIndex] : null );
    }

    public function setValue($sIndex,$value)
    {
        $this->$aBook[$sIndex] = $value;
    }

    public static function insertBook($aVals)
    {
        if(!empty($aVals))
        {
            DB::table('book')->insert($aVals);
            return true;
        }
        return false;
    }

    public function updateBook($iBookId,$aVals)
    {
        if(!empty($aVals))
        {
            \DB::table('book')->where('book_id',$iBookId)->update($aVals);
            return true;
        }
        return false;
    }

    public function deleteBook($iBookId)
    {
        if(!empty($iBookId))
        {
            \DB::table('book')->where('book_id',$iBookId)->delete();
            return true;
        }
        return false;
    }

    public static function getBook($iBookId,$sName)
    {
        if(!empty($iBookId))
        {
            $data=\DB::table('book')->select('*')->where([
                ['book_id','=',$iBookId],
                ['name','=',$sName]
            ])->orderBy('book_id','desc')->get();
            if(!empty($data))
            {
                return $data;
            }
            return false;
        }

    }

    public static function getBooks()
    {
        
            $data=\DB::table('book')->select('*')->orderBy('book_id','desc')->get();
            if(!empty($data))
            {
                return $data;
            }
            return false;
       

    }

}
