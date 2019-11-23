<?php
/**
 * User: isliang
 * Date: 2019/10/25
 * Time: 11:38
 * Email: wslhdu@163.com
 **/

namespace ILottery\Constant;

class CodeConst
{
    const CODE_SUCCESS = 200;
    const CODE_FAIL = 10000;

    public static $msg = [
        self::CODE_SUCCESS => 'success',
        self::CODE_FAIL => 'fail',
    ];
}
