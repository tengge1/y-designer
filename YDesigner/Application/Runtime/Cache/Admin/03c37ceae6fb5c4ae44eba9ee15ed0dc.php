<?php if (!defined('THINK_PATH')) exit();?>﻿<form id="pagerForm" method="post" action="/YDesigner/index.php/Template/index.html?app_id=1&amp;menu_id=6&amp;_=1491719941965">
    <input type="hidden" name="pageNum" value="<?php echo ($pageNum); ?>" />
    <input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
    <input type="hidden" name="app_id" value="<?php echo ($app_id); ?>" />
    <input type="hidden" name="menu_id" value="<?php echo ($menu_id); ?>" />
</form>

<div class="pageHeader">
    <form onsubmit="return navTabSearch(this);" action="/YDesigner/index.php/Template/index.html?app_id=1&amp;menu_id=6&amp;_=1491719941965" method="post" rel="pagerForm">
        <div class="searchBar">
            <ul class="searchContent">
                <?php if(is_array($searches)): $i = 0; $__LIST__ = $searches;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo_search): $mod = ($i % 2 );++$i;?><li>
                        <?php echo ($vo_search["name"]); ?>：<input type="text" name="<?php echo ($vo_search["code"]); ?>" value="" />
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <div class="subBar">
                <ul>
                    <li>
                        <div class="buttonActive">
                            <div class="buttonContent">
                                <button type="submit">检索</button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </form>
</div>
<div class="pageContent">
    <div class="panelBar">
        <ul class="toolBar">
            <li><a class="add" href="/YDesigner/index.php/Template/add?app_id=<?php echo ($app_id); ?>&menu_id=<?php echo ($menu_id); ?>" target="dialog" title="添加" mask="true"><span>添加</span></a></li>
            <li><a class="edit" href="/YDesigner/index.php/Template/edit?app_id=<?php echo ($app_id); ?>&menu_id=<?php echo ($menu_id); ?>" target="dialog" title="修改" mask="true"><span>修改</span></a></li>
            <li><a class="delete" href="/YDesigner/index.php/Template/remove/user_id/{sid}?app_id=<?php echo ($app_id); ?>&menu_id=<?php echo ($menu_id); ?>" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
        </ul>
    </div>
    <table class="table" width="100%" layouth="138">
        <thead>
            <tr>
                <?php if(is_array($mains)): $i = 0; $__LIST__ = $mains;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo_main): $mod = ($i % 2 );++$i;?><th <?php if($i != count($mains)): ?>width="<?php echo ($vo_main["width"]); ?>"<?php endif; ?>><?php echo ($vo_main["name"]); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr target="sid" rel="<?php echo ($vo["id"]); ?>">

                </tr><?php endforeach; endif; ?>
        </tbody>
    </table>
    <div class="panelBar">
        <div class="pages">
            <span>显示</span>
            <select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
                <option value="20" <?php if(($numPerPage) == "20"): ?>selected<?php endif; ?>>20</option>
                <option value="50" <?php if(($numPerPage) == "50"): ?>selected<?php endif; ?>>50</option>
                <option value="100" <?php if(($numPerPage) == "100"): ?>selected<?php endif; ?>>100</option>
                <option value="200" <?php if(($numPerPage) == "200"): ?>selected<?php endif; ?>>200</option>
            </select>
            <span>条，共<?php echo ($total); ?>条</span>
        </div>
        <div class="pagination" targettype="navTab" totalcount="<?php echo ($total); ?>" numperpage="<?php echo ($numPerPage); ?>" pagenumshown="10" currentpage="<?php echo ($pageNum); ?>"></div>
    </div>
</div>

<script>
    function bindCRUDContextMenu() { //为模板添加右键菜单
        $(".pageHeader,.pageContent").contextMenu('crudCM', {
            bindings: {
                editMain: function (r) { //修改表格字段
                    navTab.openTab('editTable_index', "<?php echo U('editTable_index',array('app_id'=>$app_id,'menu_id'=>$menu_id));?>", {
                        title: '修改表格字段'
                    });
                },
                editSearch: function (r) { //修改查询表单
                    navTab.openTab('editForm_index', "<?php echo U('editForm_index',array('app_id'=>$app_id,'menu_id'=>$menu_id,'form_type'=>'search'));?>", {
                        title: '修改查询表单'
                    });
                },
                editAddForm: function (r) { //修改新增表单
                    navTab.openTab('editForm_index', "<?php echo U('editForm_index',array('app_id'=>$app_id,'menu_id'=>$menu_id,'form_type'=>'add_form'));?>", {
                        title: '修改新增表单'
                    });
                },
                editEditForm: function (r) { //修改编辑表单
                    navTab.openTab('editForm_index', "<?php echo U('editForm_index',array('app_id'=>$app_id,'menu_id'=>$menu_id,'form_type'=>'edit_form'));?>", {
                        title: '修改编辑表单'
                    });
                }
            }
        });
    }
    $(function () {
        bindCRUDContextMenu();
    });
</script>