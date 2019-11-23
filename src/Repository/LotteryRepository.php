<?php
/**
 * User: isliang
 * Date: 2019-11-23
 * Time: 18:27
 * Email: yesuhuangsi@163.com
 **/

namespace ILottery\Repository;

use ILottery\Dao\LotteryDao;
use Isf\Repository\BaseRepository;

class LotteryRepository extends BaseRepository
{
    /**
     * @var LotteryDao
     */
    private $lottery_dao;

    protected function initObject()
    {
        $this->lottery_dao = new LotteryDao();
    }

    public function create($params)
    {
        $red = explode(',', $params['red']);
        $r = [];
        foreach ($red as $item) {
            $r[] = intval($item);
        }
        sort($r);
        $data = [
            'code' => $params['code'],
            'date' => substr($params['date'], 0, 10),
            'red' => implode(',', $r),
            'blue' => intval($params['blue']),
            'sales' => $params['sales'],
            'poolmoney' => $params['poolmoney'],
            'content' => $params['content']
        ];
        $this->lottery_dao->insert($data, true);
        return $this->lottery_dao->wait(1,true);
    }

    public function lastDate()
    {
        $this->lottery_dao->find([], 0, 1, ['code' => 'desc']);
        $info = $this->lottery_dao->wait();
        return current($info)['date'];
    }

    public function check($red, $blue)
    {
        $where = [
            'red' => $red,
            'blue' => $blue
        ];
        $this->lottery_dao->find($where);
        $list = $this->lottery_dao->wait();
        return $list;
    }
}
