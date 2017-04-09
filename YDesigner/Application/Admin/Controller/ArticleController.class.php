<?php

namespace Admin\Controller;

use Think\Controller;

/**
 * 文章控制器
 */
class ArticleController extends Controller {
    
    /**
     * 文章列表页面
     * @param mixed $pageNum 第几页
     * @param mixed $numPerPage 每页数量
     * @param mixed $keyword 关键词
     */
    public function index(
        $pageNum = 1,
        $numPerPage = 100,
        $keyword = ''
        ){
        
        //进行查询
        $where['title'] = array('LIKE','%'.$keyword.'%');
        $where['user_id'] = session('user_id');
        $total = M('Article') -> where($where) -> count();
        $list = M('Article') 
            -> join('left join yd_user on yd_user.id=yd_article.user_id')
            -> where($where) 
            -> field('yd_article.id,yd_article.category,yd_article.title,yd_user.name user_name,yd_article.time,yd_article.comment')
            -> order("yd_article.id desc") 
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
     * 新增文章
     * @param mixed $category 分类名称
     * @param mixed $title 文章标题
     * @param mixed $content 文章内容
     * @param mixed $comment 文章备注
     */
    public function add(
        $category = '',
        $title = '',
        $content = '',
        $comment = ''
        ){
        if(IS_POST) { //POST操作
            $Article = M('Article');
            if(!$Article -> create()){ //创建文章失败
                $this -> ajaxReturn(array(
                    'statusCode' => '300',
                    'message' => $Article -> getError()
                    ));
            } else { //创建文章成功
                $Article -> user_id = session('user_id');
                $Article -> time = time();
                $Article -> add();
                $this -> ajaxReturn(array(
                    'statusCode' => 200,
                    'message' => '添加成功',
                    'navTabId' => 'yd_article',
                    'callbackType' => 'closeCurrent'
                    ));
            }
        } else { //GET操作
            $this -> display();
        }
    }
    
    /**
     * 编辑文章界面
     * @param mixed $id 文章ID
     * @param mixed $category 分类名称
     * @param mixed $title 文章标题
     * @param mixed $content 文章内容
     * @param mixed $comment 文章备注
     */
    public function edit(
        $id = '0',
        $category = '',
        $title = '',
        $content = '',
        $comment = ''
        ){
        if(IS_POST) {
            
            if(C('DEMO') == true) {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '演示版本不允许修改文章'
                    ));                
                return;
            }
            
            $articles = M('Article') -> where("id='%d' and user_id='%d'", $id, session('user_id')) -> select();
            if(empty($articles)) {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '该文章不存在'
                    ));
                return;
            }
            $Article = M('Article');
            $Article -> create();
            $Article -> save();
            $this -> ajaxReturn(array(
                'statusCode' => 200,
                'message' => '修改成功',
                'navTabId' => 'yd_article',
                'callbackType' => 'closeCurrent'
                )); 
        } else {
            $articles = M('Article') -> where("id='%d' and user_id='%d'", $id, session('user_id')) -> select();
            if(!empty($articles)) {
                $this -> assign('article', $articles[0]);
            }
            $this -> display();
        }
    }
    
    /**
     * 删除文章功能
     * @param mixed $id 文章ID
     */
    public function remove(
        $id = '0'
        ){
        if(IS_POST){
            
            if(C('DEMO') == true) {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '演示版本不允许删除文章'
                    ));                
                return;
            }
            
            $articles = M('Article') -> where("id='%d' and user_id='%d'", $id, session('user_id')) -> select();
            if(empty($articles)) {
                $this -> ajaxReturn(array(
                    'statusCode' => 300,
                    'message' => '该文章不存在'
                    ));
                return;
            }
            M('Article') -> where("id='%d'", $id) -> delete();
            $this -> ajaxReturn(array(
                'statusCode' => 200,
                'message' => '删除成功',
                'navTabId' => 'yd_article'
                ));
        }
    } 
}
