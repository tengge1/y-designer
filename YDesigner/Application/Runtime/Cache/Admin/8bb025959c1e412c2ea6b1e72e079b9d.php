<?php if (!defined('THINK_PATH')) exit();?>﻿<div class="pageContent">
    <form method="post" action="/YDesigner/index.php/Design/editNode/app_id/1/node_id/2?_=1450007920130" class="pageForm required-validate" onsubmit="return validateCallback(this, nodeAjaxDone);">
        <div class="pageFormContent" layouth="56">
            <input type="hidden" name="app_id" value="<?php echo ($app_id); ?>" />
            <input type="hidden" name="node_id" value="<?php echo ($node_id); ?>" />
            <p>
                <label>节点名称：</label>
                <input name="name" class="required" type="text" size="30" value="<?php echo ($node["name"]); ?>" autocomplete="off" />
            </p>
            <p>
                <label>排序：</label>
                <input name="order" class="required" type="text" size="30" value="<?php echo ($node["order"]); ?>" autocomplete="off" />
            </p>
            <p>
                <label>备注：</label>
                <input name="comment" type="text" size="30" value="<?php echo ($node["comment"]); ?>" autocomplete="off" />
            </p>
        </div>
        <div class="formBar">
            <ul>
                <li>
                    <div class="buttonActive">
                        <div class="buttonContent">
                            <button type="submit">保存</button>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="button">
                        <div class="buttonContent">
                            <button type="button" class="close">取消</button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </form>
</div>