<?php

namespace Admin\Controller;

use Think\Controller;
use Think\Crypt;

/**
 * 后台控制器
 */
class IndexController extends Controller {
    
    /**
     * 管理后台首页
     * @return void
     */
    public function index() {
        if(session('user_id') == null) {
            $this -> redirect("Admin/Login/index");
            return;
        }
        $article_count = M('Article') -> count();
        $user_count = M('User') -> count();
        $app_count = M('App') -> count();
        
        $this -> assign('article_count', $article_count);
        $this -> assign('user_count', $user_count);
        $this -> assign('app_count', $app_count);
        $this -> assign('user_type', session('user_type'));
        
        $this->display();
    }
    
    /**
     * 修改密码
     * @param mixed $password_old 原密码
     * @param mixed $password_new 新密码
     * @param mixed $password_confirm 确认密码
     * @return void
     */
    public function password(
        $password_old = '',
        $password_new = '',
        $password_confirm = ''
        ) {
        
        if(IS_POST) { //POST方法
            
            if(C('DEMO') == true) {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '演示版本不允许修改密码'
                    ));                
                return;
            }
            
            if($password_old == '') {
                $this -> ajaxReturn(array(
                    'statusCode' => 200,
                    'message' => '原密码不允许为空'
                    ));
                return;
            }
            if($password_new == '') {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '新密码不允许为空'
                    ));
                return;
            }
            if($password_confirm == '') {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '确认密码不允许为空'
                    ));
                return;
            }
            if($password_new != $password_confirm) {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '新密码和确认密码不相同'
                    ));
                return;
            }            
            
            //对密码进行加密
            $password_old = Crypt :: encrypt($password_old, C('PASSWORD_ENCRYPT_KEY'));
            $password_new = Crypt :: encrypt($password_new, C('PASSWORD_ENCRYPT_KEY'));
            $password_confirm = Crypt :: encrypt($password_confirm, C('PASSWORD_ENCRYPT_KEY'));
            
            $users = M('User') -> where("id='%d' and password='%s'", session('user_id'), $password_old) -> select();
            if(empty($users)) {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '原密码错误'
                    ));
                return;
            }
            
            // 修改密码
            $data['password'] = $password_new;
            M('User') -> where("id='%d'", session('user_id')) -> save($data);
            
            $this -> ajaxReturn(array(
                'statusCode' => 200,
                'message' => '密码修改成功',
                'callbackType' => 'closeCurrent'
                ));
        } else { //GET方法
            $this -> display();
        }
    }
    
}
