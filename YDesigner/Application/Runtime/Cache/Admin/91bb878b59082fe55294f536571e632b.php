<?php if (!defined('THINK_PATH')) exit();?>﻿<div class="pageContent">
    <form method="post" action="/YDesigner/index.php/Template/editTable_edit/col_id/1?app_id=1&amp;menu_id=6&amp;part_id=1&amp;_=1452094761150" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
        <input type="hidden" name="user_id" value="<?php echo ($user["id"]); ?>" />
        <div class="pageFormContent" layouth="56">
            <input type="hidden" name="col_id" value="<?php echo ($col_id); ?>" />
            <input type="hidden" name="app_id" value="<?php echo ($app_id); ?>" />
            <input type="hidden" name="menu_id" value="<?php echo ($menu_id); ?>" />
            <input type="hidden" name="part_id" value="<?php echo ($part_id); ?>" />
            <p>
                <label>名称：</label>
                <input name="name" class="required" type="text" value="<?php echo ($col["name"]); ?>" />
            </p>
            <p>
                <label>代号：</label>
                <input name="code" class="required" type="text" value="<?php echo ($col["code"]); ?>" readonly />
            </p>
            <p>
                <label>宽度：</label>
                <input name="width" class="required" type="text" value="<?php echo ($col["width"]); ?>" />
            </p>
            <p>
                <label>类型：</label>
                <select name="type" class="required combox">
                    <option value="01" <?php if($col["type"] == '01'): ?>selected<?php endif; ?>>整数</option>
                    <option value="02" <?php if($col["type"] == '02'): ?>selected<?php endif; ?>>限制长度字符串</option>
                </select>
            </p>
            <p>
                <label>字符串长度：</label>
                <input name="size" class="required" type="text" value="<?php echo ($col["size"]); ?>" />
            </p>
            <p>
                <label>排序：</label>
                <input name="order" class="required" type="text" value="<?php echo ($col["order"]); ?>" />
            </p>
            <p>
                <label>备注：</label>
                <input name="comment" class="required" type="text" value="<?php echo ($col["comment"]); ?>" />
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