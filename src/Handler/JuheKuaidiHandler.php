<?php
/**
 * 聚合数据 - 常用快递接口
 * https://www.juhe.cn/docs/api/id/43
 * User: dryyun
 * Time: 15/10/21 上午12:02
 * File: JuheKuaidiHandler.php
 */
namespace Dryyun\ExpressInfo\Handler;

class JuheKuaidiHandler extends AbstractHandler
{
    private $appkey = null;
    private $url = "http://v.juhe.cn/exp/index";
    private $expressData = array();

    public function __construct($appkey)
    {
        $this->appkey = $appkey;
    }

    public function getExpressInfo($comeCode, $expressNu)
    {
        if ($comeCode && $expressNu) {
            $url = "{$this->url}?key={$this->appkey}&com={$comeCode}&no={$expressNu}";

            $info = $this->getContent($url);

            if ($info && json_decode($info)) {
                $this->expressData = json_decode($info, true);
            }
            return $this->expressData;
        }
        return array();
    }

    public function formatExpressData($expressData)
    {
        if (isset($expressData['error_code']) && $expressData['error_code'] == 0) {
            return array(
                'status' => 200,
                'message' => $expressData['reason'],
                'nu' => $expressData['result']['no'],
                'com' => $expressData['result']['com'],
                'data' => $expressData['result']['list']
            );
        } elseif (isset($expressData['error_code'])) {
            return array(
                'status' => (int)$expressData['error_code'],
                'message' => isset($expressData['reason']) ? $expressData['reason'] : null,
            );
        } else {
            return array(
                'status' => 505,
                'message' => '服务器不给力，请稍后再试',
            );
        }
    }
}
