<?php
/**
 * User: isliang
 * Date: 2019-11-23
 * Time: 09:25
 * Email: yesuhuangsi@163.com
 **/

namespace ILottery\Controller;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use ILottery\Constant\CodeConst;
use ILottery\Repository\LotteryDetailRepository;
use ILottery\Repository\LotteryRepository;
use Isf\Controller\IsfController;
use Isf\Factory\LogFactory;

class LotteryController extends IsfController
{
    /**
     * @var LotteryRepository
     */
    private $lottery_repository;
    /**
     * @var LotteryDetailRepository
     */
    private $lottery_detail_repository;

    /**
     * @var Client
     */
    private $client;

    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
        $this->lottery_detail_repository = new LotteryDetailRepository();
        $this->lottery_repository = new LotteryRepository();
        $this->client = new Client();
    }

    public function doCraw($params)
    {
        $uri = 'http://www.cwl.gov.cn/cwl_admin/kjxx/findDrawNotice?' . http_build_query($params);
        $request = new Request(
            'GET',
            $uri,
            [
                'Connection' => 'keep-alive',
                'Pragma' => 'no-cache',
                'Cache-Control' => 'no-cache',
                'Accept' => 'application/json, text/javascript, */*; q=0.01',
                'DNT' => 1,
                'X-Requested-With' => 'XMLHttpRequest',
                'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36',
                'Referer' => 'http://www.cwl.gov.cn/kjxx/ssq/kjgg/',
                'Accept-Encoding' => 'gzip, deflate',
                'Accept-Language' => 'zh-CN,zh;q=0.9',
                'Cookie' => 'UniqueID=bGjMMtczEw24JZ4O1574426638010; Sites=_21; _ga=GA1.3.1502832639.1574426638; _gid=GA1.3.1267701900.1574426638; _Jo0OQK=6DAEFFD72798A05FDC0728DB2064EF43AF689A3F0CA6F3ACAE36B01E50DC0019D72AFD846AAE5A82E6BEB1F5ED0B10E6432D4254DFA78D231F11C77760989BAFB54F1B3C19C5B2FC5F8E6E66EDA7420CD4BE6E66EDA7420CD4B1D5F5E9A1700D960CA255D2BC3746F78GJ1Z1cA==; 21_vq=11',
            ]
        );
        return $this->client->sendAsync($request)->then(function ($response) {
            $result = (string)$response->getBody();
            $result = json_decode($result, true);
            echo $result['countNum'],PHP_EOL;
            if ($result['state'] == 0 && $result['message'] == '查询成功') {
                return $result['result'];
            }
            return [];
        });
    }

    public function initCraw()
    {
        $promise = [];
        for ($page=1; $page<=11; $page++) {
            $params = [
                'name' => 'ssq',
                'issueCount' => '',
                'issueStart' => '',
                'issueEnd' => '',
                'dayStart'=>'2001-01-01',
                'dayEnd' => date("Y-m-d"),
                'pageNo' => $page,
            ];
            $promise[] = $this->doCraw($params);
        }
        foreach ($promise as $item) {
            $res = $item->wait();
            foreach ($res as $param) {
                $res = $this->lottery_repository->create($param);
                if (empty($res)) {
                    LogFactory::getInstance('app')->error($param['code'] . ' lottery result fail');
                }
                $detail_res = $this->lottery_detail_repository->create($param['code'], $param['prizegrades']);
                if (empty($detail_res)) {
                    LogFactory::getInstance('app')->error($param['code'] . ' lottery detail result fail');
                }
                LogFactory::getInstance('app')->info($param['code'] . ' lottery result:' . $res .
                    ', lottery detail result:' . $detail_res);
            }
        }
        $this->json(['code' => CodeConst::CODE_SUCCESS]);
    }

    public function dailyCraw()
    {
        $last_date = $this->lottery_repository->lastDate();
        if ($last_date == date("Y-m-d")) {
            $this->json(['code' => CodeConst::CODE_SUCCESS]);
            return;
        }
        $params = [
            'name' => 'ssq',
            'issueCount' => '',
            'issueStart' => '',
            'issueEnd' => '',
            'dayStart'=> $last_date,
            'dayEnd' => date("Y-m-d"),
            'pageNo' => '',
        ];
        $promise = $this->doCraw($params);
        $res = $promise->wait();
        foreach ($res as $param) {
            $res = $this->lottery_repository->create($param);
            if (empty($res)) {
                LogFactory::getInstance('app')->error($param['code'] . ' lottery result fail');
            }
            $detail_res = $this->lottery_detail_repository->create($param['code'], $param['prizegrades']);
            if (empty($detail_res)) {
                LogFactory::getInstance('app')->error($param['code'] . ' lottery detail result fail');
            }
            LogFactory::getInstance('app')->info($param['code'] . ' lottery result:' . $res .
                ', lottery detail result:' . $detail_res);
        }
        $this->json(['code' => CodeConst::CODE_SUCCESS]);
    }

    public function check()
    {
        $blue = intval($this->request->get['blue']);
        $red = explode(',', $this->request->get['red']);
        $r = [];
        foreach ($red as $item) {
            $r[] = intval($item);
        }
        sort($r);
        $list = $this->lottery_repository->check(implode(',', $r), $blue);
        $this->json(['code' => CodeConst::CODE_SUCCESS, 'list' => [$list]]);
    }
}
