<?php if (!defined('THINK_PATH')) exit();?>﻿<div class="pageContent">
    <form method="post" action="/YDesigner/index.php/User/edit/user_id/3?_=1452084936425" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
        <input type="hidden" name="user_id" value="<?php echo ($user["id"]); ?>" />
        <div class="pageFormContent" layouth="56">
            <p>
                <label>用户名：</label>
                <input name="username" class="required" type="text" autocomplete="off" value="<?php echo ($user["username"]); ?>" disabled />
            </p>
            <p>
                <label>姓名：</label>
                <input name="name" class="required" type="text" value="<?php echo ($user["name"]); ?>" autocomplete="off" />
            </p>
            <p>
                <label>手机：</label>
                <input name="phone" class="required" type="text" value="<?php echo ($user["phone"]); ?>" autocomplete="off" />
            </p>
            <p>
                <label>类型：</label>
                <select name="type" class="required combox">
                    <option value="01" <?php if(($user["type"]) == "01"): ?>selected<?php endif; ?>>管理员</option>
                    <option value="02" <?php if(($user["type"]) == "02"): ?>selected<?php endif; ?>>设计师</option>
                    <option value="03" <?php if(($user["type"]) == "03"): ?>selected<?php endif; ?>>测试用户</option>
                </select>
            </p>
            <p>
                <label>备注：</label>
                <input name="comment" type="text" value="<?php echo ($user["comment"]); ?>" autocomplete="off" />
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