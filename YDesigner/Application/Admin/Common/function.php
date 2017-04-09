<?php
/**
 * 对变量进行 JSON 编码
 * @param mixed value 待编码的 value ，除了resource 类型之外，可以为任何数据类型，该函数只能接受 UTF-8 编码的数据
 * @return string 返回 value 值的 JSON 形式
 */
function json_encode_ex($value)
{
    if (version_compare(PHP_VERSION,'5.4.0','<'))
    {
        $str = json_encode($value);
        $str = preg_replace_callback(
            "#\\\u([0-9a-f]{4})#i",
            function($matchs)
            {
                    return iconv('UCS-2BE', 'UTF-8', pack('H4', $matchs[1]));
            },
            $str);
        return $str;
    }
    else
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
