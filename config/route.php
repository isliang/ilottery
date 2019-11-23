<?php
/**
 * User: isliang
 * Date: 2019/10/25
 * Time: 10:19
 * Email: wslhdu@163.com
 **/

$config = [
    [
        'method' => ['GET'],
        'route' => '/api/craw',
        'handler' => 'ILottery\Controller\LotteryController#initCraw',
    ],
    [
        'method' => ['GET'],
        'route' => '/api/craw/daily',
        'handler' => 'ILottery\Controller\LotteryController#dailyCraw',
    ],
    [
        'method' => ['GET'],
        'route' => '/api/check',
        'handler' => 'ILottery\Controller\LotteryController#check',
    ],
];
