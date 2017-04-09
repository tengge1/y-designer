<?php

namespace Admin\Controller;

use Think\Controller;
use Think\Crypt;

/**
 * 设计模板控制器
 */
class TemplateController extends Controller {
    
    /**
     * 条目列表页面
     * @param mixed $pageNum 第几页
     * @param mixed $numPerPage 每页数量
     * @param mixed $keyword 关键字
     */
    public function index(
        $pageNum = 1,
        $numPerPage = 100,
        $keyword = '',
        $app_id = '',
        $menu_id = ''
        ){
        
        // 查询是否存在该应用ID，该菜单ID的表格
        $parts = M('Part') -> where("app_id='%s' and menu_id='%s'", $app_id, $menu_id) -> select();
        if(empty($parts)) {
            // 创建该应用ID，该菜单ID的页面组件代码
            $main_id = M('Part') -> add(array(
                'app_id' => $app_id,
                'menu_id' => $menu_id,
                'code' => 'main',
                'comment' => 'index页面表单'
                ));
            $search_id = M('Part') -> add(array(
                'app_id' => $app_id,
                'menu_id' => $menu_id,
                'code' => 'search',
                'comment' => 'index页面搜索'
                ));
            $add_form_id = M('Part') -> add(array(
                'app_id' => $app_id,
                'menu_id' => $menu_id,
                'code' => 'add_form',
                'comment' => 'add页面表单'
                ));
            $edit_form_id = M('Part') -> add(array(
                'app_id' => $app_id,
                'menu_id' => $menu_id,
                'code' => 'edit_form',
                'comment' => 'edit页面表单'
                ));
            // 初始化该应用index页面表单的列
            M('Col') -> add(array(
                'app_id' => $app_id,
                'menu_id' => $menu_id,
                'part_id' => $main_id,
                'name' => '编号',
                'code' => 'id',
                'width' => 80,
                'type' => '01',
                'size' => '0',
                'order' => '1'
                ));
            M('Col') -> add(array(
                'app_id' => $app_id,
                'menu_id' => $menu_id,
                'part_id' => $main_id,
                'name' => '名称',
                'code' => 'name',
                'width' => 150,
                'type' => '02',
                'size' => '50',
                'order' => '2'
                ));
            M('Col') -> add(array(
                'app_id' => $app_id,
                'menu_id' => $menu_id,
                'part_id' => $main_id,
                'name' => '备注',
                'code' => 'comment',
                'width' => 200,
                'type' => '02',
                'size' => '500',
                'order' => '3'
                ));
            // 初始化该应用index页面查询表单
            M('Form') -> add(array(
                'app_id' => $app_id,
                'menu_id' => $menu_id,
                'part_id' => $search_id,
                'name' => '名称',
                'code' => 'name',
                'width' => 300,
                'type' => '02'
                ));
            // 初始化该应用add_form页面表单
            M('Form') -> add(array(
                'app_id' => $app_id,
                'menu_id' => $menu_id,
                'part_id' => $add_form_id,
                'name' => '名称',
                'code' => 'name',
                'width' => 300,
                'type' => '02'
                ));
            M('Form') -> add(array(
                'app_id' => $app_id,
                'menu_id' => $menu_id,
                'part_id' => $add_form_id,
                'name' => '备注',
                'code' => 'comment',
                'width' => 300,
                'type' => '02'
                ));
            // 初始化该应用edit_form页面表单
            M('Form') -> add(array(
                'app_id' => $app_id,
                'menu_id' => $menu_id,
                'part_id' => $edit_form_id,
                'name' => '名称',
                'code' => 'name',
                'width' => 300,
                'type' => '02'
                ));
            M('Form') -> add(array(
                'app_id' => $app_id,
                'menu_id' => $menu_id,
                'part_id' => $edit_form_id,
                'name' => '备注',
                'code' => 'comment',
                'width' => 300,
                'type' => '02'
                ));
        }
        
        // 获取该模板相关信息
        $main_id = 0;
        $search_id = 0;
        $mains = M('Part') -> where("app_id='%s' and menu_id='%s' and code='main'", $app_id, $menu_id) -> select();
        if(!empty($mains)) {
            $main_id = $mains[0]['id'];
        }
        $searches = M('Part') -> where("app_id='%s' and menu_id='%s' and code='search'", $app_id, $menu_id) -> select();
        if(!empty($searches)) {
            $search_id = $searches[0]['id'];
        }
        $mains = M('Col') -> where("part_id='%s'", $main_id) -> order('`order`') -> select();
        $searches = M('Form') -> where("part_id='%s'", $search_id) -> select();
        $this -> assign('mains', $mains);
        $this -> assign('searches', $searches);
        
        // 查询数据
        $total = 0;
        $list = array();
        
        //输出查询结果
        $this -> assign('app_id', $app_id);
        $this -> assign('menu_id', $menu_id);
        $this -> assign('keyword', $keyword);
        $this -> assign('total', $total);
        $this -> assign('list', $list);
        $this -> assign('pageNum', $pageNum);
        $this -> assign('numPerPage', $numPerPage);
        $this->display();
    }
    
