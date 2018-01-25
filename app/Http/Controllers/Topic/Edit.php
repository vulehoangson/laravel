<?php
namespace App\Http\Controllers\Topic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Topic\TopicModel;
use App\Topic\CategoryModel;
use App\Http\Controllers\User\LoginController;
use Intervention\Image\ImageManagerStatic as Image;
class EditController extends Controller
{
    private $oUser;
    private $oTopicModel;
    private $oCategoryModel;
    private $oHelper;
    public function __construct()
    {
        $this->oUser = new LoginController();
        $this->oTopicModel = new TopicModel();
        $this->oCategoryModel= new CategoryModel();
        $this->oHelper = new Helper();
    }

    public function process(Request $request)
    {
        $iCurrentUserId = $this->oUser->getCurrentUserId();
        list($bLogin,$iUserGroup)=$this->oUser->checkAutoLogin(true);
        $iTopicId = (int)$request->id;
        $aTopic = $this->oTopicModel->getQuickTopic($iTopicId);
        $aCurrencies=Helper::getCurrencies();
        $aCategories = $this->oCategoryModel->getList([
            ['is_root','<>',1]
        ]);
        if(!empty($aTopic))
        {
            return redirect(url(''));
        }
        if(!$bLogin || $aTopic['user_id'] <> $iCurrentUserId )
        {
            return back();
        }
        $aFrontend = array();
        $aError = array();
        $sSuccess = '';
        
        $aVals = $request->val;
        if(!empty($aVals))
        {
            if(!empty($iTopicId))
            {
                $bSuccess = $this->oTopicModel->_update($iTopicId, $aVals);
                if($bSuccess)
                {
                    $aExistingFiles = $aVals['attachment'];
                    $aAttachmentIds = array();
                    foreach($aExistingFiles as $iAttachmentId)
                    {
                        if(!empty($iAttachmentId))
                        {
                            $aAttachmentIds[] = $iAttachmentId;
                        }

                    }
                    $aFilesNotIn = $this->oTopicModel->getFilesNotIn($iTopicId, $aAttachmentIds);
                    $this->oHelper->deleteFiles($aFilesNotIn);
                    $aDeletedFileIds = array();
                    foreach($aFilesNotIn as $aFileNotIn)
                    {
                        $aDeletedFileIds[] = $aFileNotIn['attachment_id'];
                    }
                    $this->oTopicModel->deleteAttachmentFilesWithId($aDeletedFileIds);
                    $iLimitSize = 1024*1024*5;
                    $aFiles = array();
                    foreach($request->file as $file)
                    {
                        $iSize = $file->getClientSize();

                        if($iSize <= $iLimitSize)
                        {
                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                            $sBaseName = $file->getClientOriginalName();
                            $sName = pathinfo($sBaseName,  PATHINFO_FILENAME);
                            $sExtension = pathinfo($sBaseName,  PATHINFO_EXTENSION);
                            $sFileName = '';
                            $sPath = '';
                            if($sExtension === 'mp4')
                            {
                                /*--------Save files in storage/app/public/files using function store---------*/
                                //$sPath = $file->store('public/files');


                                /*--------Save files in public/files using function move-----------*/
                                $sFileName = md5($sName.date('m/d/Y H:i:s').$sExtension.$sBaseName.uniqid());
                                $sPath = $file->move('files/',$sFileName.'.'.$sExtension);
                            }
                            else
                            {
                                $aImageSize = getimagesize($file);
                                $iImageWidth = !empty($aImageSize[0]) ? $aImageSize[0] : 0;
                                $iImageHeight = !empty($aImageSize[1]) ? $aImageSize[1] : 0;
                                if($iImageHeight >= 400)
                                {
                                    $iTrueWidth = 0;
                                    $iTrueHeight = 0 ;
                                    list($iTrueWidth, $iTrueHeight) = $this->oHelper->calculateImageSize($iImageWidth, $iImageHeight, 400, 400);

                                    /*------Using Image library of Laravel to resize image---------------*/
                                    $oImageResize = Image::make($file->getRealPath());
                                    $oImageResize->resize($iTrueWidth, $iTrueHeight);
                                    $sFileName  = md5($sName.date('m/d/Y H:i:s').$sExtension.$sBaseName.uniqid());
                                    $oImageResize->save(public_path('/files/'.$sFileName.'.'.$sExtension) );
                                    $sPath = 'files/'.$sFileName.'.'.$sExtension;

                                }
                                else
                                {
                                    /*--------Save files in storage/app/public/files using function store---------*/
                                    //$sPath = $file->store('public/files');

                                    /*--------Save files in public/files using function move-----------*/
                                    $sFileName = md5($sName.date('m/d/Y H:i:s').$sExtension.$sBaseName.uniqid());
                                    $sPath = $file->move('files/',$sFileName.'.'.$sExtension);
                                }

                            }

                            $aInsert = array(
                                'path' => $sPath,
                                'topic_id' => (int)$iTopicId,
                                'name' => $sName,
                                'type' => $sExtension,
                                'time_stamp' => strtotime(date('d-m-Y H:i:s'))
                            );
                            $aFiles[] = $aInsert;
                        }
                        else
                        {
                            $aError[]['content']=(string)'File '.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME).' vượt quá 5 MB nên đã bị bỏ qua';
                        }

                    }
                }


                if(!empty($aFiles))
                {
                    $this->oTopicModel->addAttachFiles($aFiles);
                }
                $sSuccess ='Cập nhật thành công.';

            }
            else
            {
                $aError[]['content']= 'Cập nhật không thành công. Kiểm tra lại dữ liệu nhập !!!';
            }
        }
        if(!empty($aTopic))
        {
            $aFrontend['aTopic'] = $aTopic;
        }
        if(!empty($aCurrencies))
        {
            $aFrontend['aCurrencies'] = $aCurrencies;
        }
        if(!empty($aCategories))
        {
            $aFrontend['aCategories'] = $aCategories;
        }
        return view('Edit',['aFrontend' => $aFrontend, 'bLogin' => $bLogin,'iUserGroup' => $iUserGroup,'aError' => $aError, 'sSuccess' => $sSuccess]);
    }
}
?>