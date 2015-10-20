<?php
/**
 * 免费的快递100接口
 * User: dryyun
 * Time: 2015/10/19 16:39
 * File: FreeKuaidi100Handler.php
 */
namespace Dryyun\ExpressInfo\Handler;

class FreeKuaidi100Handler extends AbstractHandler
{
    private $expressData = array();

    public function __construct()
    {

    }

    /**
     * 根据物流号获取快递公司代码信息
     * @param $expressNu
     * @return array|mixed
     */
    public function expressComName($expressNu)
    {
        $url = "http://www.kuaidi100.com/autonumber/auto?num={$expressNu}";

        $comInfo = $this->getContent($url);

        if ($comInfo && json_decode($comInfo)) {
            return json_decode($comInfo, true);
        }
        return array();
    }

    public function getComCode(array $comNameInfo)
    {
        $code = null;
        if ($comNameInfo) {
            count($comNameInfo) >= 1 && $comNameInfo = $comNameInfo[0];
            isset($comNameInfo['comCode']) && $code = $comNameInfo['comCode'];
        }
        return $code;
    }

    /**
     * 获取快递信息
     * @param $comeCode 快递公司code
     * @param $expressNu 快递物流单号
     * @return array 快递信息的数组
     */
    public function getExpressInfo($comeCode, $expressNu)
    {
        if ($comeCode && $expressNu) {
            $url = "http://www.kuaidi100.com/query?type={$comeCode}&postid={$expressNu}";

            $info = $this->getContent($url);

            if ($info && json_decode($info)) {
                $this->expressData = json_decode($info, true);
            }
            return $this->expressData;
        }
        return array();
    }

    /**
     * 格式化快递数据
     * @param $expressData
     * @return array
     */
    public function formatExpressData($expressData)
    {
        if (isset($expressData['status']) && $expressData['status'] == 200) {
            return array(
                'status' => 200,
                'message' => 'ok',
                'nu' => $expressData['nu'],
                'com' => $expressData['com'],
                'state' => $expressData['state'],
                'data' => $expressData['data']
            );
        } elseif (isset($expressData['status'])) {
            return array(
                'status' => (int)$expressData['status'],
                'message' => isset($expressData['message']) ? $expressData['message'] : null,
            );
        } else {
            return array(
                'status' => 505,
                'message' => '服务器不给力，请稍后再试',
            );
        }
    }
}

