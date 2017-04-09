<?php if (!defined('THINK_PATH')) exit();?>﻿<div class="pageContent">
    <form method="post" action="/YDesigner/index.php/App/add?_=1452061533277" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
        <div class="pageFormContent" layouth="56">
            <p>
                <label>应用名称：</label>
                <input name="name" class="required" type="text" autocomplete="off" />
            </p>
            <p style="width:400px;">
                <label>应用代号：</label>
                <input name="code" class="required" type="text" autocomplete="off" />
                <span class="info">2到5个字母，不重复</span>
            </p>
            <p>
                <label>备注：</label>
                <input name="comment" type="text" autocomplete="off" />
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