<?php if (!defined('THINK_PATH')) exit();?>﻿<div class="pageContent">
    <form method="post" action="/YDesigner/index.php/Design/editEvent/app_id/1/node_id/6?_=1452072461395" class="pageForm required-validate" onsubmit="return validateCallback(this, nodeAjaxDone);">
        <div class="pageFormContent" layouth="56">
            <input type="hidden" name="app_id" value="<?php echo ($app_id); ?>" />
            <input type="hidden" name="node_id" value="<?php echo ($node_id); ?>" />
            <p>
                <label>动作模板：</label>
                <select name="url" class="required combox">
                    <option value="" <?php if($node['url'] == null): ?>selected<?php endif; ?>>请选择</option>
                    <option value="<?php echo U('Template/Index/index').$para;?>" <?php if($node['url'] == U('Template/Index/index').$para): ?>selected<?php endif; ?>>增删改查模板</option>
                </select>
            </p>
            <p>
                <label>动作目标：</label>
                <select name="target" class="required combox">
                    <option value="" <?php if($node['target'] == null): ?>selected<?php endif; ?>>请选择</option>
                    <option value="navTab" <?php if($node['target'] == 'navTab'): ?>selected<?php endif; ?>>标签页中打开</option>
                    <option value="dialog" <?php if($node['target'] == 'dialog'): ?>selected<?php endif; ?>>对话框中打开</option>
                </select>
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