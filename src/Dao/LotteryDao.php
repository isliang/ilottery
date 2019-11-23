<?php
/**
 * User: isliang
 * Date: 2019-11-23
 * Time: 09:26
 * Email: yesuhuangsi@163.com
 **/

namespace ILottery\Dao;

use Isf\Dao\BaseDao;
use Isf\Dao\DaoInfo;

class LotteryDao extends BaseDao
{
    public function getDaoInfo()
    {
        $dao_info = new DaoInfo();
        $dao_info->setMasterDsn('ilottery_db_master');
        $dao_info->setSlaveDsn('ilottery_db_slave');
        $dao_info->setDbName('lottery_db');
        $dao_info->setTableName('lottery');
        $dao_info->setPk('id');

        return $dao_info;
    }
}
