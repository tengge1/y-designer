<?php if (!defined('THINK_PATH')) exit();?>﻿<form id="pagerForm" method="post" action="/YDesigner/index.php/App/index.html?_=1491719831541">
    <input type="hidden" name="pageNum" value="<?php echo ($pageNum); ?>" />
    <input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
</form>

<div class="pageHeader">
    <form onsubmit="return navTabSearch(this);" action="/YDesigner/index.php/App/index.html?_=1491719831541" method="post" rel="pagerForm">
        <div class="searchBar">
            <table class="searchContent">
                <tr>
                    <td>应用名称：<input type="text" name="keyword" value="<?php echo ($keyword); ?>" />
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
            <li><a class="add" href="/YDesigner/index.php/App/add" target="dialog" title="添加应用" mask="true"><span>添加</span></a></li>
            <li><a class="edit" href="/YDesigner/index.php/App/edit/app_id/{sid}" target="dialog" title="修改应用" mask="true"><span>修改</span></a></li>
            <li><a class="delete" href="/YDesigner/index.php/App/remove/app_id/{sid}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
        </ul>
    </div>
    <table class="table" width="100%" layouth="138">
        <thead>
            <tr>
                <th width="60">编号</th>
                <th width="80">操作</th>
                <th width="120">应用名称</th>
                <th width="100">应用代号</th>
                <th width="100">创建人</th>
                <th width="100">创建日期</th>
                <th>备注</th>
            </tr>
        </thead>
        <tbody>
            <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr target="sid" rel="<?php echo ($vo["id"]); ?>">
                    <td><?php echo ($vo["id"]); ?></td>
                    <td>
                        <a href="/YDesigner/index.php/App/design/app_id/<?php echo ($vo["id"]); ?>" target="_blank"><span style="color:blue;">设计</span></a>
                        <a href="javascript:void(0)" onclick="alert('该功能暂未实现');"><span style="color:blue;">演示</span></a>
                    </td>
                    <td><?php echo ($vo["name"]); ?></td>
                    <td><?php echo ($vo["code"]); ?></td>
                    <td><?php echo ($vo["user_name"]); ?></td>
                    <td><?php echo (date('Y-m-d',$vo["create_time"])); ?></td>
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