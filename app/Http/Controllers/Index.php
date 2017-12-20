<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\LoginController;
use App\Topic\CategoryModel;
class IndexController extends Controller
{
    private $oCategoryModel;
    public function __construct()
    {
        $this->oCategoryModel = new CategoryModel();
    }

    public function process()
    {
        $oUser=new LoginController();
        $aFrontend=array();
        list($bLogin,$iUserGroup)=$oUser->checkAutoLogin(true);
        $aCategories = $this->oCategoryModel->getList([
            ['is_root','<>',1]
        ]);
        foreach ($aCategories as $iKey => $aCategory)
        {
            $aCategories[$iKey]['aTopics'] = $this->oCategoryModel->getTopTopicsForCategory($aCategory['category_id']);
        }
        if(!empty($aCategories))
        {
            $aFrontend['aCategories'] = $aCategories;
        }
        return view('index',['bLogin' => $bLogin,'iUserGroup' => $iUserGroup,'aFrontend' => $aFrontend]);
    }
}