<?php if (!defined('THINK_PATH')) exit();?>﻿<div class="pageContent">
    <form method="post" action="/YDesigner/index.php/App/edit/app_id/14?_=1452085029730" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
        <input type="hidden" name="app_id" value="<?php echo ($app["id"]); ?>" />
        <div class="pageFormContent" layouth="56">
            <p>
                <label>应用名称：</label>
                <input name="name" class="required" type="text" autocomplete="off" value="<?php echo ($app["name"]); ?>" />
            </p>
            <p>
                <label>应用代号：</label>
                <input name="code" class="required" type="text" value="<?php echo ($app["code"]); ?>" autocomplete="off" disabled />
            </p>
            <p>
                <label>备注：</label>
                <input name="comment" type="text" value="<?php echo ($app["comment"]); ?>" autocomplete="off" />
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