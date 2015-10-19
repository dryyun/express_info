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
    public static function expressInfo($expressNu)
    {
        $comName = self::expressComName($expressNu);
        count($comName) > 1 && $comName = $comName[0];
        if ($comName && isset($comName['comCode']) && $comName['comCode']) {
            $info = self::expressGet($comName['comCode'], $expressNu);
            return $info;
        }
        return array();
    }

    public static function expressGet($com, $expressNu)
    {
        $url = "http://www.kuaidi100.com/query?type={$com}&postid={$expressNu}";
        try {
            $client = new \GuzzleHttp\Client();

            $request = $client->createRequest('GET', $url, array(
                'timeout' => 3,
            ));

            $response = $client->send($request);
            $string = $response->getBody();
            if (json_decode($string)) {
                return json_decode($string, true);
            }
            return array();
        } catch (\Exception $e) {
            return array();
        }
    }

    public static function  expressComName($expressNu)
    {
        $url = "http://www.kuaidi100.com/autonumber/auto?num={$expressNu}";
        try {
            $client = new \GuzzleHttp\Client();

            $request = $client->createRequest('GET', $url, array(
                'timeout' => 3,
            ));
            $response = $client->send($request);
            $string = $response->getBody();
            if (json_decode($string)) {
                return json_decode($string, true);
            }
            return array();
        } catch (\Exception $e) {
            return array();
        }
    }
}
