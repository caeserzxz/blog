<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

//密码加密
function encryption_password($password){
   $str1 = 'CfDJ8MT8YplnO69Osy-ATi9suh8BYvVs-sA4W3QrOKnr3x_t9t6CUYwLkpSF79uXUVQxMKiA4rucRKJLWSz4b';
   $str2 = 'NFRsqQri6P-WmHPokluGGwbvd3MQ6PCEOpLQHea8F4tQNl3k5lhSwH6KIt1iEdd4l-3lDo';
   $text = md5(md5($str1.$password.$str2));
   return $text;
}