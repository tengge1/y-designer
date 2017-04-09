<?php if (!defined('THINK_PATH')) exit();?>﻿<div class="pageContent">
    <form method="post" action="/YDesigner/index.php/Template/editTable_add?app_id=1&amp;menu_id=6&amp;part_id=2&amp;_=1452361000161" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
        <div class="pageFormContent" layouth="56">
            <input type="hidden" name="app_id" value="<?php echo ($app_id); ?>" />
            <input type="hidden" name="menu_id" value="<?php echo ($menu_id); ?>" />
            <input type="hidden" name="part_id" value="<?php echo ($part_id); ?>" />
            <p>
                <label>名称：</label>
                <input name="name" class="required" type="text" autocomplete="off" />
            </p>
            <p>
                <label>代号：</label>
                <input name="code" class="required" type="text" autocomplete="off" />
            </p>
            <p>
                <label>宽度：</label>
                <input name="width" class="required" type="text" value="120" />
            </p>
            <p>
                <label>类型：</label>
                <select name="type" class="required combox">
                    <option value="" selected>请选择</option>
                    <option value="01">整数</option>
                    <option value="02">限制长度字符串</option>
                </select>
            </p>
            <p>
                <label>字符串长度：</label>
                <input name="size" class="required" type="text" value="100" />
            </p>
            <p>
                <label>排序：</label>
                <input name="order" class="required" type="text" autocomplete="off" />
            </p>
            <p>
                <label>备注：</label>
                <input name="comment" class="required" type="text" autocomplete="off" />
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