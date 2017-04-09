<?php if (!defined('THINK_PATH')) exit();?>﻿<form id="pagerForm" method="post" action="/YDesigner/index.php/Template/editTable_index/app_id/1/menu_id/6.html?_=1452362321299">
    <input type="hidden" name="pageNum" value="<?php echo ($pageNum); ?>" />
    <input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
    <input type="hidden" name="app_id" value="<?php echo ($app_id); ?>" />
    <input type="hidden" name="menu_id" value="<?php echo ($menu_id); ?>" />
</form>

<div class="pageHeader">
    <form onsubmit="return navTabSearch(this);" action="/YDesigner/index.php/Template/editTable_index/app_id/1/menu_id/6.html?_=1452362321299" method="post" rel="pagerForm">
        <div class="searchBar">
            <table class="searchContent">
                <tr>
                    <td>名称：<input type="text" name="keyword" value="<?php echo ($keyword); ?>" />
                    </td>
                </tr>
            </table>
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
            <li><a class="add" href="/YDesigner/index.php/Template/editTable_add?app_id=<?php echo ($app_id); ?>&menu_id=<?php echo ($menu_id); ?>&part_id=<?php echo ($part_id); ?>" target="dialog" title="添加字段" mask="true" height="400"><span>添加</span></a></li>
            <li><a class="edit" href="/YDesigner/index.php/Template/editTable_edit/col_id/{sid}?app_id=<?php echo ($app_id); ?>&menu_id=<?php echo ($menu_id); ?>&part_id=<?php echo ($part_id); ?>" target="dialog" title="修改字段" mask="true" height="400"><span>修改</span></a></li>
            <li><a class="delete" href="/YDesigner/index.php/Template/editTable_remove/col_id/{sid}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
        </ul>
    </div>
    <table class="table" width="100%" layouth="138">
        <thead>
            <tr>
                <th width="60">编号</th>
                <th width="120">名称</th>
                <th width="100">代码</th>
                <th width="80">宽度</th>
                <th width="100">类型</th>
                <th width="80">字符串长度</th>
                <th width="60">排序</th>
                <th>备注</th>
            </tr>
        </thead>
        <tbody>
            <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr target="sid" rel="<?php echo ($vo["id"]); ?>">
                    <td><?php echo ($vo["id"]); ?></td>
                    <td><?php echo ($vo["name"]); ?></td>
                    <td><?php echo ($vo["code"]); ?></td>
                    <td><?php echo ($vo["width"]); ?></td>
                    <td>
                        <?php switch($vo["type"]): case "01": ?>整数<?php break;?>
                            <?php case "02": ?>限制长度字符串<?php break; endswitch;?>
                    </td>
                    <td><?php echo ($vo["size"]); ?></td>
                    <td><?php echo ($vo["order"]); ?></td>
                    <td><?php echo ($vo["comment"]); ?></td>
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