<?php

namespace Admin\Controller;

use Think\Controller;
use Think\Crypt;

/**
 * 上传控制器
 */
class UploadController extends Controller {
    
    /**
     * 上传文件
     */
    public function upload() {
        $Upload = new \Think\Upload(array(
            rootPath => './Public/Upload/'
            ));
        $info = $Upload -> upload();
        echo $info['file']['savepath'].$info['file']['savename'];
    }
    
}
