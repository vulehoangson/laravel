<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Book;
class Test extends Controller
{
    public function showNotify($sStr='aaaaa',$s='bbbbb')
    {
        return view('Test',array('sStr' => $sStr,'s' => $s));
    }
    public function getBooks($iBookId,$sName)
    {
        $data=Book::getBook($iBookId,$sName);
        return view('Test',array('aData' => $data));
    }
    
    public function addBook($sName)
    {
        echo Book::insertBook(array('name' => $sName));
    }
    public function getBookList()
    {
        $data=Book::getBooks();
        return view('Test',array('aData' => $data));
    }
}