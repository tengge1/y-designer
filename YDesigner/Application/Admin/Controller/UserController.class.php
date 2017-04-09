<?php

namespace Admin\Controller;

use Think\Controller;
use Think\Crypt;

/**
 * 用户管理控制器
 */
class UserController extends Controller {
    
    /**
     * 用户列表页面
     * @param mixed $pageNum 第几页
     * @param mixed $numPerPage 每页数量
     * @param mixed $keyword 关键字
     */
    public function index(
        $pageNum = 1,
        $numPerPage = 100,
        $keyword = ''
        ){
        
        //进行查询
        $where['name'] = array('LIKE','%'.$keyword.'%');
        $User = M('User');
        $total = $User -> where($where) -> count();
        $list = $User -> where($where) 
            -> order("id") 
            -> page($pageNum.','.$numPerPage) 
            -> select();
        
        //输出查询结果
        $this -> assign('keyword', $keyword);
        $this -> assign('total', $total);
        $this -> assign('list', $list);
        $this -> assign('pageNum', $pageNum);
        $this -> assign('numPerPage', $numPerPage);
        $this->display();
    }
    
    /**
     * 添加用户页面
     * @param mixed $username 用户名
     * @param mixed $password 密码
     * @param mixed $name 姓名
     * @param mixed $phone 手机号
     * @param mixed $type 类型（01-管理员，02-报价员）
     * @param mixed $comment 备注
     */
    public function add(
        $username = '',
        $password = '',
        $name = '',
        $phone = '',
        $type = '',
        $comment = ''
        ){
        if(IS_POST) { //POST操作
            $count = M('User') -> where("username='%s'", $username) -> count();
            if($count > 0) {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '该用户名已经存在，添加失败'
                    ));
                return;
            }
            
            $User = M('User');
            if(!$User -> create()){ //创建用户失败
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => $User -> getError()
                    ));
                return;
            }
            $User -> password = Crypt :: encrypt($User -> password, C('PASSWORD_ENCRYPT_KEY'));
            $User -> add();
            $this -> ajaxReturn(array(
                'statusCode' => 200,
                'message' => '添加成功',
                'navTabId' => 'yd_user',
                'callbackType' => 'closeCurrent'
                ));
        } else { //GET操作
            $this -> display();
        }
    }
    
    /**
     * 编辑用户界面
     * @param mixed $user_id 用户ID
     * @param mixed $username 用户名
     * @param mixed $name 姓名
     * @param mixed $phone 手机号
     * @param mixed $type 用户类型（01-管理员，02-报价员）
     * @param mixed $comment 备注
     * @return void
     */
    public function edit(
        $user_id = '0',
        $username = '',
        $name = '',
        $phone = '',
        $type = '',
        $comment = ''
        ){
        if(IS_POST) {
            if(C('DEMO') == true) {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '演示版本不允许修改用户'
                    ));                
                return;
            }
            
            // 检查用户是否存在
            $users = M('User') -> where("id=%d", $user_id) -> select();
            if(empty($users)) {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '该用户不存在'
                    ));
                return;
            }
            
            // 修改用户信息
            $data['name'] = $name;
            $data['phone'] = $phone;
            $data['type'] = $type;
            $data['comment'] = $comment;
            
            M('User') -> where("id='%d'", $user_id) -> save($data);
            
            $this -> ajaxReturn(array(
                'statusCode' => 200,
                'message' => '修改成功',
                'navTabId' => 'yd_user',
                'callbackType' => 'closeCurrent'
                ));
        } else {
            $users = M('User') -> where("id='%d'", $user_id) -> select();
            if(!empty($users)) {
                $this -> assign('user', $users[0]);
            }
            $this -> display();
        }
    }
    
    /**
     * 删除用户功能
     * @param mixed $user_id 用户ID
     */
    public function remove(
        $user_id = '0'
        ){
        if(IS_POST){
            if(C('DEMO') == true) {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '演示版本不允许删除用户'
                    ));                
                return;
            }
            
            $users = M('User') -> where("id='%d'", $user_id) -> select();
            if(empty($users)) {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '该用户ID不存在',
                    'navTabId' => 'yd_user'
                    ));
                return;
            }
            $username = $users[0]['username'];
            
            if($username == 'admin'){ //超级管理员
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '不允许删除超级管理员',
                    'navTabId' => 'yd_user'
                    ));
                return;
            }
            M('User') -> where("id='%d'", $user_id) -> delete();
            $this -> ajaxReturn(array(
                'statusCode' => 200,
                'message' => '删除成功',
                'navTabId' => 'yd_user'
                ));
        }
    } 
}
