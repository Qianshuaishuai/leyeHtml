<?php

namespace app\home\validate; use think\Validate; class Base extends Validate { protected function checkUserName($username){ if(check_mobile($username)){ return '用户名不能是手机号'; } return true; } protected function checkMobile($mobile){ if(!check_mobile($mobile)){ return '手机号格式错误'; } return true; } }