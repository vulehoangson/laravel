<?php
namespace App\Http\Controllers\Topic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Topic\TopicModel;
use App\Topic\CategoryModel;
use App\Http\Controllers\User\LoginController;

class UploadController extends Controller
{
    private $oCategoryModel;
    private $oTopicModel;
    public function __construct()
    {
        $this->oCategoryModel= new CategoryModel();
        $this->oTopicModel = new TopicModel();
    }

    public function process(Request $request )
    {
        $oUser=new LoginController();
        list($bLogin,$iUserGroup)=$oUser->checkAutoLogin(true);
        if(!$bLogin)
        {
            return back();
        }
        $aVals= $request->all();
        $aCurrencies=Helper::getCurrencies();
        $aCategories = $this->oCategoryModel->getList([
            ['is_root','<>',1]
        ]);
        $aFrontend=array();
        $aError = array();
        $sSuccess = '';
        if(!empty($aVals))
        {

            $iId=$this->oTopicModel->_add($aVals);


            if(!empty($iId))
            {
                $iLimitSize = 1024*1024*5;
                $aFiles = array();
                foreach($request->file as $file)
                {
                    $iSize = $file->getClientSize();

                    if($iSize <= $iLimitSize)
                    {
                        date_default_timezone_set('Asia/Ho_Chi_Minh');
                        $sPath = $file->store('files');
                        $aInsert = array(
                            'path' => $sPath,
                            'topic_id' => (int)$iId,
                            'name' => pathinfo($file->getClientOriginalName(),  PATHINFO_FILENAME),
                            'type' => pathinfo($file->getClientOriginalName(),  PATHINFO_EXTENSION),
                            'time_stamp' => strtotime(date('d-m-Y H:i:s'))
                        );
                        $aFiles[] = $aInsert;
                    }
                    else
                    {
                        $aError[]['content']=(string)'File '.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME).' vượt quá 5 MB nên đã bị bỏ qua';
                    }

                }

                if(!empty($aFiles))
                {
                    $this->oTopicModel->addAttachFiles($aFiles);
                }
                $sSuccess ='Upload thành công';
               
            }
            else
            {
                $aError[]['content']= 'Upload không thành công. Kiểm tra lại dữ liệu nhập !!!';
            }
        }
        if(!empty($aCurrencies))
        {
            $aFrontend['aCurrencies'] = $aCurrencies;
        }
        if(!empty($aCategories))
        {
            $aFrontend['aCategories'] = $aCategories;
        }

        return view('upload',['aFrontend' => $aFrontend, 'bLogin' => $bLogin,'iUserGroup' => $iUserGroup,'aError' => $aError, 'sSuccess' => $sSuccess]);
    }
}