<?php
/**
 * User: dryyun
 * Time: 2015/10/19 16:55
 * File: test.php
 */
require '../vendor/autoload.php';

$a = new Dryyun\ExpressInfo\Handler\FreeKuaidi100Handler();
$b = $a->expressComName('912956448873');

$code = $a->getComCode($b);
//    exit;;
$info = $a->getExpressInfo($code, '920416825501');
print_r($info);
echo 'aaa';
exit;
$a = \Dryyun\ExpressInfo\Handler\FreeKuaidi100::expressInfo('920416825510');
var_dump($a);