    /**
     * 添加条目页面
     * @param mixed $app_id 
     * @param mixed $menu_id 
     */
    public function add(
        $app_id = '0',
        $menu_id = '0'
        ){
        if(IS_POST) { //POST操作
            $this -> ajaxReturn(array(
                'statusCode' => 300,
                'message' => '该功能尚未完成，添加失败',
                'navTabId' => 'user',
                'callbackType' => 'closeCurrent'
                ));
        } else { //GET操作
            // 获取该模板相关信息
            $add_form_id = 0;
            $add_forms = M('Part') -> where("app_id='%s' and menu_id='%s' and code='add_form'", $app_id, $menu_id) -> select();
            if(!empty($add_forms)) {
                $add_form_id = $add_forms[0]['id'];
            }
            $add_forms = M('Form') -> where("part_id='%s'", $add_form_id) -> select();
            $this -> assign('add_forms', $add_forms);
            $this -> display();
        }
    }
    
    /**
     * 编辑条目界面
     * @param mixed $user_id 用户ID
     * @param mixed $username 用户名
     * @param mixed $name 姓名
     * @param mixed $phone 手机号
     * @param mixed $type 用户类型（01-管理员，02-报价员）
     * @param mixed $comment 备注
     * @return void
     */
    public function edit(
        $app_id = '0',
        $menu_id = '0'
        ){
        if(IS_POST) {
            $this -> ajaxReturn(array(
                'statusCode' => 300,
                'message' => '该功能尚未完成，添加失败',
                'navTabId' => 'user',
                'callbackType' => 'closeCurrent'
                ));
        } else {
            // 获取该模板相关信息
            $edit_form_id = 0;
            $edit_forms = M('Part') -> where("app_id='%s' and menu_id='%s' and code='edit_form'", $app_id, $menu_id) -> select();
            if(!empty($edit_forms)) {
                $edit_form_id = $edit_forms[0]['id'];
            }
            $edit_forms = M('Form') -> where("part_id='%s'", $edit_form_id) -> select();
            $this -> assign('edit_forms', $edit_forms);
            $this -> display();
        }
    }
    
    /**
     * 删除条目功能
     * @param mixed $user_id 用户ID
     */
    public function remove(
        $user_id = '0'
        ){
        if(IS_POST){
            $this -> ajaxReturn(array(
                'statusCode' => 300,
                'message' => '该功能尚未完成，添加失败',
                'navTabId' => 'user',
                'callbackType' => 'closeCurrent'
                ));
        }
    }
    
    /**
     * 编辑表格字段页面
     * @param mixed $app_id 应用ID
     * @param mixed $menu_id 菜单ID
     * @param mixed $pageNum 第几页
     * @param mixed $numPerPage 每页条数
     * @param mixed $keyword 查询关键词
     */
    public function editTable_index(
        $app_id = '0',
        $menu_id = '0',
        $pageNum = 1,
        $numPerPage = 100,
        $keyword = ''
        ) {
        
        //查询表格字段
        $part_id = '0';
        $parts = M('Part') -> where("app_id='%s' and menu_id='%s' and code='main'", $app_id, $menu_id) -> select();
        if(!empty($parts)) {
            $part_id = $parts[0]['id'];
        }
        
        //进行查询
        $where['name'] = array('LIKE','%'.$keyword.'%');
        $where['part_id'] = $part_id;
        $Col = M('Col');
        $total = $Col -> where($where) -> count();
        $list = $Col -> where($where) 
            -> order("`order`") 
            -> page($pageNum.','.$numPerPage) 
            -> select();
        
        $this -> assign('app_id', $app_id);
        $this -> assign('menu_id', $menu_id);
        $this -> assign('part_id', $part_id);
        
        //输出查询结果
        $this -> assign('keyword', $keyword);
        $this -> assign('total', $total);
        $this -> assign('list', $list);
        $this -> assign('pageNum', $pageNum);
        $this -> assign('numPerPage', $numPerPage);
        $this->display();
    }
    
