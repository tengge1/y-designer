<?php if (!defined('THINK_PATH')) exit();?>﻿<div class="pageContent">
    <form method="post" action="/YDesigner/index.php/Index/password.html?_=1491719764444" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
        <div class="pageFormContent" layouth="56">
            <p>
                <label>原密码：</label>
                <input name="password_old" class="required" type="password" size="30" value="" autocomplete="off" />
            </p>
            <p>
                <label>新密码：</label>
                <input name="password_new" class="required" type="password" size="30" value="" autocomplete="off" />
            </p>
            <p>
                <label>确认密码：</label>
                <input name="password_confirm" class="required" type="password" size="30" value="" autocomplete="off" />
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