<?php if (!defined('THINK_PATH')) exit();?>﻿<div class="pageContent">
    <form method="post" action="/YDesigner/index.php/Template/editForm_edit/form_id/5?app_id=1&amp;menu_id=6&amp;part_id=4&amp;form_type=edit_form&amp;_=1452362856892" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
        <input type="hidden" name="user_id" value="<?php echo ($user["id"]); ?>" />
        <div class="pageFormContent" layouth="56">
            <input type="hidden" name="form_id" value="<?php echo ($form_id); ?>" />
            <input type="hidden" name="app_id" value="<?php echo ($app_id); ?>" />
            <input type="hidden" name="menu_id" value="<?php echo ($menu_id); ?>" />
            <input type="hidden" name="part_id" value="<?php echo ($part_id); ?>" />
            <input type="hidden" name="form_type" value="<?php echo ($form_type); ?>" />
            <p>
                <label>名称：</label>
                <input name="name" class="required" type="text" value="<?php echo ($form["name"]); ?>" />
            </p>
            <p>
                <label>代号：</label>
                <input name="code" class="required" type="text" value="<?php echo ($form["code"]); ?>" readonly />
            </p>
            <p>
                <label>宽度：</label>
                <input name="width" class="required" type="text" value="<?php echo ($form["width"]); ?>" />
            </p>
            <p>
                <label>类型：</label>
                <select name="type" class="required combox">
                    <option value="01" <?php if($form["type"] == '01'): ?>selected<?php endif; ?>>文本框</option>
                    <option value="02" <?php if($form["type"] == '02'): ?>selected<?php endif; ?>>日期框</option>
                </select>
            </p>
            <p>
                <label>排序：</label>
                <input name="order" class="required" type="text" value="<?php echo ($form["order"]); ?>" />
            </p>
            <p>
                <label>备注：</label>
                <input name="comment" type="text" value="<?php echo ($form["comment"]); ?>" />
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