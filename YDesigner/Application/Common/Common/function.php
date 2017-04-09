<?php

/**
 * 使用get方法获取内容
 * @param mixed $url 网址
 * @return mixed 内容
 */
function curl_get($url) {
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    
    $output = curl_exec($ch);
    curl_close($ch);
    
    return $output;
}

/**
 * 使用post方法获取内容
 * @param mixed $url 网址
 * @param mixed $data 数据
 * @return mixed 内容
 */
function curl_post($url, $data = array()) {
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    
    $output = curl_exec($ch);
    curl_close($ch);
    
    return $output;
}

/**
 * 判断数据库中的表是否存在
 * @param mixed $db_name 数据库名称
 * @param mixed $table_name 表名称
 * @return bool 是否存在
 */
function is_table_exist($db_name, $table_name) {
    $query = M() -> query("SELECT * FROM information_schema.`tables` WHERE TABLE_SCHEMA='".$db_name."' AND table_name='".$table_name."'");
    if(empty($query)) {
        return false;
    }
    return true;
}

/**
 * 创建一个储存树形数据的表
 * @param mixed $db_name 数据库名称
 * @param mixed $table_prefix 表名前缀
 * @return bool 是否创建成功
 */
function create_tree_table($db_name, $table_prefix) {
    
    // 创建树形数据结构表
    M() -> execute("CREATE TABLE `" . $db_name . "`.`" . $table_prefix . "_menu` (  
      `id` BIGINT NOT NULL AUTO_INCREMENT COMMENT '编号',
      `pid` BIGINT NOT NULL COMMENT '父节点编号',
      `name` VARCHAR(100) NOT NULL COMMENT '名称',
      `code` VARCHAR(100) NOT NULL COMMENT '代码',
      `url` VARCHAR(300) NOT NULL COMMENT '链接地址',
      `target` VARCHAR(10) NOT NULL COMMENT '链接目标',
      `order` INT COMMENT '排序',
      `status` INT DEFAULT 1 COMMENT '状态（1-可用，0-禁用）',
      `comment` TEXT COMMENT '备注',
      PRIMARY KEY (`id`)
      );");
    
    // 插入第一个菜单数据
    $menu_root_id = M('Menu',$table_prefix . '_') -> add(array(
        'pid' => 0,
        'name' => '应用菜单',
        'order' => 1,
        'status' => 1
        ));
    M('Menu',$table_prefix . '_') -> add(array(
        'pid' => $menu_root_id,
        'name' => '基础数据维护',
        'code' => 'jcsj',
        'order' => 1,
        'status' => 1
        ));
    
    //将menu_root_id写入应用信息表
    M('app') -> where("code='%s'", $table_prefix) -> save(array(
        'menu_root_id' => $menu_root_id
        ));
    
    return true;
}

/**
 * 将数组生成树
 * @param mixed $items 数组
 * @param mixed $root_pid 根节点的父节点
 * @param mixed $id_name ID字段名称
 * @param mixed $pid_name 父节点字段名称
 * @param mixed $child_name 生成树下级键
 * @return array
 */
function generateTree($items = array(), $root_pid = '0', $id_name = 'id', $pid_name = 'pid', $child_name = 'child'){
    $items_temp = array();
    foreach($items as $item) {
        $items_temp[$item['id']] = $item;
    }
    $items = $items_temp;
    unset($items_temp);
    $tree = array();
    foreach($items as $item){
        if(isset($items[$item[$pid_name]])){
            $items[$item[$pid_name]][$child_name][] = &$items[$item[$id_name]];
        }else{
            $tree[] = &$items[$item[$id_name]];
        }
    }
    return $tree;
}

/**
 * 将树形结构数据生成dwz的菜单
 * @param mixed $tree 树形结构数据
 * @param mixed $is_root 是否是根节点
 */
function printDwzTree($tree = array(), $is_root = true) {
    if($is_root) {
        echo '<ul class="tree treeFolder expand">';
    } else {
        echo '<ul>';
    }
    foreach($tree as $item) {
        if(isset($item['child'])) { //有子节点
            echo '<li><a href="'. ($item['url'] == null? 'javascript:void(0)' : $item['url']) . '" target="'.$item['target'].'" rel="' . $item['code'] . '" data-id="' . $item['id'] . '">'.$item['name'].'</a>';
            printDwzTree($item['child'], false);
            echo '</li>';
        } else { //没有子节点
            echo '<li><a href="'. ($item['url'] == null? 'javascript:void(0)' : $item['url']) . '" target="'.$item['target'].'" rel="' . $item['code'] . '" data-id="' . $item['id'] . '">'.$item['name'].'</a>';
            echo '</li>';
        }
    }
    echo '</ul>';
}

/**
 * 判断是否是手机访问网站
 * @return bool
 */
function isMobile(){    
    $useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';    
    $useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';      
    function CheckSubstrs($substrs,$text){    
        foreach($substrs as $substr)    
            if(false!==strpos($text,$substr)){    
                return true;    
            }    
        return false;    
    }  
    $mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');  
    $mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');    
    
    $found_mobile=CheckSubstrs($mobile_os_list,$useragent_commentsblock) ||    
              CheckSubstrs($mobile_token_list,$useragent);    
    
    if ($found_mobile){    
        return true;    
    }else{    
        return false;    
    }    
}
