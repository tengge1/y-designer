<?php if (!defined('THINK_PATH')) exit();?>﻿<div class="pageContent">
    <form method="post" action="/YDesigner/index.php/Design/addSubNode/app_id/19/node_id/44?_=1452067046658" class="pageForm required-validate" onsubmit="return validateCallback(this, nodeAjaxDone);">
        <div class="pageFormContent" layouth="56">
            <input type="hidden" name="app_id" value="<?php echo ($app_id); ?>" />
            <input type="hidden" name="node_id" value="<?php echo ($node_id); ?>" />
            <p>
                <label>节点名称：</label>
                <input name="name" class="required" type="text" size="30" value="" autocomplete="off" />
            </p>
            <p>
                <label>节点代码：</label>
                <input name="code" class="required" type="text" size="30" value="" autocomplete="off" />
            </p>
            <p>
                <label>排序：</label>
                <input name="order" class="required" type="text" size="30" value="" autocomplete="off" />
            </p>
            <p>
                <label>备注：</label>
                <input name="comment" type="text" size="30" value="" autocomplete="off" />
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