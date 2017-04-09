<?php if (!defined('THINK_PATH')) exit();?>﻿<div class="pageContent">
    <form method="post" action="/YDesigner/index.php/Template/add?app_id=1&amp;menu_id=6&amp;_=1452362575871" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
        <div class="pageFormContent" layouth="56">
            <?php if(is_array($add_forms)): $i = 0; $__LIST__ = $add_forms;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><p>
                    <label><?php echo ($vo["name"]); ?>：</label>
                    <input name="<?php echo ($vo["code"]); ?>" class="required" type="text" autocomplete="off" />
                </p><?php endforeach; endif; else: echo "" ;endif; ?>
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