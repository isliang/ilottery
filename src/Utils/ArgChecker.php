<?php
/**
 * User: isliang
 * Date: 2019/11/4
 * Time: 15:32
 * Email: wslhdu@163.com
 **/

namespace ILottery\Utils;

class ArgChecker
{
    public static function checkNotEmptyParams($params, $keys)
    {
        foreach ($keys as $key) {
            if (empty($params[$key])) {
                return $key;
            }
        }
        return null;
    }

    public static function checkNumber($num)
    {

    }
}
