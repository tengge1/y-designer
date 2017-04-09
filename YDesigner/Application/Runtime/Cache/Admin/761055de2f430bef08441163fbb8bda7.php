<?php if (!defined('THINK_PATH')) exit();?>﻿<div class="pageContent">
    <form method="post" action="/YDesigner/index.php/Article/edit/id/16?_=1491719783724" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
        <div class="pageFormContent" layouth="56">
            <input type="hidden" name="id" value="<?php echo ($article["id"]); ?>" />
            <dl class="nowrap">
				<dt>文章分类：</dt>
                <dd>
                    <select name="category" class="required combox">
                        <option value="01" <?php if($article["category"] == '01'): ?>selected<?php endif; ?>>使用说明</option>
                        <option value="02" <?php if($article["category"] == '02'): ?>selected<?php endif; ?>>版本更新</option>
                        <option value="03" <?php if($article["category"] == '03'): ?>selected<?php endif; ?>>其他</option>
                    </select>
                </dd>
                
			</dl>
            <dl class="nowrap">
				<dt>文章标题：</dt>
                <dd>
                    <input name="title" class="required" type="text" value="<?php echo ($article["title"]); ?>" autocomplete="off" style="width:800px;" />
                </dd>
			</dl>
            <dl class="nowrap">
				<dt>文章内容：</dt>
				<dd>
                    <textarea class="editor" name="content" rows="30" cols="100" 
                        upLinkUrl="/YDesigner/Public/Admin/php/xheditor_upload.php" upLinkExt="zip,rar,txt" 
                        upImgUrl="/YDesigner/Public/Admin/php/xheditor_upload.php" upImgExt="jpg,jpeg,gif,png" 
                        upFlashUrl="/YDesigner/Public/Admin/php/xheditor_upload.php" upFlashExt="swf"
                        upMediaUrl="/YDesigner/Public/Admin/php/xheditor_upload.php" upMediaExt:"avi"><?php echo ($article["content"]); ?></textarea>
				</dd>
			</dl>
			<dl class="nowrap">
				<dt>备注：</dt>
				<dd><textarea name="comment" cols="130" rows="5"><?php echo ($article["comment"]); ?></textarea></dd>
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