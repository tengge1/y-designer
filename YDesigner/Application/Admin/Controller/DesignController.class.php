<?php

namespace Admin\Controller;

use Think\Controller;

/**
 * 设计控制器
 */
class DesignController extends Controller {
    
    /**
     * 应用设计页面
     * @param mixed $app_id 应用ID
     */
    public function index(
        $app_id = 0
        ){
        
        //获取当前应用信息
        $apps = M('App') -> where("id='%d' and user_id='%s'", $app_id, session('user_id')) -> select();
        if(empty($apps)) {
            echo '<script>alert("该应用不存在！");window.close();</script>';
            return;
        }
        $app = $apps[0];
        
        //获取应用菜单信息
        $menu_root_id = $app['menu_root_id'];
        if($menu_root_id == null) {
            // 插入第一个菜单数据
            $menu_root_id = M('Menu') -> add(array(
                'app_id' => $app_id,
                'pid' => 0,
                'name' => $app['name'] . '菜单',
                'code' => 'cd',
                'order' => 1,
                'status' => 1
                ));
            M('Menu') -> add(array(
                'app_id' => $app_id,
                'pid' => $menu_root_id,
                'name' => '基础数据维护',
                'code' => 'jcsjwh',
                'order' => 1,
                'status' => 1
                ));
            
            //将menu_root_id写入应用信息表
            M('App') -> where("id='%s'", $app_id) -> save(array(
                'menu_root_id' => $menu_root_id
                ));
        }
        $apps = M('App') -> where("id='%d'", $app_id) -> select();
        $app = $apps[0];
        $menu_root_id = $app['menu_root_id'];
        $menus = M('Menu') -> where("id<>'%s'", $menu_root_id) -> select();
        $menu_data = generateTree($menus, $menu_root_id, 'id', 'pid', 'child');
        
        //为页面赋值
        $this -> assign('app', $app);
        $this -> assign('menu_data', $menu_data);
        $this -> display();
    }
    
    /**
     * 生成应用主菜单
     * @param mixed $app_id 应用主菜单
     */
    public function mainMenu(
        $app_id = 0
        ) {
        $apps = M('App') -> where("id='%d' and user_id='%s'", $app_id, session('user_id')) -> select();
        $app = $apps[0];
        $menu_root_id = $app['menu_root_id'];
        $menus = M('Menu') -> where("id<>'%s' and app_id='%s'", $menu_root_id, $app_id) -> select();
        $menu_data = generateTree($menus, $menu_root_id, 'id', 'pid', 'child');
        
        //为页面赋值
        $this -> assign('app', $app);
        $this -> assign('menu_data', $menu_data);
        $this -> display();
    }
    
