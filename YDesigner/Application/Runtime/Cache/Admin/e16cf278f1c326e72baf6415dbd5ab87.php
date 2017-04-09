<?php if (!defined('THINK_PATH')) exit();?>﻿<div class="pageContent">
    <form method="post" action="/YDesigner/index.php/Article/add?_=1452092146298" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
        <div class="pageFormContent" layouth="56">
            <dl class="nowrap">
				<dt>文章分类：</dt>
                <dd>
                    <select name="category" class="required combox">
                        <option value="" selected>请选择</option>
                        <option value="01">使用说明</option>
                        <option value="02">版本更新</option>
                        <option value="03">其他</option>
                    </select>
                </dd>
			</dl>
            <dl class="nowrap">
				<dt>文章标题：</dt>
                <dd>
                    <input name="title" class="required" type="text" autocomplete="off" style="width:800px;" />
                </dd>
			</dl>
            <dl class="nowrap">
				<dt>文章内容：</dt>
				<dd>
                    <textarea class="editor" name="content" rows="30" cols="100" 
                        upLinkUrl="/YDesigner/Public/Admin/php/xheditor_upload.php" upLinkExt="zip,rar,txt" 
                        upImgUrl="/YDesigner/Public/Admin/php/xheditor_upload.php" upImgExt="jpg,jpeg,gif,png" 
                        upFlashUrl="/YDesigner/Public/Admin/php/xheditor_upload.php" upFlashExt="swf"
                        upMediaUrl="/YDesigner/Public/Admin/php/xheditor_upload.php" upMediaExt:"avi"></textarea>
				</dd>
			</dl>
			<dl>
				<dt>备注：</dt>
				<dd><textarea name="comment" cols="130" rows="5"></textarea></dd>
			</dl>
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