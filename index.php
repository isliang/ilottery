<?php
/**
 * User: isliang
 * Date: 2019/10/25
 * Time: 11:32
 * Email: wslhdu@163.com
 **/

//设置时区
date_default_timezone_set('Asia/Shanghai');
//错误级别
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED & ~E_USER_NOTICE & ~E_STRICT);

//项目代码目录
define("DS", DIRECTORY_SEPARATOR);
$app_path = __DIR__ . DS . 'src';
define("APP_PATH", $app_path);

if (!defined("CONFIG_PATH")) {
    define("CONFIG_PATH", __DIR__ . DS . 'config');
}
if (!defined("ENABLE_SERVER_COMMAND")) {
    //支持服务端命令 reload shutdown ping
    //为了防止恶意攻击，需要在nginx配置相应的location，拒绝外部访问这些uri
    define("ENABLE_SERVER_COMMAND", true);
}

//加载autoload
require_once $app_path . DS . ".." . DS . "vendor" . DS . "autoload.php";

$setting = [
    'package_max_length' => 1024 * 1024 * 20,
    'daemonize' => 1,//守护进程化
    'reactor_num' => swoole_cpu_num() * 4,
    'worker_num' => swoole_cpu_num() * 4,
];
$server = new \Isf\Server\HttpServer('127.0.0.1', 9608, $setting);
$server->start();
