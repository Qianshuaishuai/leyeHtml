<?php

namespace app\home\validate; class Recharge extends Base { protected $rule = [ 'credit2|提现金额' => 'require' ]; }