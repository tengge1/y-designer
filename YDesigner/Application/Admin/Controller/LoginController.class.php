<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Crypt;

/**
 * 登录控制器
 */
class LoginController extends Controller {   
    
    /**
     * 登录页面
     */
    public function index() {
        $this -> display();
    }
    
    /**
     * 用户登录
     * @param mixed $username 用户名
     * @param mixed $password 密码
     */
    public function login(
        $username = '',
        $password = ''
        ) {
        if($username == '') {
            $this -> ajaxReturn(array(
                'statusCode' => 300,
                'message' => '用户名不允许为空'
                ));
            return;
        }
        if($password == '') {
            $this -> ajaxReturn(array(
                'statusCode' => 300,
                'message' => '密码不允许为空'
                ));
            return;
        }
        
        $password = Crypt :: encrypt($password, C('PASSWORD_ENCRYPT_KEY'));
        $users = M('User') -> where("username='%s' and password='%s'", $username, $password) -> select();
        if(empty($users)) {
            $this -> ajaxReturn(array(
                'statusCode' => 300,
                'message' => '用户名或密码错误'
                ));
            return;
        }
        session('user_id', $users[0]['id']);
        session('username', $users[0]['username']);
        session('name', $users[0]['name']);
        session('phone', $users[0]['phone']);
        session('last_login_time', $users[0]['last_login_time']);
        session('user_type', $users[0]['type']);
        
        //记录登录时间
        M('User') -> where("id='%d'", $users[0]['id']) ->save(array(
            'last_login_time' => time()
            ));
        
        $this -> ajaxReturn(array(
            'statusCode' => 200,
            'message' => '用户登录成功'
            ));
    }
    
    /**
     * 用户注销
     */
    public function logout() { //注销
        session(null);
        $this -> redirect('Admin/Login/index');
    }
}