    /**
     * 为应用菜单添加一个根节点
     * @param mixed $app_id 应用ID
     * @param mixed $name 节点名称
     * @param mixed $code 节点代码
     * @param mixed $order 节点排序
     * @param mixed $comment 节点备注
     */
    public function addRootNode(
        $app_id = 0,
        $name = '',
        $code = '',
        $order = '',
        $comment = ''
        ) {
        if(IS_POST) {
            $apps = M('App') -> where("id='%d' and user_id='%s' ", $app_id, session('user_id')) -> select();
            if(empty($apps)) {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '该应用不存在'
                    ));
                return;
            }
            $app = $apps[0];
            $menu_root_id = $app['menu_root_id'];
            $menus = M('Menu') -> where("code='%s' and app_id='%s'", $code, $app_id) -> select();
            if(!empty($menus)) {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '该节点代码已经存在'
                    ));                
                return;
            }
            
            M('Menu') -> add(array(
                'app_id' => $app_id,
                'pid' => $menu_root_id,
                'name' => $name,
                'code' => $code,
                'order' => $order,
                'status' => 1,
                'comment' => $comment
                ));
            $this -> ajaxReturn(array(
                'statusCode' => 200,
                'message' => '添加根节点成功',
                'panelId' => 'main-menu',
                'forwardUrl' => U('mainMenu'),
                'callbackType' => 'closeCurrent'
                ));
        } else {
            $this -> assign('app_id', $app_id);
            $this -> display();
        }
    }
    
    /**
     * 添加子节点
     * @param mixed $app_id 应用ID
     * @param mixed $node_id 父节点ID
     * @param mixed $name 节点名称
     * @param mixed $code 节点代码
     * @param mixed $order 节点排序
     * @param mixed $comment 节点备注
     * @return void
     */
    public function addSubNode(
        $app_id = 0,
        $node_id = 0,
        $name = '',
        $code = '',
        $order = '',
        $comment = ''
        ) {
        if(IS_POST) {
            $apps = M('App') -> where("id='%d' and user_id='%s'", $app_id, session('user_id')) -> select();
            if(empty($apps)) {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '该应用不存在'
                    ));
                return;
            }
            $menus = M('Menu') -> where("code='%s' and app_id='%s'", $code, $app_id) -> select();
            if(!empty($menus)) {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '该节点代码已经存在'
                    ));                
                return;
            }
            
            M('Menu') -> add(array(
                'app_id' => $app_id,
                'pid' => $node_id,
                'name' => $name,
                'code' => $code,
                'order' => $order,
                'status' => 1,
                'comment' => $comment
                ));
            $this -> ajaxReturn(array(
                'statusCode' => 200,
                'message' => '添加子节点成功',
                'panelId' => 'main-menu',
                'forwardUrl' => U('mainMenu'),
                'callbackType' => 'closeCurrent'
                ));
        } else {
            $this -> assign('app_id', $app_id);
            $this -> assign('node_id', $node_id);
            $this -> display();
        }
    }
    
    /**
     * 编辑节点
     * @param mixed $app_id 应用ID
     * @param mixed $node_id 节点ID
     * @param mixed $name 节点名称
     * @param mixed $order 节点顺序
     * @param mixed $comment 节点备注
     * @return void
     */
    public function editNode(
        $app_id = 0,
        $node_id = 0,
        $name = '',
        $order = '',
        $comment = ''
        ) {
        if(IS_POST) {
            $apps = M('App') -> where("id='%d' and user_id='%s'", $app_id, session('user_id')) -> select();
            if(empty($apps)) {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '该应用不存在'
                    ));
                return;
            }
            
            M('Menu') -> where("id='%s'", $node_id) -> save(array(
                'name' => $name,
                'order' => $order,
                'comment' => $comment
                ));
            $this -> ajaxReturn(array(
                'statusCode' => 200,
                'message' => '编辑节点成功',
                'panelId' => 'main-menu',
                'forwardUrl' => U('mainMenu'),
                'callbackType' => 'closeCurrent'
                ));
        } else {
            $apps = M('App') -> where("id='%s'", $app_id) -> select();
            if(empty($apps)) {
                $this -> display();
                return;
            }
            $nodes = M('Menu') -> where("id='%s'", $node_id) -> select();
            if(empty($nodes)) {
                $this -> display();
                return;
            }
            $this -> assign('node', $nodes[0]);
            
            $this -> assign('app_id', $app_id);
            $this -> assign('node_id', $node_id);
            $this -> display();
        }
    }
    
    /**
     * 删除节点
     * @param mixed $app_id 应用ID
     * @param mixed $node_id 节点ID
     * @return void
     */
    public function deleteNode(
        $app_id = 0,
        $node_id = 0
        ) {
        $apps = M('App') -> where("id='%d' and user_id='%s'", $app_id, session('user_id')) -> select();
        if(empty($apps)) {
            $this -> ajaxReturn(array(
                'statusCode' => 300,
                'message' => '该应用不存在'
                ));
            return;
        }
        $menus = M('Menu') -> where("id='%s' and app_id='%s'", $node_id, $app_id) -> select();
        if(empty($menus)) {
            $this -> ajaxReturn(array(
                'statusCode' => 300,
                'message' => '该节点不存在'
                ));
            return;
        }        
        if($menus[0]['code'] == 'jcsj') {
            $this -> ajaxReturn(array(
                'statusCode' => 300,
                'message' => '无法删除该节点'
                ));
            return;            
        }
        
        M('Menu') -> where("id='%s'", $node_id) -> delete();
        $this -> ajaxReturn(array(
            'statusCode' => 200,
            'message' => '删除节点成功'
            ));        
    }
    
    /**
     * 编辑节点事件
     * @param mixed $app_id 应用ID
     * @param mixed $node_id 节点ID
     * @param mixed $url 动作地址
     * @param mixed $target 动作目标
     * @return void
     */
    public function editEvent(
        $app_id = 0,
        $node_id = 0,
        $url = '',
        $target = ''
        ) {
        if(IS_POST) {
            $apps = M('App') -> where("id='%d'", $app_id) -> select();
            if(empty($apps)) {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '该应用不存在'
                    ));
                return;
            }
            
            M('Menu') -> where("id='%s'", $node_id) -> save(array(
                'url' => $url,
                'target' => $target
                ));
            $this -> ajaxReturn(array(
                'statusCode' => 200,
                'message' => '编辑事件成功',
                'panelId' => 'main-menu',
                'forwardUrl' => U('mainMenu'),
                'callbackType' => 'closeCurrent'
                ));
        } else {
            $apps = M('App') -> where("id='%s'", $app_id) -> select();
            if(empty($apps)) {
                $this -> display();
                return;
            }
            $nodes = M('Menu') -> where("id='%s'", $node_id) -> select();
            if(empty($nodes)) {
                $this -> display();
                return;
            }
            $this -> assign('node', $nodes[0]);
            
            $this -> assign('app_id', $app_id);
            $this -> assign('node_id', $node_id);
            $this -> assign('para', '?app_id=' . $app_id . '&menu_id=' . $node_id);
            $this -> display();
        }
    }
}
