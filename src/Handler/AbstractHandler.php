<?php
/**
 * User: dryyun
 * Time: 2015/10/20 9:50
 * File: AbstractHandler.php
 */
namespace Dryyun\ExpressInfo\Handler;

abstract class AbstractHandler implements HandlerInterface
{
    protected function getContent($url, array $params = array(), $timeout = 3, $method = 'GET')
    {
        $curl = curl_init();
        if (strtoupper($method) == 'GET' && $params) {
            $url = $url . '?' . http_build_query($params);
        }
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        if (strtoupper($method) == 'POST') {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        }
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        $output = curl_exec($curl);
        curl_close($curl);

        return $output;
    }
}
