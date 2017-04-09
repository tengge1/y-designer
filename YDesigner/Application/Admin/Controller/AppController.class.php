<?php

namespace Admin\Controller;

use Think\Controller;
use Think\Crypt;

/**
 * 应用管理控制器
 */
class AppController extends Controller {
    
    /**
     * 应用列表页面
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
        $where['yd_app.name'] = array('LIKE','%'.$keyword.'%');
        $where['yd_app.user_id'] = session('user_id');
        $total = M('App') -> where($where) -> count();
        $list = M('App') -> join('inner join yd_user on yd_user.id=yd_app.user_id') -> where($where) 
            -> order('yd_app.id')
            -> field('yd_app.id,yd_app.name,yd_app.code,yd_user.name user_name,yd_app.create_time,yd_app.comment')
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
     * 添加应用界面
     * @param mixed $name 应用名称
     * @param mixed $code 应用代号
     * @param mixed $comment 备注
     * @return void
     */
    public function add(
        $name = '',
        $code = '',
        $comment = ''
        ){
        if(IS_POST) { //POST操作
            $count = M('App') -> where("code='%s' and user_id='%s' ", $code, session('user_id')) -> count();
            if($count > 0) {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '该应用代号已经存在，添加失败'
                    ));
                return;
            }
            M('App') -> add(array(
                'name' => $name,
                'code' => $code,
                'user_id' => session('user_id'),
                'create_time' => time(),
                'comment' => $comment
                ));
            $this -> ajaxReturn(array(
                'statusCode' => 200,
                'message' => '添加成功',
                'navTabId' => 'yd_app',
                'callbackType' => 'closeCurrent'
                ));
        } else { //GET操作
            $this -> display();
        }
    }
    
    /**
     * 编辑应用界面
     * @param mixed $app_id 应用编号
     * @param mixed $name 应用名称
     * @param mixed $code 应用代号
     * @param mixed $comment 备注
     * @return void
     */
    public function edit(
        $app_id = '0',
        $name = '',
        $code = '',
        $comment = ''
        ){
        if(IS_POST) {
            
            if(C('DEMO') == true) {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '演示版本不允许修改应用信息'
                    ));                
                return;
            }
            
            // 检查应用是否存在
            $apps = M('App') -> where("id='%d' and user_id='%d'", $app_id, session('user_id')) -> select();
            if(empty($apps)) {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '该应用不存在'
                    ));
                return;
            }
            
            // 修改应用信息
            M('App') -> where("id='%d'", $app_id) -> save(array(
                'name' => $name,
                'comment' => $comment
                ));
            
            $this -> ajaxReturn(array(
                'statusCode' => 200,
                'message' => '修改成功',
                'navTabId' => 'yd_app',
                'callbackType' => 'closeCurrent'
                ));
        } else {
            $apps = M('App') -> where("id='%d'", $app_id) -> select();
            if(!empty($apps)) {
                $this -> assign('app', $apps[0]);
            }
            $this -> display();
        }
    }
    
    /**
     * 删除应用功能
     * @param mixed $app_id 应用ID
     * @return void
     */
    public function remove(
        $app_id = '0'
        ){
        if(IS_POST){
            
            if(C('DEMO') == true) {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '演示版本不允许删除应用'
                    ));                
                return;
            }
            
            $apps = M('app') -> where("id='%d' and user_id='%d'", $app_id, session('user_id')) -> select();
            if(empty($apps)) {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '该应用不存在',
                    'navTabId' => 'yd_app'
                    ));
                return;
            }
            M('app') -> where("id='%d'", $app_id) -> delete();
            $this -> ajaxReturn(array(
                'statusCode' => 200,
                'message' => '删除成功',
                'navTabId' => 'yd_app'
                ));
        }
    } 
    
    /**
     * 设计应用功能
     * @param mixed $app_id 应用ID
     */
    public function design(
        $app_id = '0'
        ) {
        $this -> redirect('Design/index/app_id/'.$app_id);
    }
}