    /**
     * 添加表格字段
     * @param mixed $app_id 应用ID
     * @param mixed $menu_id 菜单ID
     * @param mixed $part_id 组件ID
     * @param mixed $name 名称
     * @param mixed $code 代码
     * @param mixed $width 宽度
     * @param mixed $type 类型（01-整数，02-限制长度字符串）
     * @param mixed $size 字符串长度
     * @param mixed $order 排序
     * @param mixed $comment 备注
     * @return void
     */
    public function editTable_add(
        $app_id = '0',
        $menu_id = '0',
        $part_id = '0',
        $name = '',
        $code = '',
        $width = '',
        $type = '',
        $size = '',
        $order = '',
        $comment = ''
        ) {
        if(IS_POST) { //POST操作
            $count = M('Col') -> where("part_id='%s' and code='%s'", $part_id, $code) -> count();
            if($count > 0) {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '该代号已经存在，添加失败'
                    ));
                return;
            }
            
            $Col = M('Col');
            if(!$Col -> create()){ //创建字段失败
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => $Col -> getError()
                    ));
                return;
            }
            $Col -> add();
            $this -> ajaxReturn(array(
                'statusCode' => 200,
                'message' => '添加成功',
                'navTabId' => 'editTable_index',
                'callbackType' => 'closeCurrent'
                ));
        } else { //GET操作
            $this -> assign('app_id', $app_id);
            $this -> assign('menu_id', $menu_id);
            $this -> assign('part_id', $part_id);
            $this -> display();
        }
    }
    
    /**
     * 修改表格字段
     * @param mixed $col_id 字段ID
     * @param mixed $app_id 应用ID
     * @param mixed $menu_id 菜单ID
     * @param mixed $part_id 组件ID
     * @param mixed $name 名称
     * @param mixed $code 代码
     * @param mixed $width 宽度
     * @param mixed $type 类型（01-整数，02-限制长度字符串）
     * @param mixed $size 字符串长度
     * @param mixed $order 排序
     * @param mixed $comment 备注
     * @return void
     */
    public function editTable_edit(
        $col_id = '0',
        $app_id = '0',
        $menu_id = '0',
        $part_id = '0',
        $name = '',
        $code = '',
        $width = '',
        $type = '',
        $size = '',
        $order = '',
        $comment = ''
        ) {
        if(IS_POST) {
            
            // 修改用户信息
            $data['name'] = $name;
            $data['width'] = $width;
            $data['type'] = $type;
            $data['size'] = $size;
            $data['order'] = $order;
            $data['comment'] = $comment;
            
            M('Col') -> where("id='%d'", $col_id) -> save($data);
            
            $this -> ajaxReturn(array(
                'statusCode' => 200,
                'message' => '修改成功',
                'navTabId' => 'editTable_index',
                'callbackType' => 'closeCurrent'
                ));
        } else {
            $cols = M('Col') -> where("id='%d'", $col_id) -> select();
            if(!empty($cols)) {
                $this -> assign('col', $cols[0]);
            }
            $this -> assign('col_id', $col_id);
            $this -> assign('app_id', $app_id);
            $this -> assign('menu_id', $menu_id);
            $this -> assign('part_id', $part_id);
            $this -> display();
        }
    }
    
    /**
     * 删除表格字段
     * @param mixed $col_id 字段ID
     * @return void
     */
    public function editTable_remove(
        $col_id = '0'
        ) {
        if(IS_POST){
            M('Col') -> where("id='%d'", $col_id) -> delete();
            $this -> ajaxReturn(array(
                'statusCode' => 200,
                'message' => '删除成功',
                'navTabId' => 'editTable_index'
                ));
        }
    }
    
    /**
     * 编辑表单字段页面
     * @param mixed $app_id 应用ID
     * @param mixed $menu_id 菜单ID
     * @param mixed $form_type 表单类型：search-查询表单，add_form-新增表单，edit_form-编辑表单
     * @param mixed $pageNum 第几页
     * @param mixed $numPerPage 每页条数
     * @param mixed $keyword 查询关键词
     */
    public function editForm_index(
        $app_id = '0',
        $menu_id = '0',
        $form_type = 'search',
        $pageNum = 1,
        $numPerPage = 100,
        $keyword = ''
        ) {
        
        //查询表格字段
        $part_id = '0';
        $parts = M('Part') -> where("app_id='%s' and menu_id='%s' and code='%s'", $app_id, $menu_id, $form_type) -> select();
        if(!empty($parts)) {
            $part_id = $parts[0]['id'];
        }
        
        //进行查询
        $where['name'] = array('LIKE','%'.$keyword.'%');
        $where['part_id'] = $part_id;
        $Form = M('Form');
        $total = $Form -> where($where) -> count();
        $list = $Form -> where($where) 
            -> order("`order`") 
            -> page($pageNum.','.$numPerPage) 
            -> select();
        
        $this -> assign('app_id', $app_id);
        $this -> assign('menu_id', $menu_id);
        $this -> assign('part_id', $part_id);
        $this -> assign('form_type', $form_type);
        
        //输出查询结果
        $this -> assign('keyword', $keyword);
        $this -> assign('total', $total);
        $this -> assign('list', $list);
        $this -> assign('pageNum', $pageNum);
        $this -> assign('numPerPage', $numPerPage);
        $this->display();
    }
    
    /**
     * 添加表单字段
     * @param mixed $app_id 应用ID
     * @param mixed $menu_id 菜单ID
     * @param mixed $part_id 组件ID
     * @param mixed $form_type 表单类型：search-查询表单，add_form-新增表单，edit_form-编辑表单
     * @param mixed $name 名称
     * @param mixed $code 代码
     * @param mixed $width 宽度
     * @param mixed $type 类型（01-文本框，02-日期框）
     * @param mixed $order 排序
     * @param mixed $comment 备注
     * @return void
     */
    public function editForm_add(
        $app_id = '0',
        $menu_id = '0',
        $part_id = '0',
        $form_type = 'search',
        $name = '',
        $code = '',
        $width = '',
        $type = '',
        $order = '',
        $comment = ''
        ) {
        if(IS_POST) { //POST操作
            $count = M('Form') -> where("part_id='%s' and code='%s'", $part_id, $code) -> count();
            if($count > 0) {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '该代号已经存在，添加失败'
                    ));
                return;
            }
            
            $Form = M('Form');
            if(!$Form -> create()){ //创建字段失败
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => $Form -> getError()
                    ));
                return;
            }
            $Form -> add();
            $this -> ajaxReturn(array(
                'statusCode' => 200,
                'message' => '添加成功',
                'navTabId' => 'editForm_index',
                'callbackType' => 'closeCurrent'
                ));
        } else { //GET操作
            $this -> assign('app_id', $app_id);
            $this -> assign('menu_id', $menu_id);
            $this -> assign('part_id', $part_id);
            $this -> assign('form_type', $form_type);
            $this -> display();
        }
    }
    
    /**
     * 修改表单字段
     * @param mixed $form_id 控件ID
     * @param mixed $app_id 应用ID
     * @param mixed $menu_id 菜单ID
     * @param mixed $part_id 组件ID
     * @param mixed $form_type 表单类型：search-查询表单，add_form-新增表单，edit_form-编辑表单
     * @param mixed $name 名称
     * @param mixed $code 代码
     * @param mixed $width 宽度
     * @param mixed $type 类型（01-文本框，02-日期框）
     * @param mixed $order 排序
     * @param mixed $comment 备注
     * @return void
     */
    public function editForm_edit(
        $form_id = '0',
        $app_id = '0',
        $menu_id = '0',
        $part_id = '0',
        $form_type = 'search',
        $name = '',
        $code = '',
        $width = '',
        $type = '',
        $order = '',
        $comment = ''
        ) {
        if(IS_POST) {
            
            // 修改表单信息
            $data['name'] = $name;
            $data['width'] = $width;
            $data['type'] = $type;
            $data['order'] = $order;
            $data['comment'] = $comment;
            
            M('Form') -> where("id='%d'", $form_id) -> save($data);
            
            $this -> ajaxReturn(array(
                'statusCode' => 200,
                'message' => '修改成功',
                'navTabId' => 'editForm_index',
                'callbackType' => 'closeCurrent'
                ));
        } else {
            $forms = M('Form') -> where("id='%d'", $form_id) -> select();
            if(!empty($forms)) {
                $this -> assign('form', $forms[0]);
            }
            $this -> assign('form_id', $form_id);
            $this -> assign('app_id', $app_id);
            $this -> assign('menu_id', $menu_id);
            $this -> assign('part_id', $part_id);
            $this -> assign('form_type', $form_type);
            $this -> display();
        }
    }
    
    /**
     * 删除表单字段
     * @param mixed $form_id 控件ID
     * @return void
     */
    public function editForm_remove(
        $form_id = '0'
        ) {
        if(IS_POST){
            M('Form') -> where("id='%d'", $form_id) -> delete();
            $this -> ajaxReturn(array(
                'statusCode' => 200,
                'message' => '删除成功',
                'navTabId' => 'editForm_index'
                ));
        }
    }
}
