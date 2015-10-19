<?php
/**
 * 免费的快递100接口
 * User: dryyun
 * Time: 2015/10/19 16:39
 * File: FreeKuaidi100.php
 */
namespace Dryyun\ExpressInfo\Handler;

class FreeKuaidi100
{
    public static function  expressComName($expressNu)
    {
        $url = "http://www.kuaidi100.com/autonumber/auto?num={$expressNu}";
        try {
            $client = new \GuzzleHttp\Client();
            print_r($client);exit;
            $response = $client->request('GET', $url, array(
                'timeout' => 10,
            ));
//            $response = $client->send($request);
            $json = $response->
            print_r($json);
            exit;
            if ($json['status'] == 200) {
                return $json;
            }
            return array();
        } catch (\Exception $e) {
            return array();
        }
    }
}
