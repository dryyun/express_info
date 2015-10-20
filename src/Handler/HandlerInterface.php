<?php
/**
 * User: dryyun
 * Time: 2015/10/20 9:42
 * File: HandlerInterface.php
 */
namespace Dryyun\ExpressInfo\Handler;

interface  HandlerInterface
{
    /**
     * 获取快递信息
     * @param $comeCode 快递公司code
     * @param $expressNu 快递物流单号
     * @return array 快递信息的数组
     */
    public function getExpressInfo($comeCode, $expressNu);

    /**
     * 格式化快递数据
     * @param $expressData
     * @return array
     */
    public function formatExpressData($expressData);

}
