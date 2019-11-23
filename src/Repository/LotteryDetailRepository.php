<?php
/**
 * User: isliang
 * Date: 2019-11-23
 * Time: 18:28
 * Email: yesuhuangsi@163.com
 **/

namespace ILottery\Repository;

use ILottery\Dao\LotteryDetailDao;
use Isf\Repository\BaseRepository;

class LotteryDetailRepository extends BaseRepository
{
    /**
     * @var LotteryDetailDao
     */
    private $lottery_detail_dao;

    protected function initObject()
    {
        $this->lottery_detail_dao = new LotteryDetailDao();
    }

    public function create($code, $params)
    {
        $data = [];
        foreach ($params as $param) {
            if ($param['typenum']) {
                $data[] = [
                    'code' => $code,
                    'type' => $param['type'],
                    'count' => intval($param['typenum']),
                    'money' => intval($param['typemoney']),
                ];
            }
        }
        $this->lottery_detail_dao->insert($data, true);
        return $this->lottery_detail_dao->wait(1,true);
    }
}
